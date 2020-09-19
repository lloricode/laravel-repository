<?php

namespace Lloricode\LaravelRepository\Commands;

use Illuminate\Console\Command;

class LaravelRepositoryCommand extends Command
{
    public $signature = 'laravel-repository';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
