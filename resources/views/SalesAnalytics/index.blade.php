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

{{-- Toggle Buttons --}}
<div class="mb-3 flex gap-2">
    <button onclick="setMode('sales')" class="btn btn-sm btn-primary">
        Revenue
    </button>

    <button onclick="setMode('count')" class="btn btn-sm btn-secondary">
        Number of Sales
    </button>
</div>

<div class="bg-white p-4 rounded shadow">
    <canvas id="salesChart" height="100"></canvas>
</div>

<script>
let chart;
let mode = 'sales'; // default view

function setMode(newMode) {
    mode = newMode;
    loadChart();
}

function loadChart() {
    const start = document.getElementById('start_date').value;
    const end = document.getElementById('end_date').value;

    fetch(`/salesAnalytics/data?start_date=${start}&end_date=${end}`)
        .then(res => res.json())
        .then(res => {

            const labels = res.labels;

            let dataset;

            if (mode === 'sales') {
                dataset = {
                    label: 'Total Revenue',
                    data: res.data,
                    borderWidth: 2,
                    tension: 0.3
                };
            } else {
                dataset = {
                    label: 'Number of Sales',
                    data: res.count,
                    borderWidth: 2,
                    tension: 0.3
                };
            }

            if (chart) chart.destroy();

            const ctx = document.getElementById('salesChart').getContext('2d');

            chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [dataset]
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
    const today = new Date().toISOString().split('T')[0];

    document.getElementById('start_date').value = today;
    document.getElementById('end_date').value = today;

    loadChart();
}

// auto load today / preset
window.onload = function () {
    const urlParams = new URLSearchParams(window.location.search);
    const preset = urlParams.get('preset');

    let start = new Date();
    let end = new Date();

    if (preset === 'week') {
        start.setDate(end.getDate() - 6);
    }

    if (preset === 'month') {
        start.setDate(1);
    }

    document.getElementById('start_date').value = start.toISOString().split('T')[0];
    document.getElementById('end_date').value = end.toISOString().split('T')[0];

    loadChart();
};
</script>

@endsection