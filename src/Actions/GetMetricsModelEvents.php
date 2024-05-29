<?php

namespace Ejntaylor\ActivitylogPulse\Actions;

class GetMetricsModelEvents extends BaseMetrics
{
    protected function getEventFilter()
    {
        return [
            'include' => ['created', 'deleted', 'updated'],
        ];
    }
}
