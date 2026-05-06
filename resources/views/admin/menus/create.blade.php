@extends('admin.layouts.app')

@section('content')

  <h1 class="text-2xl font-semibold mb-4">Tambah Menu</h1>

  <form action="{{ route('menus.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4 max-w-lg">
    @csrf

    <div>
      <label class="block text-sm">Nama Menu</label>
      <input type="text" name="name" value="{{ old('name') }}" required class="w-full border rounded px-2 py-1" />
      @error('name')<p class="text-red-500 text-sm">{{ $message }}</p>@enderror
    </div>

    <div class="grid grid-cols-2 gap-4">
      <div>
        <label class="block text-sm">Harga Pokok</label>
        <input type="number" name="cost_price" value="{{ old('cost_price') }}" required class="w-full border rounded px-2 py-1" />
        @error('cost_price')<p class="text-red-500 text-sm">{{ $message }}</p>@enderror
      </div>
      <div>
        <label class="block text-sm">Harga Jual</label>
        <input type="number" name="selling_price" value="{{ old('selling_price') }}" required class="w-full border rounded px-2 py-1" />
        @error('selling_price')<p class="text-red-500 text-sm">{{ $message }}</p>@enderror
      </div>
    </div>

    <div>
      <label class="block text-sm">Stok</label>
      <input type="number" name="stock" value="{{ old('stock') }}" required class="w-32 border rounded px-2 py-1" />
      @error('stock')<p class="text-red-500 text-sm">{{ $message }}</p>@enderror
    </div>

    <div>
      <label class="block text-sm">Gambar</label>
      <input type="file" name="image_path" accept="image/*" required />
      @error('image_path')<p class="text-red-500 text-sm">{{ $message }}</p>@enderror
    </div>

    <div class="flex items-center gap-4">
      <label class="flex items-center gap-2">
        <input type="checkbox" name="is_active" value="1" {{ old('is_active') ? 'checked' : '' }} />
        <span class="text-sm">Aktif</span>
      </label>
      @error('is_active')<p class="text-red-500 text-sm">{{ $message }}</p>@enderror
    </div>

    <div>
      <label class="block text-sm">Kategori</label>
      <select name="category_id" class="w-full border rounded px-2 py-1">
        <option value="">-- Pilih Kategori --</option>
        @foreach ($categories as $category)
          <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
            {{ $category->name }}
          </option>
        @endforeach
      </select>
      @error('category_id')<p class="text-red-500 text-sm">{{ $message }}</p>@enderror
    </div>

    <div class="flex gap-2">
      <button type="submit" class="bg-[#6c1517] text-white px-4 py-2 rounded">Simpan</button>
      <a href="{{ route('menus.index') }}" class="px-4 py-2 rounded border">Batal</a>
    </div>
  </form>

@endsection
