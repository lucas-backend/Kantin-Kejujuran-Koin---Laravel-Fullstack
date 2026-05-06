<div class="border rounded-lg overflow-hidden shadow-sm bg-white">
  @if (!empty($menu->image_path))
    <img src="{{ asset('storage/' . $menu->image_path) }}" alt="{{ $menu->name }}" class="w-full h-40 object-cover">
  @else
    <div class="w-full h-40 bg-gray-100 flex items-center justify-center text-gray-400">No Image</div>
  @endif
  <div class="p-4">
    <h3 class="font-semibold text-lg">{{ $menu->name }}</h3>
    <p class="text-sm text-gray-600">{{ $menu->category->name ?? '-' }}</p>
    <div class="mt-2 flex items-center justify-between">
      <div>
        <div class="text-sm text-gray-500">Rp {{ number_format($menu->selling_price) }}</div>
        <div class="text-xs text-gray-400">Stok: {{ $menu->stock }}</div>
      </div>
      <div class="flex items-center gap-2">
        <button
          onclick='window.dispatchEvent(new CustomEvent("add-to-cart",{detail:{id: {{ $menu->id }}, name: {!! json_encode($menu->name) !!}, price: {{ $menu->selling_price }}, stock: {{ $menu->stock }}}}))'
          class="bg-[#6c1517] text-white px-3 py-1 rounded">Tambah</button>
      </div>
    </div>
  </div>
</div>
