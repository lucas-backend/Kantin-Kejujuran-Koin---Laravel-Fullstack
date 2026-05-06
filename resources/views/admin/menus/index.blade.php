<h1>Daftar Menu</h1>

<a href="{{ route('menus.create') }}">Tambah Menu</a>

<table border="1" cellpadding="10">
  <thead>
    <tr>
      <th>Gambar</th>
      <th>Nama</th>
      <th>Harga Pokok</th>
      <th>Harga Jual</th>
      <th>Stok</th>
      <th>Status</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    @forelse ($menus as $menu)
      <tr>
        <td>
          @if ($menu->image_path)
            <img src="{{ asset('storage/' . $menu->image_path) }}" width="80" height="80" alt="{{ $menu->name }}">
          @else
            <span>-</span>
          @endif
        </td>
        <td>{{ $menu->name }}</td>
        <td>Rp {{ number_format($menu->cost_price, 0, ',', '.') }}</td>
        <td>Rp {{ number_format($menu->selling_price, 0, ',', '.') }}</td>
        <td>{{ $menu->stock }}</td>
        <td>
          @if ($menu->is_active)
            <span style="color: green;">Aktif</span>
          @else
            <span style="color: red;">Tidak Aktif</span>
          @endif
        </td>
        <td>
          <a href="{{ route('menus.edit', $menu) }}">Edit</a>

          <form action="{{ route('menus.destroy', $menu) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('Yakin dihapus?')">Hapus</button>
          </form>
        </td>
      </tr>
    @empty
      <tr>
        <td colspan="7">Tidak ada menu</td>
      </tr>
    @endforelse
  </tbody>
</table>
