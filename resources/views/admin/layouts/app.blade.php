<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin - {{ config('app.name') }}</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <style>[x-cloak]{display:none!important;}</style>
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="min-h-screen bg-stone-50 text-slate-900">
  <div class="min-h-screen lg:flex">
    <aside class="border-r bg-white lg:w-72 lg:sticky lg:top-0 lg:h-screen">
      <div class="flex h-16 items-center border-b px-6">
        <div>
          <div class="text-xs uppercase tracking-[0.25em] text-[#6c1517]">Kantin Kejujuran</div>
          <div class="text-lg font-semibold text-slate-900">KOMUNITAS INTEGRITAS</div>
        </div>
      </div>

      <nav class="space-y-1 p-4 text-sm font-medium">
        <a href="{{ route('dashboard') }}" class="flex items-center rounded-lg px-3 py-2 transition {{ request()->routeIs('dashboard') ? 'bg-[#6c1517] text-white' : 'text-slate-700 hover:bg-stone-100' }}">
          Dashboard
        </a>
        <a href="{{ route('transactions.index') }}" class="flex items-center rounded-lg px-3 py-2 transition {{ request()->routeIs('transactions.*') ? 'bg-[#6c1517] text-white' : 'text-slate-700 hover:bg-stone-100' }}">
          Transaksi
        </a>
        <a href="{{ route('menus.index') }}" class="flex items-center rounded-lg px-3 py-2 transition {{ request()->routeIs('menus.*') ? 'bg-[#6c1517] text-white' : 'text-slate-700 hover:bg-stone-100' }}">
          Menu
        </a>
        <a href="{{ route('categories.index') }}" class="flex items-center rounded-lg px-3 py-2 transition {{ request()->routeIs('categories.*') ? 'bg-[#6c1517] text-white' : 'text-slate-700 hover:bg-stone-100' }}">
          Kategori
        </a>
      </nav>
    </aside>

    <main class="flex-1">
      <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <div class="mb-6 flex items-center justify-between rounded-2xl border border-stone-200 bg-white px-4 py-3 shadow-sm">
          <div>
            <div class="text-xs uppercase tracking-[0.25em] text-stone-500">Dashboard Admin</div>
            {{-- <div class="text-lg font-semibold text-slate-900">Kelola menu, kategori, dan transaksi</div> --}}
          </div>
        </div>

        @yield('content')
      </div>
    </main>
  </div>
</body>

</html>
