<?php

namespace Ejntaylor\ActivitylogPulse\Actions;

class GetMetrics extends BaseMetrics
{
    protected function getEventFilter()
    {
        return [
            'exclude' => ['action', 'created', 'deleted', 'updated'],
        ];
    }
}
