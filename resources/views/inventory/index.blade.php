@extends('layouts.app')

@section('title', 'Inventori Barang')

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-8">
        <div class="bg-white p-6 rounded-xl shadow-md">
            <h2 class="text-xl font-semibold mb-4">Daftar Barang</h2>

            @auth
                @can('isPegawai')
                    <div class="mb-6">
                        <a href="{{ route('pegawai.items.create') }}"
                            class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Input Barang Baru</a>
                    </div>
                @endcan
            @endauth

            <div class="overflow-x-auto">
                <table class="min-w-full table-auto border border-gray-200">
                    <thead class="bg-gray-100 text-left">
                        <tr>
                            <th class="px-4 py-2 border-b" >Foto Barang</th>
                            <th class="px-4 py-2 border-b">Nama Barang</th>
                            <th class="px-4 py-2 border-b">SKU</th>
                            <th class="px-4 py-2 border-b">Harga</th>
                            <th class="px-4 py-2 border-b">Stok</th>
                            <th class="px-4 py-2 border-b">Terakhir Diupdate</th>
                            <th class="px-4 py-2 border-b">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                            <tr>
                                <td class="px-4 py-2 border-b">
                                    @if ($item->photo)
                                        <img src="{{ asset('storage/' . $item->photo) }}" alt="Foto Barang"
                                            class="w-16 h-16 object-cover">
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2 border-b">{{ $item->name }}</td>
                                <td class="px-4 py-2 border-b">{{ $item->sku }}</td>
                                <td class="px-4 py-2 border-b">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                <td class="px-4 py-2 border-b">{{ $item->stock }}</td>
                                <td class="px-4 py-2 border-b">{{ $item->updated_at->format('Y-m-d H:i') }}</td>
                                <td class="px-4 py-2 border-b flex gap-2">
                                    @can('isPegawai')
                                        <a href="{{ route('pegawai.items.edit', $item->id) }}"
                                            class="text-blue-600 hover:underline">Edit</a>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">Belum ada barang.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
