<?php

namespace Ejntaylor\ActivitylogPulse\Livewire;

use Laravel\Pulse\Livewire\Card;

class BaseActivityLogCard extends Card
{
    public array $chartData;

    public array $labels;

    public string $chartId;

    protected function prepareChartData($metrics)
    {
        $this->setChartId();
        $now = now();
        $sixMonthsAgo = $now->copy()->subMonths(5)->startOfMonth();

        $filteredMetrics = collect($metrics)
            ->filter(function ($value, $key) use ($sixMonthsAgo) {
                return \Carbon\Carbon::createFromFormat('Y-m', $key) >= $sixMonthsAgo;
            })
            ->sortByDesc(function ($value, $key) {
                return $key;
            });

        $sortedMonths = $filteredMetrics->keys()->all();

        $this->labels = collect($sortedMonths)->map(function ($month) {
            return \Carbon\Carbon::createFromFormat('Y-m', $month)->format('F');
        })->all();

        $events = $filteredMetrics->flatMap(fn ($data) => array_keys($data))->unique()->sort();

        $this->chartData = $events->map(function ($event) use ($filteredMetrics, $sortedMonths) {
            $data = collect($sortedMonths)->map(fn ($month) => $filteredMetrics[$month][$event]['count'] ?? 0)->all();

            return [
                'label' => $event,
                'data' => $data,
                'backgroundColor' => $this->getColorForEvent($event),
                'borderColor' => $this->getColorForEvent($event),
                'borderWidth' => 1,
            ];
        })->values()->all();
    }

    protected function getColorForEvent($label)
    {
        $colors = [
            '#007bff', '#28a745', '#dc3545', '#ffc107', '#17a2b8',
            '#6c757d', '#fd7e14', '#e83e8c', '#6610f2', '#6f42c1',
        ];
        $index = crc32($label) % count($colors);

        return $colors[$index];
    }

    protected function setChartId()
    {
        $this->chartId = 'activity-log-chart-'.\Illuminate\Support\Str::random(8);
    }
}
