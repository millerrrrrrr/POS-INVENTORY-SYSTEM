@extends('layout')
@section('title', 'Sales Analytics')
@section('pagetitle', 'Sales Analytics')

@section('main')

<form id="filterForm" class="mb-4 flex gap-2 items-end text-white">
    
    <div>
        <label for="start_date" class="text-black">From:</label>
        <input type="date" name="start_date" id="start_date" class="input input-bordered">
    </div>

    <div>
        <label for="end_date" class="text-black">To:</label>
        <input type="date" name="end_date" id="end_date" class="input input-bordered">
    </div>

    <div class="flex gap-2">
        <button type="button" onclick="loadChart()" class="btn btn-primary">
            Filter
        </button>

        <button type="button" onclick="resetChart()" class="btn bg-red-500 hover:bg-red-600 text-white border-none">
            Clear
        </button>
    </div>

</form>

<div class="bg-white p-4 rounded shadow">
    <canvas id="salesChart" height="100"></canvas>
</div>

<script>
let chart;

function loadChart() {
    const start = document.getElementById('start_date').value;
    const end = document.getElementById('end_date').value;

    fetch(`/salesAnalytics/data?start_date=${start}&end_date=${end}`)
        .then(res => res.json())
        .then(res => {

            const labels = res.labels;
            const values = res.data;

            if (chart) chart.destroy();

            const ctx = document.getElementById('salesChart').getContext('2d');

            chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Total Sales',
                        data: values,
                        borderWidth: 2,
                        tension: 0.3
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

function resetChart() {
    document.getElementById('start_date').value = '';
    document.getElementById('end_date').value = '';
    loadChart();
}

// auto load today
window.onload = function () {
    let today = new Date().toISOString().split('T')[0];

    document.getElementById('start_date').value = today;
    document.getElementById('end_date').value = today;

    loadChart();
};
</script>

@endsection