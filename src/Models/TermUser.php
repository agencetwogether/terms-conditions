<?php

namespace Agencetwogether\TermsConditions\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class TermUser extends Pivot
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'term_user';

    /**
     * The model's attributes.
     *
     * @var array
     */
    protected $fillable = [
        'accepted_at',
    ];

    protected function casts(): array
    {
        return [
            'accepted_at' => 'datetime',
        ];
    }
}
