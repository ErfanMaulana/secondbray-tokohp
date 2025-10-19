<x-admin-layout>
    <x-slot name="title">Detail Pesanan - Admin Secondbray</x-slot>
    <x-slot name="header">Detail Pesanan: {{ $order->order_number }}</x-slot>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Order Details -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Customer Info -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Informasi Customer</h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600 dark:text-gray-400">Nama:</span>
                        <span class="text-gray-900 dark:text-white font-medium">{{ $order->user->name }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600 dark:text-gray-400">Email:</span>
                        <span class="text-gray-900 dark:text-white font-medium">{{ $order->user->email }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600 dark:text-gray-400">Telepon:</span>
                        <span class="text-gray-900 dark:text-white font-medium">{{ $order->phone }}</span>
                    </div>
                    <div>
                        <span class="text-gray-600 dark:text-gray-400 block mb-1">Alamat Pengiriman:</span>
                        <p class="text-gray-900 dark:text-white font-medium">{{ $order->shipping_address }}</p>
                    </div>
                </div>
            </div>

            <!-- Order Items -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Item Pesanan</h3>
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
                                <h4 class="font-semibold text-gray-900 dark:text-white">{{ $item->product->name }}</h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Qty: {{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-gray-900 dark:text-white">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    @endforeach

                    <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-bold text-gray-900 dark:text-white">Total:</span>
                            <span class="text-2xl font-bold text-indigo-600 dark:text-indigo-400">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Status -->
        <div class="lg:col-span-1">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 sticky top-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Status Pesanan</h3>
                
                <div class="space-y-4">
                    <div>
                        <span class="block text-sm text-gray-600 dark:text-gray-400 mb-2">Status Saat Ini:</span>
                        <span class="inline-block px-3 py-2 text-sm font-semibold rounded w-full text-center
                            @if($order->status == 'pending') bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200
                            @elseif($order->status == 'processing') bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200
                            @elseif($order->status == 'completed') bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200
                            @else bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200
                            @endif">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>

                    <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST" class="space-y-3">
                        @csrf
                        @method('PATCH')

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Update Status:</label>
                            <select name="status" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>

                        <button type="submit" class="w-full px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                            Update Status
                        </button>
                    </form>

                    <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            <span class="font-medium">Dibuat:</span><br>
                            {{ $order->created_at->format('d M Y, H:i') }}
                        </p>
                    </div>

                    <a href="{{ route('admin.orders.index') }}" class="block w-full text-center px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-400 dark:hover:bg-gray-500 transition">
                        Kembali ke Daftar
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
