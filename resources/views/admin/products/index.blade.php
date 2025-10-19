<x-admin-layout>
    <x-slot name="title">Produk - Admin Secondbray</x-slot>
    <x-slot name="header">Manajemen Produk</x-slot>

    <div class="mb-6 flex items-center justify-between">
        <div>
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Daftar Produk</h3>
            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Kelola semua produk handphone bekas</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition-colors shadow-md hover:shadow-lg">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Produk
        </a>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider">Produk</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider">Harga</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider">Stok</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider">Kondisi</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($products as $product)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="h-16 w-16 flex-shrink-0 bg-gray-100 dark:bg-gray-700 rounded-lg overflow-hidden shadow-sm">
                                        @if($product->image)
                                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="h-16 w-16 object-cover">
                                        @else
                                            <div class="h-16 w-16 flex items-center justify-center text-3xl">📱</div>
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-semibold text-gray-900 dark:text-white">{{ $product->name }}</div>
                                        @if($product->brand)
                                            <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ $product->brand->name }}</div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200">
                                    {{ $product->category->name }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-bold text-gray-900 dark:text-white">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold {{ $product->stock <= 5 ? 'bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200' : 'bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200' }}">
                                    {{ $product->stock }} unit
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $product->condition }}</span>
                            </td>
                            <td class="px-6 py-4 text-center" x-data="{ 
                                open: false,
                                showModal: false,
                                productData: {
                                    name: '{{ $product->name }}',
                                    brand: '{{ $product->brand?->name ?? '-' }}',
                                    category: '{{ $product->category->name }}',
                                    price: 'Rp {{ number_format($product->price, 0, ',', '.') }}',
                                    stock: '{{ $product->stock }}',
                                    condition: '{{ $product->condition }}',
                                    color: '{{ $product->color ?? '-' }}',
                                    variant: '{{ $product->variant ?? '-' }}',
                                    description: '{{ $product->description ?? 'Tidak ada deskripsi' }}',
                                    image: '{{ $product->image ? asset($product->image) : '' }}',
                                    created: '{{ $product->created_at->format('d M Y, H:i') }}',
                                    updated: '{{ $product->updated_at->format('d M Y, H:i') }}'
                                }
                            }">
                                <div class="relative inline-block text-left">
                                    <button @click="open = !open" @click.away="open = false" class="inline-flex items-center justify-center w-8 h-8 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"/>
                                        </svg>
                                    </button>

                                    <div x-show="open" 
                                         x-transition:enter="transition ease-out duration-100"
                                         x-transition:enter-start="transform opacity-0 scale-95"
                                         x-transition:enter-end="transform opacity-100 scale-100"
                                         x-transition:leave="transition ease-in duration-75"
                                         x-transition:leave-start="transform opacity-100 scale-100"
                                         x-transition:leave-end="transform opacity-0 scale-95"
                                         class="origin-top-right absolute right-0 mt-2 w-48 rounded-lg shadow-lg bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 dark:divide-gray-700 z-10"
                                         style="display: none;">
                                        
                                        <div class="py-1">
                                            <button @click="showModal = true; open = false" class="group flex items-center w-full px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                                                <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                                Lihat Detail
                                            </button>
                                            <a href="{{ route('admin.products.edit', $product) }}" class="group flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                                                <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                                Edit Produk
                                            </a>
                                        </div>
                                        
                                        <div class="py-1">
                                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="group flex items-center w-full px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                                                    <svg class="mr-3 h-5 w-5 text-red-400 group-hover:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                    Hapus Produk
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Detail -->
                                <div x-show="showModal" 
                                     x-transition:enter="transition ease-out duration-300"
                                     x-transition:enter-start="opacity-0"
                                     x-transition:enter-end="opacity-100"
                                     x-transition:leave="transition ease-in duration-200"
                                     x-transition:leave-start="opacity-100"
                                     x-transition:leave-end="opacity-0"
                                     class="fixed inset-0 z-50 overflow-y-auto"
                                     style="display: none;">
                                    
                                    <!-- Backdrop -->
                                    <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity" @click="showModal = false"></div>
                                    
                                    <!-- Modal Content -->
                                    <div class="flex items-center justify-center min-h-screen p-4">
                                        <div x-show="showModal"
                                             x-transition:enter="transition ease-out duration-300"
                                             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                             x-transition:leave="transition ease-in duration-200"
                                             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                             class="relative bg-white dark:bg-gray-800 rounded-lg shadow-xl max-w-4xl w-full max-h-[90vh] overflow-hidden"
                                             @click.away="showModal = false">
                                            
                                            <!-- Modal Header -->
                                            <div class="flex items-center justify-between p-6 border-b border-gray-200 dark:border-gray-700">
                                                <h3 class="text-2xl font-bold text-gray-900 dark:text-white">Detail Produk</h3>
                                                <button @click="showModal = false" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                    </svg>
                                                </button>
                                            </div>

                                            <!-- Modal Body -->
                                            <div class="p-6 overflow-y-auto max-h-[calc(90vh-140px)]">
                                                <div class="grid md:grid-cols-2 gap-6">
                                                    <!-- Image Section -->
                                                    <div class="space-y-4">
                                                        <div class="bg-gray-100 dark:bg-gray-700 rounded-lg p-4 flex items-center justify-center" style="min-height: 300px;">
                                                            <template x-if="productData.image">
                                                                <img :src="productData.image" :alt="productData.name" class="max-w-full max-h-80 object-contain rounded-lg">
                                                            </template>
                                                            <template x-if="!productData.image">
                                                                <span class="text-8xl">📱</span>
                                                            </template>
                                                        </div>
                                                    </div>

                                                    <!-- Info Section -->
                                                    <div class="space-y-4">
                                                        <div>
                                                            <h4 class="text-2xl font-bold text-gray-900 dark:text-white mb-2" x-text="productData.name"></h4>
                                                            <div class="flex flex-wrap gap-2 mb-4">
                                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200" x-text="productData.brand"></span>
                                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200" x-text="productData.category"></span>
                                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold" :class="productData.stock <= 5 ? 'bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200' : 'bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200'" x-text="productData.stock + ' unit'"></span>
                                                            </div>
                                                        </div>

                                                        <!-- Price -->
                                                        <div class="bg-indigo-50 dark:bg-indigo-900/20 rounded-lg p-4 border border-indigo-200 dark:border-indigo-800">
                                                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Harga</p>
                                                            <p class="text-3xl font-bold text-indigo-600 dark:text-indigo-400" x-text="productData.price"></p>
                                                        </div>

                                                        <!-- Specifications -->
                                                        <div class="grid grid-cols-2 gap-3">
                                                            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-3">
                                                                <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Warna</p>
                                                                <p class="text-sm font-semibold text-gray-900 dark:text-white" x-text="productData.color"></p>
                                                            </div>
                                                            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-3">
                                                                <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Varian</p>
                                                                <p class="text-sm font-semibold text-gray-900 dark:text-white" x-text="productData.variant"></p>
                                                            </div>
                                                            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-3">
                                                                <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Kondisi</p>
                                                                <p class="text-sm font-semibold text-gray-900 dark:text-white" x-text="productData.condition"></p>
                                                            </div>
                                                            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-3">
                                                                <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Stok</p>
                                                                <p class="text-sm font-semibold text-gray-900 dark:text-white" x-text="productData.stock + ' unit'"></p>
                                                            </div>
                                                        </div>

                                                        <!-- Description -->
                                                        <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                                                            <h5 class="text-sm font-semibold text-gray-900 dark:text-white mb-2">Deskripsi</h5>
                                                            <p class="text-sm text-gray-700 dark:text-gray-300 whitespace-pre-line" x-text="productData.description"></p>
                                                        </div>

                                                        <!-- Meta Info -->
                                                        <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                                                            <div class="grid grid-cols-2 gap-3 text-xs">
                                                                <div>
                                                                    <p class="text-gray-500 dark:text-gray-400">Dibuat</p>
                                                                    <p class="text-gray-900 dark:text-white font-medium" x-text="productData.created"></p>
                                                                </div>
                                                                <div>
                                                                    <p class="text-gray-500 dark:text-gray-400">Diupdate</p>
                                                                    <p class="text-gray-900 dark:text-white font-medium" x-text="productData.updated"></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Modal Footer -->
                                            <div class="flex items-center justify-end gap-3 p-6 border-t border-gray-200 dark:border-gray-700">
                                                <button @click="showModal = false" class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 font-medium rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors">
                                                    Tutup
                                                </button>
                                                <a href="{{ route('admin.products.edit', $product) }}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition-colors">
                                                    Edit Produk
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-400 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                    </svg>
                                    <p class="text-gray-500 dark:text-gray-400 text-lg font-medium">Belum ada produk</p>
                                    <p class="text-gray-400 dark:text-gray-500 text-sm mt-2">Klik tombol "Tambah Produk" untuk mulai menambahkan produk</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($products->hasPages())
            <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700 border-t border-gray-200 dark:border-gray-600">
                {{ $products->links() }}
            </div>
        @endif
    </div>
</x-admin-layout>
