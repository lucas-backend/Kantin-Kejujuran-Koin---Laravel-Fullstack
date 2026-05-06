@extends('admin.layouts.app')

@section('content')
  <div class="mb-6">
    <a href="{{ route('transactions.index') }}" class="text-sm font-medium text-stone-500 hover:text-slate-900">&larr; Kembali</a>
  </div>

  <div class="rounded-2xl border border-stone-200 bg-white p-6 shadow-sm">
    <div class="flex flex-col gap-2 border-b border-stone-200 pb-4 md:flex-row md:items-end md:justify-between">
      <div>
        <h2 class="text-2xl font-semibold text-slate-900">Transaksi #{{ $transaction->id }}</h2>
        <div class="mt-1 text-sm text-stone-500">Pembeli: {{ $transaction->buyer_name }} · Metode: {{ $transaction->payment_method }}</div>
      </div>
      <div class="text-right text-sm text-stone-500">
        <div>{{ $transaction->created_at->format('Y-m-d H:i') }}</div>
      </div>
    </div>

    <div class="mt-6 overflow-hidden rounded-2xl border border-stone-200">
      <table class="min-w-full divide-y divide-stone-200 text-sm">
        <thead class="bg-stone-50 text-left text-xs uppercase tracking-[0.2em] text-stone-500">
          <tr>
            <th class="px-4 py-3">Menu</th>
            <th class="px-4 py-3">Qty</th>
            <th class="px-4 py-3">Harga</th>
            <th class="px-4 py-3">Profit</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-stone-100 bg-white">
          @foreach($transaction->items as $item)
            <tr class="hover:bg-stone-50/60">
              <td class="px-4 py-4 font-medium text-slate-900">{{ $item->menu->name ?? '—' }}</td>
              <td class="px-4 py-4 text-slate-700">{{ $item->quantity }}</td>
              <td class="px-4 py-4 text-slate-700">Rp {{ number_format(($item->menu->selling_price ?? 0) * $item->quantity) }}</td>
              <td class="px-4 py-4 text-slate-700">Rp {{ number_format($item->profit) }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <div class="mt-6 flex flex-col gap-2 text-right">
      <div class="text-base font-semibold text-slate-900">Total: Rp {{ number_format($transaction->total_amount) }}</div>
      <div class="text-sm text-stone-500">Total Profit: Rp {{ number_format($transaction->total_profit) }}</div>
    </div>
  </div>

@endsection
