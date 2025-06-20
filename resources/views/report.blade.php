@extends('layouts.app')

@section('title', 'Laporan')

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-8">
        <div class="bg-white p-6 rounded-xl shadow-md">
            <h2 class="text-2xl font-semibold mb-6">Rekap Penjualan</h2>

            <form method="GET" action="{{ route('sales.report') }}"
                class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div>
                    <label for="from" class="block text-sm font-medium text-gray-700 mb-1">Dari Tanggal</label>
                    <input type="date" name="from" id="from" value="{{ request('from') }}"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label for="to" class="block text-sm font-medium text-gray-700 mb-1">Sampai Tanggal</label>
                    <input type="date" name="to" id="to" value="{{ request('to') }}"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="flex items-end gap-2">
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">Filter</button>
                    <a href="{{ route('pemilik.sales.export', request()->only(['from', 'to'])) }}"
                        class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition">Export Excel</a>
                </div>
            </form>

            <div class="overflow-x-auto">
                <div class="overflow-y-auto max-h-[500px] border border-gray-200 rounded-md">
                    <table class="min-w-full bg-white">
                        <thead class="bg-gray-100 text-left text-sm font-semibold text-gray-700">
                            <tr>
                                <th class="px-4 py-2 border-b">Tanggal</th>
                                <th class="px-4 py-2 border-b">No. Invoice</th>
                                <th class="px-4 py-2 border-b">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($sales as $sale)
                                <tr class="text-sm text-gray-700 hover:bg-gray-50">
                                    <td class="px-4 py-2 border-b">{{ $sale->created_at->format('Y-m-d') }}</td>
                                    <td class="px-4 py-2 border-b">{{ $sale->invoice_number }}</td>
                                    <td class="px-4 py-2 border-b">Rp {{ number_format($sale->total, 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center px-4 py-4 text-gray-500">Tidak ada data penjualan
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
