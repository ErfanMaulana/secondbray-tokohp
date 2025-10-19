<x-main-layout>
    <x-slot name="title">{{ $product->name }} - Secondbray</x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="mb-6 text-sm">
            <ol class="flex items-center space-x-2 text-gray-500 dark:text-gray-400">
                <li><a href="{{ route('home') }}" class="hover:text-gray-700 dark:hover:text-gray-300">Home</a></li>
                <li>/</li>
                <li><a href="{{ route('products.index') }}" class="hover:text-gray-700 dark:hover:text-gray-300">Produk</a></li>
                <li>/</li>
                <li class="text-gray-900 dark:text-white">{{ $product->name }}</li>
            </ol>
        </nav>

        <!-- Product Detail -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
            <!-- Image -->
            <div class="bg-gray-200 dark:bg-gray-700 rounded-lg overflow-hidden">
                @if($product->image)
                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-full">
                @else
                    <div class="w-full aspect-square flex items-center justify-center text-9xl">📱</div>
                @endif
            </div>

            <!-- Details -->
            <div class="bg-white dark:bg-gray-800 rounded-lg p-6">
                <span class="inline-block px-3 py-1 text-sm font-semibold rounded bg-indigo-100 dark:bg-indigo-900 text-indigo-800 dark:text-indigo-200 mb-3">
                    {{ $product->category->name }}
                </span>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">{{ $product->name }}</h1>
                
                <div class="mb-4">
                    <span class="text-4xl font-bold text-indigo-600 dark:text-indigo-400">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </span>
                </div>

                <div class="space-y-3 mb-6">
                    <div class="flex items-center">
                        <span class="text-gray-600 dark:text-gray-400 w-24">Kondisi:</span>
                        <span class="font-semibold text-gray-900 dark:text-white">{{ $product->condition }}</span>
                    </div>
                    <div class="flex items-center">
                        <span class="text-gray-600 dark:text-gray-400 w-24">Stok:</span>
                        <span class="font-semibold text-gray-900 dark:text-white">{{ $product->stock }} unit</span>
                    </div>
                </div>

                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Deskripsi:</h3>
                    <p class="text-gray-600 dark:text-gray-400">{{ $product->description }}</p>
                </div>

                @auth
                    @if($product->stock > 0)
                        <form action="{{ route('cart.store') }}" method="POST" class="space-y-4">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Jumlah</label>
                                <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="w-32 rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                            </div>
                            <button type="submit" class="w-full bg-indigo-600 text-white py-3 rounded-lg hover:bg-indigo-700 transition font-semibold">
                                Tambah ke Keranjang
                            </button>
                        </form>
                    @else
                        <div class="bg-red-100 dark:bg-red-900 border border-red-400 dark:border-red-700 text-red-700 dark:text-red-200 px-4 py-3 rounded">
                            Stok habis
                        </div>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="block w-full text-center bg-indigo-600 text-white py-3 rounded-lg hover:bg-indigo-700 transition font-semibold">
                        Login untuk Membeli
                    </a>
                @endauth
            </div>
        </div>

        <!-- Related Products -->
        @if($relatedProducts->count() > 0)
            <div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Produk Serupa</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($relatedProducts as $related)
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:shadow-lg transition overflow-hidden">
                            <div class="aspect-w-16 aspect-h-9 bg-gray-200 dark:bg-gray-700">
                                @if($related->image)
                                    <img src="{{ asset($related->image) }}" alt="{{ $related->name }}" class="w-full h-48 object-cover">
                                @else
                                    <div class="w-full h-48 flex items-center justify-center text-6xl">📱</div>
                                @endif
                            </div>
                            <div class="p-4">
                                <h3 class="font-semibold text-gray-900 dark:text-white mb-2">{{ $related->name }}</h3>
                                <p class="text-xl font-bold text-indigo-600 dark:text-indigo-400 mb-3">Rp {{ number_format($related->price, 0, ',', '.') }}</p>
                                <a href="{{ route('products.show', $related->slug) }}" class="block w-full text-center bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</x-main-layout>
