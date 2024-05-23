<x-pulse::card :cols="$cols" :rows="$rows" :class="$class">
    <x-pulse::card-header name="{{$header}}">
    </x-pulse::card-header>

    <x-pulse::scroll :expand="$expand">
        <canvas id="{{ $chartId }}"></canvas>
    </x-pulse::scroll>
</x-pulse::card>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('{{ $chartId }}').getContext('2d');
        const activityLogChart = new window.Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($labels), // Month labels should be here
                datasets: @json($chartData)
            },
            options: {
                scales: {
                    x: { stacked: true },
                    y: { stacked: true, beginAtZero: true }
                },
                plugins: {
                    legend: { display: false }
                },
                responsive: true,
                maintainAspectRatio: false,
                interaction: { intersect: false }
            }
        });
    });

</script>
