<h1>Tambah Kategori</h1>

<form action="{{ route('categories.store') }}" method="POST">
    @csrf
    
    <div>
        <label>Nama Kategori</label><br>
        <input 
            type="text" 
            name="name" 
            value="{{ old('name') }}"
            required
        />
        @error('name')
            <p style="color: red;">{{ $message }}</p>
        @enderror
    </div>

    <br>
    <button type="submit">Simpan</button>
    <a href="{{ route('categories.index') }}">Batal</a>
</form>