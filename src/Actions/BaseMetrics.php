<?php

namespace Ejntaylor\ActivitylogPulse\Actions;

use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Models\Activity;

abstract class BaseMetrics
{
    /**
     * Must return an array of events to filter.
     */
    abstract protected function getEventFilter();

    public function execute(CarbonInterval $interval)
    {
        $eventFilter = $this->getEventFilter();
        $cutOffDate = Carbon::now()->sub($interval);

        // Fetch the activities grouped by event, year, and month
        $activities = Activity::select(
            DB::raw('event, COUNT(*) as count, YEAR(created_at) as year, MONTH(created_at) as month')
        )
            ->where('created_at', '>=', $cutOffDate)
            ->when(! empty($eventFilter['include']), function ($query) use ($eventFilter) {
                return $query->whereIn('event', $eventFilter['include']);
            })
            ->when(! empty($eventFilter['exclude']), function ($query) use ($eventFilter) {
                return $query->whereNotIn('event', $eventFilter['exclude']);
            })
            ->groupBy('event', 'year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        // Structure the results into a nested array by year and month
        $structuredActivities = [];

        foreach ($activities as $activity) {
            $yearMonth = $activity->year.'-'.sprintf('%02d', $activity->month);
            $structuredActivities[$yearMonth][$activity->event] = [
                'count' => $activity->count,
                'year' => $activity->year,
                'month' => $activity->month,
            ];
        }

        return $structuredActivities;
    }
}
