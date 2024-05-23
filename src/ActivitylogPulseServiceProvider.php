<?php

namespace Ejntaylor\ActivitylogPulse;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Ejntaylor\ActivitylogPulse\Commands\ActivitylogPulseCommand;

class ActivitylogPulseServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('activitylog-pulse')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_activitylog-pulse_table')
            ->hasCommand(ActivitylogPulseCommand::class);
    }
}
