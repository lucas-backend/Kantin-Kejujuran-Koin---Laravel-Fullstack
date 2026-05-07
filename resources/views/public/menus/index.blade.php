@extends('layouts.public')

@section('content')
    <div class="mb-4">
        <form action="{{ route('public.menus.index') }}" method="GET" class="space-y-2">
            <div class="flex items-center gap-2">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama menu..."
                    class="flex-1 px-3 py-2 border rounded text-sm" />
                <button type="submit" class="px-3 py-2 bg-[#6c1517] text-white rounded text-sm">Cari</button>
            </div>

            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2">
                <select name="category" class="flex-1 sm:flex-initial px-3 py-2 border rounded text-sm">
                    <option value="">Semua</option>
                    @foreach ($categories ?? [] as $cat)
                        <option value="{{ $cat->id }}" @if ((string) request('category') === (string) $cat->id) selected @endif>
                            {{ $cat->name }}</option>
                    @endforeach
                </select>

                <select name="sort" class="flex-1 sm:flex-initial px-3 py-2 border rounded text-sm">
                    <option value="">Harga</option>
                    <option value="price_asc" @if (request('sort') === 'price_asc') selected @endif>Harga: Terendah</option>
                    <option value="price_desc" @if (request('sort') === 'price_desc') selected @endif>Harga: Tertinggi</option>
                </select>

                <a href="{{ route('public.menus.index') }}" class="text-sm text-gray-600 sm:ml-auto">
                  {{-- Reset Icon --}}
                  {{-- <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 21 21"><g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"><path d="M3.578 6.487A8 8 0 1 1 2.5 10.5"/><path d="M7.5 6.5h-4v-4"/></g></svg> --}}
                  Reset
                </a>
            </div>
        </form>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
        @forelse($menus as $menu)
            @include('components.card-menu', ['menu' => $menu])
        @empty
            <div>Tidak ada menu tersedia.</div>
        @endforelse
    </div>
@endsection
