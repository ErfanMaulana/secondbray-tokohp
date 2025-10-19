<x-admin-layout>
    <x-slot name="title">Detail Produk - Admin Secondbray</x-slot>
    <x-slot name="header">Detail Produk</x-slot>

    <div class="space-y-6">
        <!-- Back Button -->
        <div>
            <a href="{{ route('admin.products.index') }}" class="inline-flex items-center text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Daftar Produk
            </a>
        </div>

        <!-- Product Detail Card -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
            <div class="md:flex">
                <!-- Product Image -->
                <div class="md:w-1/3 bg-gray-100 dark:bg-gray-700 p-8">
                    @if($product->image)
                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-full h-auto rounded-lg shadow-md">
                    @else
                        <div class="w-full aspect-square flex items-center justify-center bg-gray-200 dark:bg-gray-600 rounded-lg">
                            <span class="text-8xl">📱</span>
                        </div>
                    @endif
                </div>

                <!-- Product Info -->
                <div class="md:w-2/3 p-8">
                    <div class="space-y-6">
                        <!-- Header -->
                        <div class="border-b border-gray-200 dark:border-gray-700 pb-4">
                            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">{{ $product->name }}</h2>
                            <div class="flex flex-wrap gap-2 items-center">
                                @if($product->brand)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200">
                                        <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/>
                                        </svg>
                                        {{ $product->brand->name }}
                                    </span>
                                @endif
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200">
                                    {{ $product->category->name }}
                                </span>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold {{ $product->stock <= 5 ? 'bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200' : 'bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200' }}">
                                    {{ $product->stock }} unit tersedia
                                </span>
                            </div>
                        </div>

                        <!-- Price -->
                        <div class="bg-indigo-50 dark:bg-indigo-900/20 rounded-lg p-4 border border-indigo-200 dark:border-indigo-800">
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Harga</p>
                            <p class="text-4xl font-bold text-indigo-600 dark:text-indigo-400">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        </div>

                        <!-- Specifications Grid -->
                        <div class="grid grid-cols-2 gap-4">
                            @if($product->color)
                                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Warna</p>
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $product->color }}</p>
                                </div>
                            @endif

                            @if($product->variant)
                                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Varian</p>
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $product->variant }}</p>
                                </div>
                            @endif

                            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                                <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Kondisi</p>
                                <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $product->condition }}</p>
                            </div>

                            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                                <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Stok</p>
                                <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $product->stock }} unit</p>
                            </div>
                        </div>

                        <!-- Description -->
                        @if($product->description)
                            <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">Deskripsi Produk</h3>
                                <p class="text-gray-700 dark:text-gray-300 leading-relaxed whitespace-pre-line">{{ $product->description }}</p>
                            </div>
                        @endif

                        <!-- Meta Info -->
                        <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                            <div class="grid grid-cols-2 gap-4 text-sm">
                                <div>
                                    <p class="text-gray-500 dark:text-gray-400">Dibuat pada</p>
                                    <p class="text-gray-900 dark:text-white font-medium">{{ $product->created_at->format('d M Y, H:i') }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-500 dark:text-gray-400">Terakhir diupdate</p>
                                    <p class="text-gray-900 dark:text-white font-medium">{{ $product->updated_at->format('d M Y, H:i') }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex gap-3 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <a href="{{ route('admin.products.edit', $product) }}" class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg transition-colors shadow-md hover:shadow-lg">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Edit Produk
                            </a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?')" class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full inline-flex items-center justify-center px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition-colors shadow-md hover:shadow-lg">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Hapus Produk
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
