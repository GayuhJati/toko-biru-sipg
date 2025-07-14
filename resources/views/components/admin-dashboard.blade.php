<div class="p-4 bg-white rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Banner</h2>
    <p class="mb-4">Kelola banner yang ditampilkan di halaman utama.</p>

    <!-- Button to open modal -->
    <button onclick="document.getElementById('modal').classList.remove('hidden')"
        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-4">
        + Tambah Banner
    </button>

    <div id="modal" class="fixed inset-0 bg-black/30  items-center justify-center hidden">
        <div class="bg-white p-6 rounded shadow-lg w-[400px]">
            <h2 class="text-lg font-bold mb-4">Upload Banner</h2>
            <form method="POST" action="{{ route('banners.store') }}" enctype="multipart/form-data"
                class="flex flex-col gap-2 mb-2">
                @csrf
                <label for="title">Judul:</label>
                <input type="text" name="title" class="border rounded w-full h-[30px] mb-3">

                <label for="image">Gambar:</label>
                <div id="preview-container" class="mt-4 hidden">
                    <p class="text-sm text-gray-600 mb-2">Preview:</p>
                    <img id="preview" src="#" alt="Preview Gambar" class="max-w-xs rounded shadow border" />
                </div>
                <input type="file" name="image" class="mb-3" accept="image/*" onchange="previewImage(event)">


                <label>
                    <input type="checkbox" name="is_active"> Aktif
                </label>

                <button type="submit" class="bg-blue-500 text-white px-4 py-2 mt-2 rounded">Simpan</button>
            </form>
        </div>
    </div>
    <div class="p-4 bg-white rounded shadow">
        <h2 class="text-xl font-semibold mb-4">Daftar Banner</h2>

        <table class="min-w-full bg-white border border-gray-200 rounded">
            <thead>
                <tr class="bg-gray-100 text-left text-sm font-semibold text-gray-700">
                    <th class="p-3 border">No</th>
                    <th class="p-3 border">Judul</th>
                    <th class="p-3 border">Gambar</th>
                    <th class="p-3 border">Status</th>
                    <th class="p-3 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($banners as $index => $banner)
                    <tr class="border-b hover:bg-gray-50 text-sm">
                        <td class="p-3 border">{{ $index + 1 }}</td>
                        <td class="p-3 border">{{ $banner->title ?? '-' }}</td>
                        <td class="p-3 border">
                            <img src="{{ asset('storage/' . $banner->image) }}" class="h-16 w-auto rounded shadow"
                                alt="Banner">
                        </td>
                        <td class="p-3 border">
                            @if ($banner->is_active)
                                <span class="text-green-600 font-semibold">Aktif</span>
                            @else
                                <span class="text-gray-400">Nonaktif</span>
                            @endif
                        </td>
                        <td class="p-3 border flex gap-2">
                            <form method="POST" action="{{ route('banners.destroy', $banner) }}">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Yakin hapus banner ini?')"
                                    class="bg-red-500 text-white text-xs px-3 py-1 rounded">Hapus</button>
                            </form>
                            {{-- Tombol Edit (jika ada rutenya) --}}
                            {{-- <a href="{{ route('banners.edit', $banner) }}" class="bg-blue-500 text-white text-xs px-3 py-1 rounded">Edit</a> --}}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-gray-500">Tidak ada banner tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>


</div>

<script>
    function previewImage(event) {
        const input = event.target;
        const previewContainer = document.getElementById('preview-container');
        const preview = document.getElementById('preview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                previewContainer.classList.remove('hidden');
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
