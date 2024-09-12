<?php

namespace Agencetwogether\TermsConditions\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Agencetwogether\TermsConditions\TermsConditions
 */
class TermsConditions extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Agencetwogether\TermsConditions\TermsConditions::class;
    }
}
