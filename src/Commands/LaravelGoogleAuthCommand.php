<?php

namespace JustYork\LaravelGoogleAuth\Commands;

use Illuminate\Console\Command;

class LaravelGoogleAuthCommand extends Command
{
    public $signature = 'laravel-google-auth';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
