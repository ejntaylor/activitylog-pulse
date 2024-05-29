<?php

namespace Ejntaylor\ActivitylogPulse\Livewire;

use Ejntaylor\ActivitylogPulse\Actions\GetMetrics;

class ActivityLogCard extends BaseActivityLogCard
{
    public function mount()
    {
        $metrics = app(GetMetrics::class)->execute($this->periodAsInterval());
        $this->prepareChartData($metrics, $this->periodAsInterval());
    }

    public function render()
    {
        return view('activitylog-pulse::livewire.activity-log-card', [
            'chartData' => $this->chartData,
            'labels' => $this->labels,
            'header' => 'Activity Log Events',
            'chartId' => $this->chartId,
        ]);
    }
}
