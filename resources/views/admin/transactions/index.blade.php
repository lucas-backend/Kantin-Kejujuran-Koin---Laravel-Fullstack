@extends('admin.layouts.app')

@section('content')
  <div class="mb-6 flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
    <div>
      <h1 class="text-2xl font-semibold text-slate-900">Transaksi</h1>
      <p class="mt-1 text-sm text-stone-500">Pantau omzet, profit, dan riwayat penjualan sesuai periode.</p>
    </div>

    <form method="get" class="flex items-center gap-2 rounded-xl border border-stone-200 bg-white px-3 py-2 shadow-sm">
      <label for="period" class="text-sm text-stone-500">Periode</label>
      <select id="period" name="period" onchange="this.form.submit()" class="rounded-lg border border-stone-200 bg-stone-50 px-3 py-2 text-sm text-slate-800 outline-none focus:border-[#6c1517]">
        <option value="all" {{ $period=='all' ? 'selected' : '' }}>Semua</option>
        <option value="day" {{ $period=='day' ? 'selected' : '' }}>Hari ini</option>
        <option value="week" {{ $period=='week' ? 'selected' : '' }}>Minggu ini</option>
        <option value="3m" {{ $period=='3m' ? 'selected' : '' }}>3 Bulan</option>
        <option value="1y" {{ $period=='1y' ? 'selected' : '' }}>1 Tahun</option>
      </select>
    </form>
  </div>

  <div class="grid gap-4 md:grid-cols-3 mb-4">
    <div class="rounded-2xl border border-stone-200 bg-white p-5 shadow-sm">
      <div class="text-sm text-stone-500">Transaksi</div>
      <div class="mt-2 text-3xl font-semibold text-slate-900">{{ number_format($totals['count']) }}</div>
    </div>
    <div class="rounded-2xl border border-stone-200 bg-white p-5 shadow-sm">
      <div class="text-sm text-stone-500">Total Omzet</div>
      <div class="mt-2 text-3xl font-semibold text-slate-900">Rp {{ number_format($totals['total_amount']) }}</div>
    </div>
    <div class="rounded-2xl border border-[#6c1517]/20 bg-[#6c1517] p-5 text-white shadow-sm">
      <div class="text-sm text-white/80">Total Profit</div>
      <div class="mt-2 text-3xl font-semibold">Rp {{ number_format($totals['total_profit']) }}</div>
    </div>
  </div>

  <div class="overflow-hidden rounded-2xl border border-stone-200 bg-white shadow-sm">
    <table class="min-w-full divide-y divide-stone-200 text-sm">
      <thead class="bg-stone-50 text-left text-xs uppercase tracking-[0.2em] text-stone-500">
        <tr>
          <th class="px-4 py-3">ID</th>
          <th class="px-4 py-3">Pembeli</th>
          <th class="px-4 py-3">Items</th>
          <th class="px-4 py-3">Total</th>
          <th class="px-4 py-3">Tanggal</th>
          <th class="px-4 py-3">Aksi</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-stone-100">
        @foreach($transactions as $tx)
          <tr class="hover:bg-stone-50/60">
            <td class="px-4 py-4 font-medium text-slate-900">#{{ $tx->id }}</td>
            <td class="px-4 py-4 text-slate-700">{{ $tx->buyer_name }}</td>
            <td class="px-4 py-4 text-slate-700">{{ $tx->items_count }}</td>
            <td class="px-4 py-4 text-slate-700">Rp {{ number_format($tx->total_amount) }}</td>
            <td class="px-4 py-4 text-slate-700">{{ $tx->created_at->format('Y-m-d H:i') }}</td>
            <td class="px-4 py-4">
              <a href="{{ route('transactions.show', $tx) }}" class="font-medium text-blue-600 hover:text-blue-700">Detail</a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <div class="mt-4">{{ $transactions->links() }}</div>

@endsection
