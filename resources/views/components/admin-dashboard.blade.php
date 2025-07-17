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
                <x-article-tab :articles="$articles" />
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

    document.addEventListener('DOMContentLoaded', () => {
        const tabButtons = document.querySelectorAll('.tab-button');
        const tabPanels = document.querySelectorAll('.tab-panel');

        // Fungsi untuk ganti tab
        function activateTab(tabName) {
            tabButtons.forEach(btn => {
                const target = btn.getAttribute('data-tab');
                const isActive = target === tabName;

                btn.classList.toggle('text-blue-600', isActive);
                btn.classList.toggle('bg-gray-100', isActive);
            });

            tabPanels.forEach(panel => {
                panel.classList.toggle('hidden', panel.id !== tabName);
            });
        }

        // Aktifkan tab dari query string (misalnya ?tab=artikel)
        const activeTabFromQuery = new URLSearchParams(window.location.search).get('tab');
        if (activeTabFromQuery) {
            activateTab(activeTabFromQuery);
        }

        // Event listener untuk klik manual
        tabButtons.forEach(button => {
            button.addEventListener('click', () => {
                const target = button.getAttribute('data-tab');
                activateTab(target);
                // Optional: ubah URL tanpa reload halaman
                history.replaceState(null, '', '?tab=' + target);
            });
        });
    });
</script>

