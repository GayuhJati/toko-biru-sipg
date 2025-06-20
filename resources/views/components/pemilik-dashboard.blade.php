
<div class="container p-4 bg-white rounded shadow">
    <div class="mb-4 flex gap-2">
        <input type="date" id="fromDate" class="border rounded p-2" />
        <input type="date" id="toDate" class="border rounded p-2" />
        <button id="filterBtn" class="bg-blue-500 text-white px-4 py-2 rounded">Filter</button>
    </div>
    <div id="errorMsg" style="color:red; margin-top: 10px;"></div>
    <canvas id="salesChart" width="400" height="200"></canvas>
</div>

<script src="{{ asset("vendor/js/chart.js") }}"></script>
<script>
    let chartInstance;

    function loadChart(from = '', to = '') {
        const params = new URLSearchParams();
        if (from) params.append('from', from);
        if (to) params.append('to', to);

        fetch(`/pemilik/dashboard/line-chart?${params.toString()}`)
            .then(response => response.json())
            .then(data => {
                const labels = data.map(item => item.date);
                const values = data.map(item => item.total_sales);

                const ctx = document.getElementById('salesChart').getContext('2d');

                if (chartInstance) chartInstance.destroy();

                chartInstance = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Total Penjualan',
                            data: values,
                            borderColor: 'rgba(75, 192, 192, 1)',
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            fill: true,
                            tension: 0.3,
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
    }

    document.addEventListener("DOMContentLoaded", function () {
        loadChart();

        document.getElementById('filterBtn').addEventListener('click', () => {
            const from = document.getElementById('fromDate').value;
            const to = document.getElementById('toDate').value;
            const errorDiv = document.getElementById('errorMsg');

            errorDiv.textContent = '';

            if (from && to && from > to) {
                errorDiv.textContent = 'Tanggal awal tidak boleh lebih besar dari tanggal akhir.';
                return;
            }
            loadChart(from, to);
        });
    });
</script>


