<h1>Edit Menu</h1>

<form action="{{ route('menus.update', $menu) }}" method="POST" enctype="multipart/form-data">
  @csrf
  @method('PUT')

  <div>
    <label>Nama Menu</label><br>
    <input type="text" name="name" value="{{ old('name', $menu->name) }}" required />
    @error('name')
      <p style="color: red;">{{ $message }}</p>
    @enderror
  </div>

  <div>
    <label>Harga Pokok</label><br>
    <input type="number" name="cost_price" value="{{ old('cost_price', $menu->cost_price) }}" required />
    @error('cost_price')
      <p style="color: red;">{{ $message }}</p>
    @enderror
  </div>

  <div>
    <label>Harga Jual</label><br>
    <input type="number" name="selling_price" value="{{ old('selling_price', $menu->selling_price) }}" required />
    @error('selling_price')
      <p style="color: red;">{{ $message }}</p>
    @enderror
  </div>

  <div>
    <label>Stok</label><br>
    <input type="number" name="stock" value="{{ old('stock', $menu->stock) }}" required />
    @error('stock')
      <p style="color: red;">{{ $message }}</p>
    @enderror
  </div>

  <div>
    <label>Gambar</label><br>
    @if ($menu->image_path)
      <div>
        <img src="{{ asset('storage/' . $menu->image_path) }}" width="150" alt="{{ $menu->name }}">
        <p>Gambar saat ini</p>
      </div>
    @endif
    <input type="file" name="image_path" accept="image/*" />
    <p style="color: gray; font-size: 12px;">Kosongkan jika tidak ingin mengubah gambar</p>
    @error('image_path')
      <p style="color: red;">{{ $message }}</p>
    @enderror
  </div>

  <div>
    <label>
      <input type="checkbox" name="is_active" value="1"
        {{ old('is_active', $menu->is_active) ? 'checked' : '' }} />
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
        <option value="{{ $category->id }}"
          {{ old('category_id', $menu->category_id) == $category->id ? 'selected' : '' }}>
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
