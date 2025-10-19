<x-main-layout>
    <x-slot name="title">Secondbray - HP Second Berkualitas</x-slot>

    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-bold mb-4">Secondbray</h1>
                <p class="text-xl md:text-2xl mb-8">HP Second Berkualitas dengan Harga Terbaik</p>
                <a href="{{ route('products.index') }}" class="inline-block bg-white text-indigo-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                    Lihat Produk
                </a>
            </div>
        </div>
    </div>

    <!-- Categories Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-12">
        <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">Kategori HP</h2>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
            @foreach($categories as $category)
                <a href="{{ route('products.index', ['category' => $category->id]) }}" class="bg-white dark:bg-gray-800 rounded-lg p-6 text-center shadow-sm hover:shadow-md transition group">
                    <div class="text-4xl mb-2">📱</div>
                    <h3 class="font-semibold text-gray-900 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-400">{{ $category->name }}</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $category->products_count }} produk</p>
                </a>
            @endforeach
        </div>
    </div>

    <!-- Featured Products -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-12">
        <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">Produk Pilihan</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($featuredProducts as $product)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:shadow-lg transition overflow-hidden">
                    <div class="aspect-w-16 aspect-h-9 bg-gray-200 dark:bg-gray-700">
                        @if($product->image)
                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 flex items-center justify-center text-6xl">📱</div>
                        @endif
                    </div>
                    <div class="p-4">
                        <span class="inline-block px-2 py-1 text-xs font-semibold rounded bg-indigo-100 dark:bg-indigo-900 text-indigo-800 dark:text-indigo-200 mb-2">
                            {{ $product->category->name }}
                        </span>
                        <h3 class="font-semibold text-lg text-gray-900 dark:text-white mb-2">{{ $product->name }}</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">Kondisi: {{ $product->condition }}</p>
                        <p class="text-2xl font-bold text-indigo-600 dark:text-indigo-400 mb-3">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        <a href="{{ route('products.show', $product->slug) }}" class="block w-full text-center bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Features Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-16">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="text-5xl mb-4">✅</div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Kualitas Terjamin</h3>
                <p class="text-gray-600 dark:text-gray-400">Semua HP sudah dicek kondisinya</p>
            </div>
            <div class="text-center">
                <div class="text-5xl mb-4">💰</div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Harga Terbaik</h3>
                <p class="text-gray-600 dark:text-gray-400">Harga kompetitif dan terjangkau</p>
            </div>
            <div class="text-center">
                <div class="text-5xl mb-4">🚚</div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Pengiriman Cepat</h3>
                <p class="text-gray-600 dark:text-gray-400">Proses pengiriman yang cepat</p>
            </div>
        </div>
    </div>
</x-main-layout>
