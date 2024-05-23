<?php

namespace Ejntaylor\ActivitylogPulse;

use App\Livewire\ActivityLogCard;
use App\Livewire\ActivityLogModelEventsCard;
use Illuminate\Foundation\Application;
use Livewire\LivewireManager;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Ejntaylor\ActivitylogPulse\Commands\ActivitylogPulseCommand;

class ActivitylogPulseServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'apps-load');

        $this->callAfterResolving('livewire', function (LivewireManager $livewireManager, Application $app) {
            $livewireManager->component('pulse.activity-log-card', ActivityLogCard::class);
            $livewireManager->component('pulse.activity-log-model-events-card', ActivityLogModelEventsCard::class);
        });

        $package
            ->name('activitylog-pulse')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_activitylog-pulse_table')
            ->hasCommand(ActivitylogPulseCommand::class);
    }
}
