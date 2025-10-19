<x-main-layout>
    <x-slot name="title">Produk - Secondbray</x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-8">Semua Produk</h1>

        <!-- Filters -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 mb-8">
            <form method="GET" action="{{ route('products.index') }}" class="grid grid-cols-1 md:grid-cols-5 gap-4">
                <!-- Search -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Cari</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari HP..." class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                </div>

                <!-- Brand Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Merek</label>
                    <select name="brand" class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <option value="">Semua Merek</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}" {{ request('brand') == $brand->id ? 'selected' : '' }}>
                                {{ $brand->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Category Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Kategori</label>
                    <select name="category" class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Condition Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Kondisi</label>
                    <select name="condition" class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <option value="">Semua Kondisi</option>
                        <option value="Sangat Baik" {{ request('condition') == 'Sangat Baik' ? 'selected' : '' }}>Sangat Baik</option>
                        <option value="Baik" {{ request('condition') == 'Baik' ? 'selected' : '' }}>Baik</option>
                        <option value="Cukup" {{ request('condition') == 'Cukup' ? 'selected' : '' }}>Cukup</option>
                    </select>
                </div>

                <!-- Submit -->
                <div class="flex items-end">
                    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2.5 px-4 rounded-lg transition-colors shadow-sm">
                        Filter
                    </button>
                </div>
            </form>
        </div>

        <!-- Products Grid -->
        @if($products->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-8">
                @foreach($products as $product)
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
                            <h3 class="font-semibold text-lg text-gray-900 dark:text-white mb-2 line-clamp-2">{{ $product->name }}</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">Kondisi: {{ $product->condition }}</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-3">Stok: {{ $product->stock }}</p>
                            <p class="text-2xl font-bold text-indigo-600 dark:text-indigo-400 mb-3">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            <a href="{{ route('products.show', $product->slug) }}" class="block w-full text-center bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $products->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <p class="text-xl text-gray-500 dark:text-gray-400">Tidak ada produk ditemukan</p>
            </div>
        @endif
    </div>
</x-main-layout>
