<?php

namespace Ejntaylor\ActivitylogPulse\Livewire;

use Carbon\CarbonInterval;
use Laravel\Pulse\Livewire\Card;

class BaseActivityLogCard extends Card
{
    public array $chartData;

    public array $labels;

    public string $chartId;

    protected function prepareChartData($metrics, CarbonInterval $interval)
    {
        $this->setChartId();
        $now = now();
        $cutOffDate = $now->copy()->sub($interval);

        $totalHours = $interval->totalHours;
        $labelFormat = 'M d, H:i';
        $keyFormat = 'Y-m-d H';

        if ($totalHours > 24) {
            $labelFormat = 'M d';
            $keyFormat = 'Y-m-d';
        }
        if ($totalHours > 24 * 30) {
            $labelFormat = 'M Y';
            $keyFormat = 'Y-m';
        }

        $filteredMetrics = collect($metrics)
            ->mapWithKeys(function ($value, $key) use ($keyFormat) {
                $date = \Carbon\Carbon::create($key);

                return [$date->format($keyFormat) => $value];
            })
            ->sortByDesc(function ($value, $key) {
                return $key;
            });

        $sortedKeys = $filteredMetrics->keys()->all();
        $this->labels = collect($sortedKeys)->map(function ($key) use ($labelFormat, $keyFormat) {
            return \Carbon\Carbon::createFromFormat($keyFormat, $key)->format($labelFormat);
        })->all();

        // Group data by events
        $events = $filteredMetrics->flatMap(fn ($data) => array_keys($data))->unique()->sort();

        // Prepare chart data
        $this->chartData = $events->map(function ($event) use ($filteredMetrics, $sortedKeys) {
            $data = collect($sortedKeys)->map(fn ($key) => $filteredMetrics[$key][$event]['count'] ?? 0)->all();

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
