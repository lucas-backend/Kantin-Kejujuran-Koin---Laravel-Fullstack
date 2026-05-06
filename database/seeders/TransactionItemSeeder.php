<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Database\Seeder;

class TransactionItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transactions = Transaction::all();
        $menus = Menu::where('is_active', true)->get();

        foreach ($transactions as $transaction) {
            $pickedMenus = $menus->random(rand(1, min(3, $menus->count())));

            $totalAmount = 0;
            $totalProfit = 0;

            foreach ($pickedMenus as $menu) {
                $qty = rand(1, 3);
                $lineAmount = $menu->selling_price * $qty;
                $lineProfit = ($menu->selling_price - $menu->cost_price) * $qty;

                TransactionItem::create([
                    'transaction_id' => $transaction->id,
                    'menu_id' => $menu->id,
                    'quantity' => $qty,
                    'cost_price_snapshot' => $menu->cost_price,
                    'profit' => $lineProfit,
                ]);

                $totalAmount += $lineAmount;
                $totalProfit += $lineProfit;
            }

            $transaction->update([
                'total_amount' => $totalAmount,
                'total_profit' => $totalProfit,
            ]);
        }
    }
}
