<h1>Tambah Menu</h1>

<form action="{{ route('menus.store') }}" method="POST" enctype="multipart/form-data">
  @csrf

  <div>
    <label>Nama Menu</label><br>
    <input type="text" name="name" value="{{ old('name') }}" required />
    @error('name')
      <p style="color: red;">{{ $message }}</p>
    @enderror
  </div>

  <div>
    <label>Harga Pokok</label><br>
    <input type="number" name="cost_price" value="{{ old('cost_price') }}" required />
    @error('cost_price')
      <p style="color: red;">{{ $message }}</p>
    @enderror
  </div>

  <div>
    <label>Harga Jual</label><br>
    <input type="number" name="selling_price" value="{{ old('selling_price') }}" required />
    @error('selling_price')
      <p style="color: red;">{{ $message }}</p>
    @enderror
  </div>

  <div>
    <label>Stok</label><br>
    <input type="number" name="stock" value="{{ old('stock') }}" required />
    @error('stock')
      <p style="color: red;">{{ $message }}</p>
    @enderror
  </div>

  <div>
    <label>Gambar</label><br>
    <input type="file" name="image_path" accept="image/*" required />
    @error('image_path')
      <p style="color: red;">{{ $message }}</p>
    @enderror
  </div>

  <div>
    <label>
      <input type="checkbox" name="is_active" value="1" {{ old('is_active') ? 'checked' : '' }} />
      Aktif
    </label>
    @error('is_active')
      <p style="color: red;">{{ $message }}</p>
    @enderror
  </div>

  <div>
    <label>Kategori</label><br>
    <select name="category_id">
      <option value="">-- Pilih Kategori --</option>
      @foreach ($categories as $category)
        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
          {{ $category->name }}
        </option>
      @endforeach
    </select>
    @error('category_id')
      <p style="color: red;">{{ $message }}</p>
    @enderror
  </div>

  <br>
  <button type="submit">Simpan</button>
  <a href="{{ route('menus.index') }}">Batal</a>
</form>
