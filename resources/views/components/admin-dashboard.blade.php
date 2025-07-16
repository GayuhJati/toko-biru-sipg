<div class="p-4 bg-white rounded shadow">
    <div class="w-full">
        <!-- Tab Header -->
        <ul id="tabs"
            class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 ">
            <li class="me-2">
                <button data-tab="banner"
                    class="tab-button inline-block p-4 text-blue-600 bg-gray-100 rounded-t-lg active">
                    Banner
                </button>
            </li>
            <li class="me-2">
                <button data-tab="artikel"
                    class="tab-button inline-block p-4 rounded-t-lg hover:text-gray-600 hover:bg-gray-50 ">
                    Artikel
                </button>
            </li>
        </ul>

        <!-- Tab Contents -->
        <div id="tab-content">
            <!-- Banner Content -->
            <div id="banner" class="tab-panel p-4 bg-white rounded shadow">
                <x-banner-tab :banners="$banners" />
            </div>

            <!-- Artikel Content -->
            <div id="artikel" class="tab-panel p-4 bg-white rounded shadow hidden">
                <h2 class="text-xl font-semibold mb-4">Artikel</h2>
                <p>Konten untuk manajemen artikel akan ditampilkan di sini.</p>
            </div>
        </div>
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

    const tabButtons = document.querySelectorAll('.tab-button');
    const tabPanels = document.querySelectorAll('.tab-panel');

    tabButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Remove active classes
            tabButtons.forEach(btn => btn.classList.remove('text-blue-600', 'bg-gray-100'));
            tabPanels.forEach(panel => panel.classList.add('hidden'));

            // Add active to clicked
            button.classList.add('text-blue-600', 'bg-gray-100');
            const target = button.getAttribute('data-tab');
            document.getElementById(target).classList.remove('hidden');
        });
    });
</script>
