<?php

namespace App\Domain\ActivityMetrics\Actions;

class GetMetricsModelEvents extends BaseMetrics
{
    protected function getEventFilter()
    {
        return [
            'include' => ['action', 'created', 'deleted', 'updated'],
        ];
    }
}
