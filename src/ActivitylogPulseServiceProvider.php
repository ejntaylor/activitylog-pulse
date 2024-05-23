<?php

namespace Ejntaylor\ActivitylogPulse;

use Ejntaylor\ActivitylogPulse\Commands\ActivitylogPulseCommand;
use Ejntaylor\ActivitylogPulse\Livewire\ActivityLogCard;
use Ejntaylor\ActivitylogPulse\Livewire\ActivityLogModelEventsCard;
use Illuminate\Foundation\Application;
use Livewire\LivewireManager;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class ActivitylogPulseServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('activitylog-pulse')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_activitylog-pulse_table')
            ->hasCommand(ActivitylogPulseCommand::class);
    }

    public function packageBooted(): void
    {
        $this->callAfterResolving('livewire', function (LivewireManager $livewire, Application $app) {
            $livewire->component('pulse.activity-log-card', ActivityLogCard::class);
            $livewire->component('pulse.activity-log-model-events-card', ActivityLogModelEventsCard::class);
        });
    }
}
