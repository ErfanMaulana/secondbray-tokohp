<x-admin-layout>
    <x-slot name="title">Edit Merek HP - Admin Secondbray</x-slot>
    <x-slot name="header">Edit Merek HP: {{ $brand->name }}</x-slot>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
            <form action="{{ route('admin.brands.update', $brand) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nama Merek *</label>
                        <input type="text" name="name" value="{{ old('name', $brand->name) }}" required class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                        @error('name')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex gap-3">
                        <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg">
                            Update Merek
                        </button>
                        <a href="{{ route('admin.brands.index') }}" class="px-4 py-2 bg-gray-300 dark:bg-gray-600 hover:bg-gray-400 dark:hover:bg-gray-500 text-gray-700 dark:text-gray-200 rounded-lg">
                            Batal
                        </a>
                    </div>
                </div>
            </form>
    </div>
</x-admin-layout>
