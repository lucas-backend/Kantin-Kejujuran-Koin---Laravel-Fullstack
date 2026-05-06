@extends('layouts.public')

@section('content')
  <div class="max-w-xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Pembayaran Berhasil</h1>

    <div class="bg-white p-4 border rounded">
      <p class="mb-2">Terima kasih, <strong>{{ $transaction->buyer_name }}</strong>.</p>
      <p class="mb-2">Total: <strong>Rp {{ number_format($transaction->total_amount) }}</strong></p>

      <h3 class="font-semibold mt-4">Rincian</h3>
      <ul class="mt-2">
        @foreach ($transaction->items as $item)
          <li>{{ $item->menu->name }} x {{ $item->quantity }} — Rp
            {{ number_format(($item->menu->selling_price ?? 0) * $item->quantity) }}</li>
        @endforeach
      </ul>
    </div>

    <div class="mt-4">
      <a href="{{ route('public.menus.index') }}" class="text-[#6c1517]">Kembali ke daftar menu</a>
    </div>
  </div>
@endsection
