<?php

namespace Ejntaylor\ActivitylogPulse\Commands;

use Illuminate\Console\Command;

class ActivitylogPulseCommand extends Command
{
    public $signature = 'activitylog-pulse';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
