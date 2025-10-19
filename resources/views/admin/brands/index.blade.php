<x-admin-layout>
    <x-slot name="title">Merek HP - Admin Secondbray</x-slot>
    <x-slot name="header">Manajemen Merek HP</x-slot>

    <div>
        <div class="mb-6">
            <a href="{{ route('admin.brands.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Merek
            </a>
        </div>

        @if($brands->count() > 0)
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Merek</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Jumlah Produk</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($brands as $brand)
                            @php
                                // Semua kategori yang harus ditampilkan
                                $allCategories = ['Flagship', 'Mid Range', 'Gaming', 'Entry Level'];
                                $categoryCounts = $brand->products->groupBy('category.name')->map(fn($items) => $items->count());
                                $categoryData = collect($allCategories)->map(fn($cat) => [
                                    'name' => $cat,
                                    'count' => $categoryCounts->get($cat, 0)
                                ])->values();

                                // Semua kondisi yang harus ditampilkan
                                $allConditions = ['Sangat Baik', 'Baik', 'Cukup'];
                                $conditionCounts = $brand->products->groupBy('condition')->map(fn($items) => $items->count());
                                $conditionData = collect($allConditions)->map(fn($cond) => [
                                    'name' => $cond,
                                    'count' => $conditionCounts->get($cond, 0)
                                ])->values();
                            @endphp
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700" x-data="{ 
                                open: false, 
                                showModal: false,
                                brandData: {
                                    name: {{ Js::from($brand->name) }},
                                    slug: {{ Js::from($brand->slug) }},
                                    totalProducts: {{ $brand->products_count }},
                                    categories: {{ Js::from($categoryData) }},
                                    conditions: {{ Js::from($conditionData) }}
                                }
                            }">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $brand->name }}</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">{{ $brand->slug }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                    {{ $brand->products_count }} produk
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="relative inline-block text-left">
                                        <button @click="open = !open" class="inline-flex items-center justify-center w-8 h-8 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                <circle cx="12" cy="5" r="2"/>
                                                <circle cx="12" cy="12" r="2"/>
                                                <circle cx="12" cy="19" r="2"/>
                                            </svg>
                                        </button>

                                        <div x-show="open" 
                                             @click.away="open = false"
                                             x-transition:enter="transition ease-out duration-100"
                                             x-transition:enter-start="transform opacity-0 scale-95"
                                             x-transition:enter-end="transform opacity-100 scale-100"
                                             x-transition:leave="transition ease-in duration-75"
                                             x-transition:leave-start="transform opacity-100 scale-100"
                                             x-transition:leave-end="transform opacity-0 scale-95"
                                             class="origin-top-right absolute right-0 mt-2 w-48 rounded-lg shadow-lg bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5 z-10"
                                             style="display: none;">
                                            
                                            <div class="py-1">
                                                <button @click="showModal = true; open = false" class="group flex items-center w-full px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                                                    <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                                    </svg>
                                                    Lihat Statistik
                                                </button>
                                                <a href="{{ route('admin.brands.edit', $brand) }}" class="group flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                                                    <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                    </svg>
                                                    Edit Merek
                                                </a>
                                            </div>
                                            
                                            <div class="py-1">
                                                <form action="{{ route('admin.brands.destroy', $brand) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus merek ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="group flex items-center w-full px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                                                        <svg class="mr-3 h-5 w-5 text-red-400 group-hover:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                        </svg>
                                                        Hapus Merek
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal Statistik -->
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
                                                 class="relative bg-white dark:bg-gray-800 rounded-lg shadow-xl w-full" style="max-width: 380px;"
                                                 @click.away="showModal = false">
                                                
                                                <!-- Modal Header -->
                                                <div class="flex items-center justify-between p-4 border-b border-gray-200 dark:border-gray-700">
                                                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">Statistik Merek</h3>
                                                    <button @click="showModal = false" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                        </svg>
                                                    </button>
                                                </div>

                                                <!-- Modal Body -->
                                                <div class="p-3">
                                                    <div class="space-y-3">
                                                        <!-- Brand Info -->
                                                        <div>
                                                            <h4 class="text-lg font-bold text-gray-900 dark:text-white" x-text="brandData.name"></h4>
                                                            <p class="text-xs text-gray-500 dark:text-gray-400" x-text="brandData.slug"></p>
                                                        </div>

                                                        <!-- Total Products -->
                                                        <div class="bg-indigo-50 dark:bg-indigo-900/20 rounded-lg p-2.5 border border-indigo-200 dark:border-indigo-800">
                                                            <p class="text-xs text-gray-600 dark:text-gray-400 mb-0.5">Total Produk</p>
                                                            <p class="text-xl font-bold text-indigo-600 dark:text-indigo-400" x-text="brandData.totalProducts"></p>
                                                        </div>

                                                        <!-- Categories Breakdown -->
                                                        <div>
                                                            <h5 class="text-xs font-semibold text-gray-900 dark:text-white mb-1.5 uppercase">Kategori</h5>
                                                            <div class="space-y-1.5">
                                                                <template x-for="category in brandData.categories" :key="category.name">
                                                                    <div class="bg-gray-50 dark:bg-gray-700 rounded-md px-2 py-1.5 flex items-center justify-between">
                                                                        <span class="text-xs text-gray-600 dark:text-gray-400" x-text="category.name"></span>
                                                                        <span class="text-sm font-bold text-gray-900 dark:text-white" x-text="category.count"></span>
                                                                    </div>
                                                                </template>
                                                            </div>
                                                        </div>

                                                        <!-- Conditions Breakdown -->
                                                        <div>
                                                            <h5 class="text-xs font-semibold text-gray-900 dark:text-white mb-1.5 uppercase">Kondisi</h5>
                                                            <div class="grid grid-cols-3 gap-1.5">
                                                                <template x-for="condition in brandData.conditions" :key="condition.name">
                                                                    <div class="bg-gray-50 dark:bg-gray-700 rounded-md px-2 py-1.5 flex items-center justify-between">
                                                                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-0.5" x-text="condition.name"></p>
                                                                        <p class="text-sm font-bold text-gray-900 dark:text-white" x-text="condition.count"></p>
                                                                    </div>
                                                                </template>
                                                            </div>
                                                        </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Modal Footer -->
                                                <div class="flex items-center justify-end p-3 border-t border-gray-200 dark:border-gray-700">
                                                    <button @click="showModal = false" class="px-3 py-1.5 text-sm bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 font-medium rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors">
                                                        Tutup
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-8 text-center">
                <p class="text-gray-500 dark:text-gray-400">Belum ada merek. Silakan tambahkan merek baru.</p>
            </div>
        @endif
    </div>
</x-admin-layout>
