<?php

namespace Agencetwogether\TermsConditions\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Term extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'terms';

    /**
     * The model's attributes.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'terms',
        'is_published',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'term_user')
            ->using(TermUser::class)
            ->withTimestamps()
            ->withPivot('accepted_at');
    }
}
