<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white text-[#1b1b18] min-h-screen">
    <header class="border-b py-4">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <a href="{{ route('public.menus.index') }}" class="font-semibold text-lg text-[#6c1517]">Kantin Kejujuran</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="rounded border border-[#6c1517] px-3 py-1.5 text-sm font-medium text-[#6c1517] hover:bg-[#6c1517] hover:text-white transition-colors">
                    Logout
                </button>
            </form>
        </div>
    </header>

    <div x-data="cart()" @add-to-cart.window="addItem($event.detail)" class="">
        <!-- Cart button -->
        <div class="fixed bottom-4 right-4 z-50">
            <button @click="open = !open" class="bg-[#6c1517] text-white px-4 py-2 rounded shadow-lg">Cart (<span
                    x-text="items.length"></span>)</button>
        </div>

        <!-- Cart drawer -->
        <div x-show="open" x-cloak class="fixed inset-y-0 right-0 w-80 bg-white shadow-xl p-4 z-50"
            @click.away="open = false">
            <h3 class="font-semibold mb-2">Keranjang</h3>
            <template x-if="items.length === 0">
                <div class="text-sm text-gray-500">Belum ada item</div>
            </template>
            <template x-for="item in items" :key="item.id">
                <div class="flex items-center justify-between py-2 border-b">
                    <div>
                        <div class="font-medium" x-text="item.name"></div>
                        <div class="text-sm text-gray-500">Rp <span x-text="item.price"></span></div>
                    </div>
                    <div class="flex items-center gap-2">
                        <input type="number" min="1" class="w-16 border rounded px-2 py-1 text-sm"
                            :value="item.quantity" @change="updateQuantity(item.id, $event.target.value)">
                        <button @click="remove(item.id)" class="text-red-500 text-sm">Hapus</button>
                    </div>
                </div>
            </template>

            <div class="mt-3">
                <div class="font-semibold">Total: Rp <span x-text="total"></span></div>
            </div>

            <div class="mt-3">
                <label class="block text-sm">Nama Pembeli</label>
                <input x-model="buyerName" class="w-full border rounded px-2 py-1 mt-1" />
            </div>
            <div class="mt-2">
                <label class="block text-sm">Metode Bayar</label>
                <select x-model="paymentMethod" class="w-full border rounded px-2 py-1 mt-1">
                    <option value="CASH">CASH</option>
                    <option value="QRIS">QRIS</option>
                </select>
            </div>

            <div class="mt-4 flex gap-2">
                <button @click="checkout()" class="flex-1 bg-green-600 text-white px-3 py-2 rounded">Checkout</button>
                <button @click="open = false" class="flex-1 bg-gray-200 px-3 py-2 rounded">Tutup</button>
            </div>
        </div>
    </div>

    <main class="container mx-auto px-4 py-6">
        @yield('content')
    </main>

    <footer class="border-t py-4 mt-8">
        <div class="container mx-auto px-4 text-sm text-gray-600">&copy; {{ date('Y') }} Kantin Kejujuran</div>
    </footer>
</body>

</html>
