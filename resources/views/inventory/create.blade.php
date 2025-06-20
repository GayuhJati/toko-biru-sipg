@extends('layouts.app')

@section('title', 'Input Barang')

@section('content')
<div class="container mx-auto px-6 py-6">
    <div class="bg-white shadow rounded p-6 max-w-xl mx-auto">
        <h2 class="text-xl font-semibold mb-4">Input Barang</h2>

        <form method="POST" action="{{ route('inventory.store') }}" class="space-y-4">
            @csrf

            <div>
                <label for="item_id" class="block text-sm font-medium">Nama Barang</label>
                <select name="item_id" id="item_id" class="w-full border-gray-300 rounded px-3 py-2">
                    <option value="">-- Pilih Barang --</option>
                    @foreach ($items as $item)
                        <option value="{{ $item->id }}" {{ (old('item_id') ?? $selectedItem) == $item->id ? 'selected' : '' }}>
                            {{ $item->name }} ({{ $item->sku }})
                        </option>
                    @endforeach
                </select>
                @error('item_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="type" class="block text-sm font-medium">Jenis Transaksi</label>
                <select name="type" id="type" class="w-full border-gray-300 rounded px-3 py-2">
                    <option value="">-- Pilih Jenis --</option>
                    <option value="in" {{ old('type') == 'in' ? 'selected' : '' }}>Masuk</option>
                    <option value="out" {{ old('type') == 'out' ? 'selected' : '' }}>Keluar</option>
                </select>
                @error('type') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="quantity" class="block text-sm font-medium">Jumlah</label>
                <input type="number" name="quantity" id="quantity" value="{{ old('quantity') }}"
                    class="w-full border-gray-300 rounded px-3 py-2" min="1">
                @error('quantity') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex justify-end gap-2">
                <a href="{{ route('inventory.index') }}" class="text-sm px-4 py-2 text-gray-500 hover:underline">Kembali</a>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
