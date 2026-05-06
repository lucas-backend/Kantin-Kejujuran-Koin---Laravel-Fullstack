<h1>Daftar Kategori</h1>

<a href="{{ route('categories.create') }}">Tambah Kategori</a>

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($categories as $category)
            <tr>
                <td>{{ $category->name }}</td>
                <td>
                    <a href="{{ route('categories.edit', $category) }}">Edit</a>
                    
                    <form action="{{ route('categories.destroy', $category) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Yakin dihapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="2">Tidak ada kategori</td>
            </tr>
        @endforelse
    </tbody>
</table>