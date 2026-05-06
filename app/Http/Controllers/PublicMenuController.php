<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Http\Request;

class PublicMenuController extends Controller
{
    public function index(Request $request)
    {
        $query = Menu::query()->where('is_active', true)->where('stock', '>', 0)->latest();

        if ($request->filled('category')) {
            $query->where('category_id', $request->input('category'));
        }

        $menus = $query->with('category')->get();

        return view('public.menus.index', compact('menus'));
    }

    public function checkout(Request $request, Menu $menu)
    {
        if ($request->isMethod('post')) {
            $data = $request->validate([
                'buyer_name' => ['required', 'string', 'max:255'],
                'payment_method' => ['required', 'in:CASH,QRIS'],
                'quantity' => ['required', 'integer', 'min:1'],
            ]);

            $quantity = (int) $data['quantity'];

            if ($quantity > $menu->stock) {
                return back()->withErrors(['quantity' => 'Stok tidak cukup'])->withInput();
            }

            // create transaction
            $transaction = Transaction::create([
                'buyer_name' => $data['buyer_name'],
                'payment_method' => $data['payment_method'],
                'total_amount' => $menu->selling_price * $quantity,
                'total_profit' => ($menu->selling_price - $menu->cost_price) * $quantity,
            ]);

            TransactionItem::create([
                'transaction_id' => $transaction->id,
                'menu_id' => $menu->id,
                'quantity' => $quantity,
                'cost_price_snapshot' => $menu->cost_price,
                'profit' => ($menu->selling_price - $menu->cost_price) * $quantity,
            ]);

            // decrement stock
            $menu->decrement('stock', $quantity);

            return redirect()->route('public.menus.success', ['transaction' => $transaction->id]);
        }

        return view('public.menus.checkout', compact('menu'));
    }

    public function success(Transaction $transaction)
    {
        $transaction->load('items.menu');

        return view('public.menus.success', compact('transaction'));
    }

    public function checkoutCart(Request $request)
    {
        $data = $request->validate([
            'buyer_name' => ['required', 'string', 'max:255'],
            'payment_method' => ['required', 'in:CASH,QRIS'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.menu_id' => ['required', 'integer', 'exists:menus,id'],
            'items.*.quantity' => ['required', 'integer', 'min:1'],
        ]);

        $totalAmount = 0;
        $totalProfit = 0;

        // Use DB transaction to ensure consistency
        \DB::beginTransaction();
        try {
            $transaction = Transaction::create([
                'buyer_name' => $data['buyer_name'],
                'payment_method' => $data['payment_method'],
                'total_amount' => 0,
                'total_profit' => 0,
            ]);

            foreach ($data['items'] as $it) {
                $menu = Menu::lockForUpdate()->find($it['menu_id']);
                $qty = (int) $it['quantity'];

                if (! $menu || $menu->stock < $qty) {
                    \DB::rollBack();

                    return response()->json(['message' => 'Stok tidak cukup untuk '.($menu->name ?? 'item')], 422);
                }

                $profit = ($menu->selling_price - $menu->cost_price) * $qty;
                $amount = $menu->selling_price * $qty;

                TransactionItem::create([
                    'transaction_id' => $transaction->id,
                    'menu_id' => $menu->id,
                    'quantity' => $qty,
                    'cost_price_snapshot' => $menu->cost_price,
                    'profit' => $profit,
                ]);

                $menu->decrement('stock', $qty);

                $totalAmount += $amount;
                $totalProfit += $profit;
            }

            $transaction->update(['total_amount' => $totalAmount, 'total_profit' => $totalProfit]);

            \DB::commit();

            return response()->json(['transaction' => $transaction->id, 'redirect' => route('public.menus.success', ['transaction' => $transaction->id])]);
        } catch (\Exception $e) {
            \DB::rollBack();

            return response()->json(['message' => 'Gagal memproses transaksi'], 500);
        }
    }
}
