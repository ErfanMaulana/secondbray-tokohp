<x-main-layout>
    <x-slot name="title">Keranjang - Secondbray</x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-8">Keranjang Belanja</h1>

        @if($cartItems->count() > 0)
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Cart Items -->
                <div class="lg:col-span-2 space-y-4">
                    @foreach($cartItems as $item)
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 flex gap-4">
                            <div class="w-24 h-24 bg-gray-200 dark:bg-gray-700 rounded-lg flex-shrink-0">
                                @if($item->product->image)
                                    <img src="{{ asset($item->product->image) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover rounded-lg">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-4xl">📱</div>
                                @endif
                            </div>

                            <div class="flex-1">
                                <h3 class="font-semibold text-lg text-gray-900 dark:text-white mb-1">{{ $item->product->name }}</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">{{ $item->product->category->name }}</p>
                                <p class="text-xl font-bold text-indigo-600 dark:text-indigo-400">Rp {{ number_format($item->product->price, 0, ',', '.') }}</p>
                            </div>

                            <div class="flex flex-col justify-between items-end">
                                <form action="{{ route('cart.destroy', $item) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-700 dark:text-red-400">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>

                                <form action="{{ route('cart.update', $item) }}" method="POST" class="flex items-center gap-2">
                                    @csrf
                                    @method('PATCH')
                                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}" class="w-20 rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white text-center">
                                    <button type="submit" class="px-3 py-1 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 text-sm">
                                        Update
                                    </button>
                                </form>

                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">
                                    Subtotal: Rp {{ number_format($item->quantity * $item->product->price, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Order Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 sticky top-4">
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Ringkasan Pesanan</h2>
                        
                        <div class="space-y-3 mb-6">
                            <div class="flex justify-between text-gray-600 dark:text-gray-400">
                                <span>Total Item</span>
                                <span>{{ $cartItems->sum('quantity') }}</span>
                            </div>
                            <div class="flex justify-between text-xl font-bold text-gray-900 dark:text-white pt-3 border-t border-gray-200 dark:border-gray-700">
                                <span>Total</span>
                                <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <a href="{{ route('checkout') }}" class="block w-full text-center bg-indigo-600 text-white py-3 rounded-lg hover:bg-indigo-700 transition font-semibold">
                            Checkout
                        </a>

                        <a href="{{ route('products.index') }}" class="block w-full text-center mt-3 text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300">
                            Lanjut Belanja
                        </a>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-12">
                <div class="text-8xl mb-4">🛒</div>
                <p class="text-xl text-gray-500 dark:text-gray-400 mb-6">Keranjang belanja Anda kosong</p>
                <a href="{{ route('products.index') }}" class="inline-block bg-indigo-600 text-white px-8 py-3 rounded-lg hover:bg-indigo-700 transition font-semibold">
                    Belanja Sekarang
                </a>
            </div>
        @endif
    </div>
</x-main-layout>
