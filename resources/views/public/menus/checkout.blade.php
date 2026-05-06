@extends('layouts.public')

@section('content')
  <div class="max-w-xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Checkout: {{ $menu->name }}</h1>

    <div class="mb-4">
      @include('components.card-menu', ['menu' => $menu])
    </div>

    <form action="" method="post" class="bg-white p-4 border rounded">
      @csrf
      <div class="mb-3">
        <label class="block text-sm font-medium">Nama Pembeli</label>
        <input type="text" name="buyer_name" value="{{ old('buyer_name') }}"
          class="mt-1 block w-full border rounded px-3 py-2">
        @error('buyer_name')
          <div class="text-red-600 text-sm">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label class="block text-sm font-medium">Jumlah</label>
        <input type="number" name="quantity" value="{{ old('quantity', 1) }}" min="1" max="{{ $menu->stock }}"
          class="mt-1 block w-full border rounded px-3 py-2">
        @error('quantity')
          <div class="text-red-600 text-sm">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label class="block text-sm font-medium">Metode Pembayaran</label>
        <select name="payment_method" class="mt-1 block w-full border rounded px-3 py-2">
          <option value="CASH">Tunai</option>
          <option value="QRIS">QRIS</option>
        </select>
        @error('payment_method')
          <div class="text-red-600 text-sm">{{ $message }}</div>
        @enderror
      </div>

      <div class="flex justify-end">
        <button type="submit" class="bg-[#6c1517] text-white px-4 py-2 rounded">Bayar</button>
      </div>
    </form>
  </div>
@endsection
