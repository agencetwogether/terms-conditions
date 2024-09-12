<?php

namespace Agencetwogether\TermsConditions\Commands;

use Illuminate\Console\Command;

class TermsConditionsCommand extends Command
{
    public $signature = 'terms-conditions';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
