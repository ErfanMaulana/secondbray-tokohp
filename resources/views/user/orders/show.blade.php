<x-main-layout>
    <x-slot name="title">Detail Pesanan - Secondbray</x-slot>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <a href="{{ route('orders.index') }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali ke Riwayat Pesanan
            </a>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 mb-6">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">{{ $order->order_number }}</h1>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Dibuat pada: {{ $order->created_at->format('d M Y, H:i') }}</p>
                </div>
                <span class="inline-block px-4 py-2 text-sm font-semibold rounded
                    @if($order->status == 'pending') bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200
                    @elseif($order->status == 'processing') bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200
                    @elseif($order->status == 'completed') bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200
                    @else bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200
                    @endif">
                    {{ ucfirst($order->status) }}
                </span>
            </div>

            <!-- Shipping Info -->
            <div class="border-t border-gray-200 dark:border-gray-700 pt-6 mb-6">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Informasi Pengiriman</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Nama Penerima</p>
                        <p class="font-medium text-gray-900 dark:text-white">{{ $order->user->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Nomor Telepon</p>
                        <p class="font-medium text-gray-900 dark:text-white">{{ $order->phone }}</p>
                    </div>
                    <div class="md:col-span-2">
                        <p class="text-sm text-gray-500 dark:text-gray-400">Alamat Pengiriman</p>
                        <p class="font-medium text-gray-900 dark:text-white">{{ $order->shipping_address }}</p>
                    </div>
                </div>
            </div>

            <!-- Order Items -->
            <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Item Pesanan</h2>
                <div class="space-y-4">
                    @foreach($order->items as $item)
                        <div class="flex gap-4 pb-4 border-b border-gray-200 dark:border-gray-700 last:border-0">
                            <div class="w-20 h-20 bg-gray-200 dark:bg-gray-700 rounded-lg flex-shrink-0">
                                @if($item->product->image)
                                    <img src="{{ asset($item->product->image) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover rounded-lg">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-3xl">📱</div>
                                @endif
                            </div>
                            <div class="flex-1">
                                <h3 class="font-semibold text-gray-900 dark:text-white">{{ $item->product->name }}</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Jumlah: {{ $item->quantity }}</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Harga: Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-gray-900 dark:text-white">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Total -->
                <div class="mt-6 pt-4 border-t border-gray-200 dark:border-gray-700">
                    <div class="flex justify-between items-center">
                        <span class="text-xl font-bold text-gray-900 dark:text-white">Total Pembayaran</span>
                        <span class="text-2xl font-bold text-indigo-600 dark:text-indigo-400">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-main-layout>
