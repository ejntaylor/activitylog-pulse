<?php

namespace Ejntaylor\ActivitylogPulse\Livewire;

use App\Domain\ActivityMetrics\Actions\GetMetrics;
use Livewire\Attributes\Url;

class ActivityLogCard extends BaseActivityLogCard
{
    public function mount()
    {
        $metrics = app(GetMetrics::class)->execute();
        $this->prepareChartData($metrics);
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


