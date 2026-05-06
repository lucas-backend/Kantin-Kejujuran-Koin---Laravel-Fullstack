<h1>Edit Kategori</h1>

<form action="{{ route('categories.update', $category) }}" method="POST">
    @csrf
    @method('PUT')
    
    <div>
        <label>Nama Kategori</label><br>
        <input 
            type="text" 
            name="name" 
            value="{{ old('name', $category->name) }}"
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