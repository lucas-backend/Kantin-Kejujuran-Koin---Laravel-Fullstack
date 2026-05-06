@extends('admin.layouts.app')

@section('content')

  <div class="mb-6 flex items-start justify-between gap-4">
    <div>
      <h1 class="text-2xl font-semibold text-slate-900">Daftar Menu</h1>
      <p class="mt-1 text-sm text-stone-500">Kelola produk yang akan tampil ke pelanggan.</p>
    </div>
    <a href="{{ route('menus.create') }}" class="inline-flex items-center rounded-lg bg-[#6c1517] px-4 py-2 text-sm font-medium text-white shadow-sm transition hover:bg-[#581114]">
      Tambah Menu
    </a>
  </div>

  <div class="overflow-hidden rounded-2xl border border-stone-200 bg-white shadow-sm">
    <table class="min-w-full divide-y divide-stone-200 text-sm">
      <thead class="bg-stone-50 text-left text-xs uppercase tracking-[0.2em] text-stone-500">
        <tr>
          <th class="px-4 py-3">Gambar</th>
          <th class="px-4 py-3">Nama</th>
          <th class="px-4 py-3">Harga Pokok</th>
          <th class="px-4 py-3">Harga Jual</th>
          <th class="px-4 py-3">Stok</th>
          <th class="px-4 py-3">Status</th>
          <th class="px-4 py-3">Aksi</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-stone-100">
        @forelse ($menus as $menu)
          <tr class="align-top hover:bg-stone-50/60">
            <td class="px-4 py-4">
              @if ($menu->image_path)
                <img src="{{ asset('storage/' . $menu->image_path) }}" class="h-16 w-16 rounded-xl object-cover ring-1 ring-stone-200" alt="{{ $menu->name }}">
              @else
                <div class="flex h-16 w-16 items-center justify-center rounded-xl bg-stone-100 text-xs text-stone-400">No image</div>
              @endif
            </td>
            <td class="px-4 py-4 font-medium text-slate-900">{{ $menu->name }}</td>
            <td class="px-4 py-4 text-stone-700">Rp {{ number_format($menu->cost_price, 0, ',', '.') }}</td>
            <td class="px-4 py-4 text-stone-700">Rp {{ number_format($menu->selling_price, 0, ',', '.') }}</td>
            <td class="px-4 py-4 text-stone-700">{{ $menu->stock }}</td>
            <td class="px-4 py-4">
              @if ($menu->is_active)
                <span class="inline-flex rounded-full bg-emerald-100 px-2.5 py-1 text-xs font-medium text-emerald-700">Aktif</span>
              @else
                <span class="inline-flex rounded-full bg-rose-100 px-2.5 py-1 text-xs font-medium text-rose-700">Tidak aktif</span>
              @endif
            </td>
            <td class="px-4 py-4">
              <div class="flex items-center gap-3">
                <a href="{{ route('menus.edit', $menu) }}" class="font-medium text-blue-600 transition hover:text-blue-700">Edit</a>
                <form action="{{ route('menus.destroy', $menu) }}" method="POST" onsubmit="return confirm('Yakin dihapus?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="font-medium text-rose-600 transition hover:text-rose-700">Hapus</button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="7" class="px-4 py-10 text-center text-stone-500">Tidak ada menu</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

@endsection
