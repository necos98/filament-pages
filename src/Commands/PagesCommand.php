<?php

namespace Pages\Commands;

use Illuminate\Console\Command;

class PagesCommand extends Command
{
    public $signature = 'filament-pages';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
