<?php

namespace App\Livewire;

use App\Domain\ActivityMetrics\Actions\GetMetricsModelEvents;

class ActivityLogModelEventsCard extends BaseActivityLogCard
{
    public function mount()
    {
        $metrics = app(GetMetricsModelEvents::class)->execute();
        $this->prepareChartData($metrics);
    }

    public function render()
    {
        return view('livewire.activity-log-card', [
            'chartData' => $this->chartData,
            'labels' => $this->labels,
            'header' => 'Activity Log Model Events',
        ]);
    }
}

