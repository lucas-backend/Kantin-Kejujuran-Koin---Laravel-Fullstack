@extends('admin.layouts.app')

@section('content')
  <div class="flex items-center justify-between mb-6">
    <div>
      <h1 class="text-2xl font-semibold">Daftar Kategori</h1>
      <p class="text-sm text-gray-500 mt-1">Kelola kategori untuk mengelompokkan menu pelanggan.</p>
    </div>

    <a href="{{ route('categories.create') }}" class="bg-[#6c1517] text-white px-3 py-2 rounded">
      Tambah Kategori
    </a>
  </div>

  <div class="bg-white border rounded shadow-sm overflow-hidden">
    <table class="w-full text-sm">
      <thead class="bg-gray-50 text-left text-gray-600">
        <tr>
          <th class="p-3">Nama</th>
          <th class="p-3">Jumlah Menu</th>
          <th class="p-3">Dibuat</th>
          <th class="p-3">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($categories as $category)
          <tr class="border-t">
            <td class="p-3 font-medium">{{ $category->name }}</td>
            <td class="p-3">{{ $category->menus_count }}</td>
            <td class="p-3">{{ $category->created_at->format('Y-m-d H:i') }}</td>
            <td class="p-3">
              <div class="flex items-center gap-2">
                <a href="{{ route('categories.edit', $category) }}" class="text-blue-600">Edit</a>
                <form action="{{ route('categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Yakin hapus kategori ini?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="text-red-600">Hapus</button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="4" class="p-3 text-center text-gray-500">Belum ada kategori</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
@endsection
