@extends('layouts.public')

@section('content')
  <div class="mb-4">
    <h1 class="text-2xl font-bold">Daftar Menu</h1>
  </div>

  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
    @forelse($menus as $menu)
      @include('components.card-menu', ['menu' => $menu])
    @empty
      <div>Tidak ada menu tersedia.</div>
    @endforelse
  </div>
@endsection
