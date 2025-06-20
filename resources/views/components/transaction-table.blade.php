<div class="bg-white shadow rounded-lg p-6">
    <h2 class="text-lg font-semibold mb-4">Transaksi Terbaru</h2>

    <div class="overflow-x-auto">
        <table class="min-w-full table-auto border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border-b">Tanggal</th>
                    <th class="px-4 py-2 border-b">Nama Barang</th>
                    <th class="px-4 py-2 border-b">SKU</th>
                    <th class="px-4 py-2 border-b">Jenis</th>
                    <th class="px-4 py-2 border-b">Jumlah</th>
                    <th class="px-4 py-2 border-b">Pegawai</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transactions as $trx)
                    <tr>
                        <td class="px-4 py-2 border-b">{{ $trx->created_at->format('Y-m-d') }}</td>
                        <td class="px-4 py-2 border-b">{{ $trx->item->name ?? '-' }}</td>
                        <td class="px-4 py-2 border-b">{{ $trx->item->sku ?? '-' }}</td>
                        <td class="px-4 py-2 border-b">
                            <span class="text-white text-sm px-2 py-1 rounded-full {{ $trx->type === 'in' ? 'bg-green-500' : 'bg-red-500' }}">
                                {{ $trx->type === 'in' ? 'Masuk' : 'Keluar' }}
                            </span>
                        </td>
                        <td class="px-4 py-2 border-b">{{ $trx->quantity }}</td>
                        <td class="px-4 py-2 border-b">{{ $trx->user->name ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">Belum ada transaksi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
