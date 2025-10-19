<x-main-layout>
    <x-slot name="title">Pesanan Saya - Secondbray</x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-8">Riwayat Pesanan</h1>

        @if($orders->count() > 0)
            <div class="space-y-4">
                @foreach($orders as $order)
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="font-semibold text-lg text-gray-900 dark:text-white">{{ $order->order_number }}</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $order->created_at->format('d M Y, H:i') }}</p>
                            </div>
                            <div class="text-right">
                                <span class="inline-block px-3 py-1 text-sm font-semibold rounded
                                    @if($order->status == 'pending') bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200
                                    @elseif($order->status == 'processing') bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200
                                    @elseif($order->status == 'completed') bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200
                                    @else bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200
                                    @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>
                        </div>

                        <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                            <div class="space-y-2 mb-4">
                                @foreach($order->items as $item)
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600 dark:text-gray-400">{{ $item->product->name }} (x{{ $item->quantity }})</span>
                                        <span class="text-gray-900 dark:text-white">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                                    </div>
                                @endforeach
                            </div>

                            <div class="flex justify-between items-center pt-3 border-t border-gray-200 dark:border-gray-700">
                                <div>
                                    <p class="text-xl font-bold text-gray-900 dark:text-white">Total: Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                                </div>
                                <a href="{{ route('orders.show', $order) }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $orders->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <div class="text-8xl mb-4">📦</div>
                <p class="text-xl text-gray-500 dark:text-gray-400 mb-6">Anda belum memiliki pesanan</p>
                <a href="{{ route('products.index') }}" class="inline-block bg-indigo-600 text-white px-8 py-3 rounded-lg hover:bg-indigo-700 transition font-semibold">
                    Belanja Sekarang
                </a>
            </div>
        @endif
    </div>
</x-main-layout>
