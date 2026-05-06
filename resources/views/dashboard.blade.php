@extends('admin.layouts.app')

@section('content')
  <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
    <div class="rounded-2xl border border-stone-200 bg-white p-5 shadow-sm">
      <div class="text-sm text-stone-500">Total Menu</div>
      <div class="mt-2 text-3xl font-semibold text-slate-900">{{ number_format($menuCount ?? 0) }}</div>
    </div>

    <div class="rounded-2xl border border-stone-200 bg-white p-5 shadow-sm">
      <div class="text-sm text-stone-500">Total Kategori</div>
      <div class="mt-2 text-3xl font-semibold text-slate-900">{{ number_format($categoryCount ?? 0) }}</div>
    </div>

    <div class="rounded-2xl border border-stone-200 bg-white p-5 shadow-sm">
      <div class="text-sm text-stone-500">Total Transaksi</div>
      <div class="mt-2 text-3xl font-semibold text-slate-900">{{ number_format($transactionCount ?? 0) }}</div>
    </div>

    <div class="rounded-2xl border border-[#6c1517]/20 bg-[#6c1517] p-5 text-white shadow-sm">
      <div class="text-sm text-white/80">Fokus Admin</div>
      <div class="mt-2 text-2xl font-semibold">Kelola stok, kategori, dan laporan penjualan</div>
    </div>
  </div>

  <div class="mt-6 grid gap-4 lg:grid-cols-3">
    <div class="rounded-2xl border border-stone-200 bg-white p-5 shadow-sm lg:col-span-2">
      <h2 class="text-lg font-semibold text-slate-900">Panduan cepat</h2>
      <div class="mt-4 grid gap-3 md:grid-cols-3">
        <div class="rounded-xl bg-stone-50 p-4">
          <div class="text-sm font-semibold text-slate-900">1. Menu</div>
          <p class="mt-1 text-sm text-stone-600">Tambah atau edit menu dengan harga pokok, harga jual, stok, dan gambar.</p>
        </div>
        <div class="rounded-xl bg-stone-50 p-4">
          <div class="text-sm font-semibold text-slate-900">2. Kategori</div>
          <p class="mt-1 text-sm text-stone-600">Kelompokkan menu agar pelanggan lebih mudah menemukan produk.</p>
        </div>
        <div class="rounded-xl bg-stone-50 p-4">
          <div class="text-sm font-semibold text-slate-900">3. Transaksi</div>
          <p class="mt-1 text-sm text-stone-600">Lihat omzet, profit, dan detail item yang terjual per periode.</p>
        </div>
      </div>
    </div>

    <div class="rounded-2xl border border-stone-200 bg-white p-5 shadow-sm">
      <h2 class="text-lg font-semibold text-slate-900">Catatan</h2>
      <p class="mt-3 text-sm leading-6 text-stone-600">
        Gunakan warna merah tua untuk aksi utama, putih untuk ruang utama, dan kartu sederhana agar tampilan admin tetap fokus pada data.
      </p>
    </div>
  </div>
@endsection
