<?php

namespace Agencetwogether\TermsConditions\Concerns;

use Agencetwogether\TermsConditions\Models\Term;
use Agencetwogether\TermsConditions\Models\TermUser;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasAcceptsTerms
{
    public function terms(): BelongsToMany
    {
        return $this->belongsToMany(Term::class, 'term_user')
            ->using(TermUser::class)
            ->withTimestamps()
            ->withPivot('accepted_at');
    }

    public function term()
    {
        return $this->belongsTo(TermUser::class, 'id', 'user_id');
    }

    public function hasAcceptedTerms(): bool
    {
        return $this->terms->contains(Term::latest()->where('is_published', true)->first()->id);
        //return $this->terms->contains(Term::latest()->where('is_published', true)->first()->id);
    }
}
