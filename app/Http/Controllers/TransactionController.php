<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $period = $request->query('period', 'all');

        $query = Transaction::withCount('items')->latest();

        if ($period !== 'all') {
            $now = now();
            switch ($period) {
                case 'day':
                    $from = $now->copy()->startOfDay();
                    break;
                case 'week':
                    $from = $now->copy()->startOfWeek();
                    break;
                case '3m':
                    $from = $now->copy()->subMonths(3)->startOfDay();
                    break;
                case '1y':
                    $from = $now->copy()->subYear()->startOfDay();
                    break;
                default:
                    $from = null;
            }

            if (! is_null($from)) {
                $query->where('created_at', '>=', $from);
            }
        }

        // clone query to compute aggregates before pagination
        $summary = (clone $query)
            ->selectRaw('COUNT(*) as count, COALESCE(SUM(total_amount),0) as total_amount, COALESCE(SUM(total_profit),0) as total_profit')
            ->first();

        $transactions = $query->paginate(20)->withQueryString();

        $totals = [
            'count' => $summary->count ?? 0,
            'total_amount' => $summary->total_amount ?? 0,
            'total_profit' => $summary->total_profit ?? 0,
        ];

        return view('admin.transactions.index', compact('transactions', 'period', 'totals'));
    }

    public function show(Transaction $transaction)
    {
        $transaction->load('items.menu');

        return view('admin.transactions.show', compact('transaction'));
    }
}
