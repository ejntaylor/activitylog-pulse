<?php

namespace Ejntaylor\ActivitylogPulse\Livewire;

use Ejntaylor\ActivitylogPulse\Actions\GetMetricsModelEvents;

class ActivityLogModelEventsCard extends BaseActivityLogCard
{
    public function mount()
    {
        $metrics = app(GetMetricsModelEvents::class)->execute($this->periodAsInterval());
        $this->prepareChartData($metrics, $this->periodAsInterval());
    }

    public function render()
    {
        return view('activitylog-pulse::livewire.activity-log-card', [
            'chartData' => $this->chartData,
            'labels' => $this->labels,
            'header' => 'Activity Log Model Events',
        ]);
    }
}
