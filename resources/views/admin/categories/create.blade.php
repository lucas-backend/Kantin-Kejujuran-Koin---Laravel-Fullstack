@extends('admin.layouts.app')

@section('content')
  <h1 class="text-2xl font-semibold mb-4">Tambah Kategori</h1>

  <form action="{{ route('categories.store') }}" method="POST" class="space-y-4 max-w-lg bg-white border rounded shadow-sm p-6">
    @csrf

    <div>
      <label class="block text-sm mb-1">Nama Kategori</label>
      <input type="text" name="name" value="{{ old('name') }}" required class="w-full border rounded px-3 py-2" />
      @error('name')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    <div class="flex gap-2">
      <button type="submit" class="bg-[#6c1517] text-white px-4 py-2 rounded">Simpan</button>
      <a href="{{ route('categories.index') }}" class="px-4 py-2 rounded border">Batal</a>
    </div>
  </form>
@endsection
