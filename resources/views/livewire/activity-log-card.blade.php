<x-pulse::card :cols="$cols" :rows="$rows" :class="$class">
    <x-pulse::card-header name="{{$header}}">
    </x-pulse::card-header>

    @php
        $type = $type ?? 'list';
    @endphp

    @if($type === 'chart')
        <x-pulse::scroll :expand="$expand">
            <canvas id="{{ $chartId }}"></canvas>
        </x-pulse::scroll>
    @else
        <x-pulse::scroll :expand="$expand" wire:poll.5s="">
            <div class="flex flex-col gap-6">
                <div>
                    <x-pulse::table>
                        <colgroup>
                            <col width="100%"/>
                            <col width="0%"/>
                            <col width="0%"/>
                            <col width="0%"/>
                        </colgroup>
                        <x-pulse::thead>
                            <tr>
                                <x-pulse::th>Event</x-pulse::th>
                                <x-pulse::th class="text-right whitespace-nowrap">Quantity</x-pulse::th>
                            </tr>
                        </x-pulse::thead>
                        <tbody>
                        @foreach ($chartData as $key => $interaction)
                            <tr wire:key="spacer-{{ $interaction['label'] }}" class="h-2 first:h-0"></tr>
                            <tr wire:key="row-{{ $interaction['label'] }}">
                                <x-pulse::td class="max-w-[1px]">
                                    <code class="block text-xs text-gray-900 dark:text-gray-100 truncate"
                                          title="{{ $interaction['label'] }}">
                                        {{ $interaction['label'] }}
                                    </code>
                                </x-pulse::td>
                                <x-pulse::td numeric class="text-gray-700 dark:text-gray-300 font-bold">
                                    {{ (int) $interaction['data'][0] }} {{-- Assuming 'data' is always an array with one element --}}
                                </x-pulse::td>
                            </tr>
                        @endforeach
                        </tbody>
                    </x-pulse::table>
                </div>
            </div>
        </x-pulse::scroll>
    @endif

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
                    x: {stacked: true},
                    y: {stacked: true, beginAtZero: true}
                },
                plugins: {
                    legend: {display: false}
                },
                responsive: true,
                maintainAspectRatio: false,
                interaction: {intersect: false}
            }
        });
    });

</script>
