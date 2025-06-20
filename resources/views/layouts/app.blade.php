<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin CMS')</title>
    @vite('resources/css/app.css') {{-- Pastikan kamu pakai Vite dan Tailwind sudah setup --}}
</head>

<body class="bg-gray-100 text-gray-800">

    {{-- Navbar --}}
    <x-navbar />

    {{-- Admin Dashboard --}}

    {{-- Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Flash Message --}}
    @if (session('success'))
        <div class="container mx-auto px-4 mt-4">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        </div>
    @endif

</body>

</html>
