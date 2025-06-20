<nav class="bg-white shadow mb-6">
    <div class="container mx-auto px-[50px] py-4 flex justify-between items-center">
        <a href="{{ route('dashboard') }}" class="text-lg font-bold text-blue-600 flex flex-row items-center gap-2">
            <img class="w-[30px]"
                src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAABbklEQVR4nO2asUoDURBFL4GspLQUg7WVNlZBsVbxI7TQUiv9BJNvUPyTJNjpP4ggupZiazXy4CKPhZ23UeOb1TkwsMzMPu7N7MCGBHAcZ1YKACMALwDEWJQAhtSYZGhAsCTiookRi5OQSgSNSeIbBgA2E9e5IkncHMRuJa5bYUQMR5I/YaRvQKA0jGXNyB6bbpVJIXPtjvkdKJyz6TKzWK12xfwZFK7ZdGLYyCnzwVAtN2zazyxWq+0yP4XCA5s2DBtZZf4eCm9sWsosVqstMv8KhXc2LRg2UjAftNbyxKZ+ZrFabYX5RyhM2XRQyXeigzuZa4fMTzQjx9EXmG0APQDrAMbRweF6jY/fb9Z61FQyf6QZ6TZ4NbASXSSQlkSS3ALFjVTI/UmLT6TCl5frG/fNeqbM9UY3oiM+EfijBV92BfEdge8IfEcUxHcEP7sj5t5+m+BGMIeJlC2YyPO/+nm6oJm6ybTmDwOO4+CTDw7NceLw3voRAAAAAElFTkSuQmCC"
                alt="online-store">
            Toko Biru
        </a>

        <div class="space-x-4">
            @auth
                @can('isPegawai')
                    {{-- <a href="{{ route('pegawai.transactions') }}" class="text-sm hover:text-blue-600">Transaksi</a> --}}
                    <a href="{{ route('inventory.index') }}" class="text-sm hover:text-blue-600">Inventory</a>
                @endcan

                @can('isPemilik')
                    {{-- <a href="{{ route('pemilik.transactions') }}" class="text-sm hover:text-blue-600">Inventori</a> --}}
                    <a href="{{ route('dashboard') }}" class="text-sm hover:text-blue-600">Dashboard</a>
                    <a href="{{ route('report') }}" class="text-sm hover:text-blue-600">Report</a>
                    <a href="{{ route('pemilik.inventory') }}" class="text-sm hover:text-blue-600">Inventory</a>
                @endcan

                @can('isAdmin')
                    {{-- <a href="{{ route('admin.transactions') }}" class="text-sm hover:text-blue-600">Inventori</a> --}}
                    {{-- <a href="{{ route('admin.users.index') }}" class="text-sm hover:text-blue-600">Kelola User</a> --}}
                @endcan

                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-sm text-red-600 hover:underline">Logout</button>
                </form>
            @endauth
        </div>
    </div>
</nav>
