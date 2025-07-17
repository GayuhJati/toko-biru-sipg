@props(['articles'])

<h2 class="text-xl font-semibold mb-4">Artikel</h2>
<p>Manajemen artikel untuk website toko biru</p>
<a href="{{ route('articles.create') }}"
    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-4 inline-block">
    + Tambah Artikel
</a>

<table class="min-w-full bg-white border border-gray-200 rounded">
    <thead>
        <tr class="bg-gray-100 text-left text-sm font-semibold text-gray-700">
            <th class="p-3 border">No</th>
            <th class="p-3 border">Judul</th>
            <th class="p-3 border">Penulis</th>
            <th class="p-3 border">Thumbnail</th>
            <th class="p-3 border">Tanggal</th>
            <th class="p-3 border">Status</th>
            <th class="p-3 border">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($articles as $index => $article)
            <tr class="border-b hover:bg-gray-50 text-sm">
                <td class="p-3 border">{{ $index + 1 }}</td>
                <td class="p-3 border">{{ $article->title }}</td>
                <td class="p-3 border">{{ $article->author ?? '-' }}</td>
                <td class="p-3 border">
                    @if ($article->thumbnail)
                        <img src="{{ asset('storage/' . $article->thumbnail) }}" class="h-16 w-auto rounded shadow"
                            alt="Thumbnail Artikel">
                    @else
                        <span class="text-gray-400">Tidak ada thumbnail</span>
                    @endif
                </td>
                <td class="p-3 border">{{ $article->created_at->format('d M Y') }}</td>
                <td class="p-3 border">
                    @if ($article->is_published)
                        <span class="text-green-600 font-semibold">Dipublikasikan</span>
                    @else
                        <span class="text-gray-400">Draft</span>
                    @endif
                </td>
                <td class="p-3 border flex gap-2">
                    <a href="{{ route('articles.edit', $article) }}"
                        class="bg-yellow-500 text-white text-xs px-3 py-1 rounded">Edit</a>
                    <form id="delete-form-{{ $article->id }}" class="inline" method="POST" action="{{ route('articles.destroy', $article) }}">
                        @csrf
                        @method('DELETE')
                        <button type="button"
                            class="bg-red-500 text-white text-xs px-3 py-1 rounded delete-button" data-id="{{ $article->id }}">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center py-4 text-gray-500">Tidak ada artikel tersedia.</td>
            </tr>
        @endforelse
    </tbody>
</table>


<script src="{{ asset('vendor/js/sweetalert.js') }}"></script>
<script>
    document.querySelectorAll('.delete-button').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault(); 
            const articleId = this.dataset.id;

            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-form-${articleId}`).submit();
                }
            });
        });
    });
</script>



