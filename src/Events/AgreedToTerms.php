<?php

namespace Agencetwogether\TermsConditions\Events;

use Agencetwogether\TermsConditions\Models\Term;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AgreedToTerms
{
    use Dispatchable;
    use SerializesModels;

    public $user;

    public $term;

    public function __construct($user, Term $term)
    {
        $this->user = $user;
        $this->term = $term;
    }
}
