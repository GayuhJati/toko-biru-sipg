@extends('layouts.app')

@section('title', isset($article) ? 'Edit Artikel' : 'Tambah Artikel')

@section('content')
    <div class="max-w-3xl mx-auto p-6 bg-white rounded shadow">
        <h1 class="text-2xl font-bold mb-4">
            {{ isset($article) ? 'Edit Artikel' : 'Tambah Artikel' }}
        </h1>

        <form action="{{ isset($article) ? route('articles.update', $article->id) : route('articles.store') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @if (isset($article))
                @method('PUT')
            @endif

            <div class="mb-4">
                <label for="title" class="block font-medium">Judul Artikel</label>
                <input type="text" name="title" id="title"
                    class="w-full mt-1 border border-gray-300 rounded px-3 py-2"
                    value="{{ old('title', $article->title ?? '') }}" required>
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="author" class="block font-medium">Penulis</label>
                <input type="text" name="author" id="author"
                    class="w-full mt-1 border border-gray-300 rounded px-3 py-2"
                    value="{{ old('author', $article->author ?? '') }}">
                @error('author')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4 flex flex-col gap-4">
                <label for="photo" class="block text-sm font-medium">Gambar</label>

                @if (isset($article) && $article->thumbnail)
                    <img src="{{ asset('storage/' . $article->thumbnail) }}" class="max-w-xs rounded shadow border mb-2"
                        alt="Gambar Saat Ini">
                @endif

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
                <label for="content" class="block font-medium">Konten</label>
                <textarea name="content" id="editor" class="w-full border border-gray-300 rounded px-3 py-2">{{ old('content', $article->content ?? '') }}</textarea>
                @error('content')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <input type="hidden" name="is_published" value="0">

                <label class="inline-flex items-center">
                    <input type="checkbox" name="is_published" value="1" class="mr-2"
                        {{ old('is_published', $article->is_published ?? false) ? 'checked' : '' }}>
                    Publikasikan sekarang
                </label>
            </div>


            <div class="flex justify-end gap-2">
                <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded bg-gray-200 hover:bg-gray-300 text-sm">
                    Batal
                </a>
                <button type="submit" class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700 text-sm">
                    Simpan
                </button>
            </div>
        </form>
    </div>
@endsection


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
