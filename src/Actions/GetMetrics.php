<?php

namespace App\Domain\ActivityMetrics\Actions;

class GetMetrics extends BaseMetrics
{
    protected function getEventFilter()
    {
        return [
            'exclude' => ['action', 'created', 'deleted', 'updated'],
        ];
    }
}
