<div class="p-4 bg-white rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Banner</h2>
    <p class="mb-4">Kelola banner yang ditampilkan di halaman utama.</p>
    <div>
        <form method="POST" action="{{ route('banners.store') }}" enctype="multipart/form-data" class="flex flex-col gap-2 mb-2">
            @csrf
            <label for="title">Judul:</label>
            <input type="text" name="title" class="border rounded w-[500px] h-[30px] mb-3">

            <label for="image">Gambar:</label>
            <input type="file" name="image" class="mb-3">

            <label>
                <input type="checkbox" name="is_active"> Aktif
            </label>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 mt-2 rounded">Simpan</button>
        </form>
    </div>
</div>
