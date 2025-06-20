@extends('layouts.app')

@section('title', isset($item) ? 'Edit Barang' : 'Input Barang')

@section('content')
    <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-lg font-semibold mb-4">
            {{ isset($item) ? 'Edit Barang' : 'Input Barang' }}
        </h2>

        <form action="{{ isset($item) ? route('pegawai.items.update', $item->id) : route('pegawai.items.store') }} "
            enctype="multipart/form-data" method="POST">
            @csrf
            @if (isset($item))
                @method('PUT')
            @endif

            <div class="mb-4 flex flex-col gap-4">
                <label for="photo" class="block text-sm font-medium">Gambar Produk</label>
                <div id="preview-container" class="mt-4 hidden">
                    <p class="text-sm text-gray-600 mb-2">Preview:</p>
                    <img id="preview" src="#" alt="Preview Gambar" class="max-w-xs rounded shadow border" />
                </div>
                <input type="file" name="photo" id="photo" accept="image/*" onchange="previewImage(event)"
                    class="w-full border rounded px-3 py-2 @error('photo') border-red-500 @enderror">

                @error('photo')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>


            <div class="mb-4">
                <label for="name" class="block text-sm font-medium">Nama Barang</label>
                <input type="text" name="name" id="name" value="{{ old('name', $item->name ?? '') }}"
                    class="w-full border rounded px-3 py-2">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="sku" class="block text-sm font-medium">SKU</label>
                <input type="text" name="sku" id="sku" value="{{ old('sku', $item->sku ?? '') }}"
                    class="w-full border rounded px-3 py-2">
                @error('sku')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="price" class="block text-sm font-medium">Harga</label>
                <input type="text" name="price" id="price"
                    value="{{ old('price', isset($item) ? number_format($item->price, 0, ',', '.') : '') }}"
                    oninput="formatRupiah(this)" class="format-harga w-full border rounded px-3 py-2">
                @error('price')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>


            <div class="mb-4">
                <label for="stock" class="block text-sm font-medium">Stok Awal</label>
                <input type="number" name="stock" id="stock" value="{{ old('stock', $item->stock ?? 0) }}"
                    class="w-full border rounded px-3 py-2">
                @error('stock')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>


            <div class="mb-6">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    {{ isset($item) ? 'Update' : 'Simpan' }}
                </button>
                <a href="{{ route('pegawai.items.index') }}" class="ml-3 text-gray-600 hover:underline">Batal</a>
            </div>
        </form>
    </div>
@endsection


<script>
    function formatRupiah(el) {
        let angka = el.value.replace(/\D/g, '');
        el.value = angka.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }
    function previewImage(event) {
        const input = event.target;
        const previewContainer = document.getElementById('preview-container');
        const preview = document.getElementById('preview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function (e) {
                preview.src = e.target.result;
                previewContainer.classList.remove('hidden');
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
    // document.querySelectorAll('.format-harga').forEach(function(input) {
    //     input.addEventListener('input', function(e) {
    //         let value = this.value.replace(/\D/g, '');
    //         value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    //         this.value = value;
    //     });
    // });
</script>
