<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array<string>|bool
     */
    protected $guarded = [];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'personal_info' => \Illuminate\Database\Eloquent\Casts\AsArrayObject::class,
            'academic_info' => \Illuminate\Database\Eloquent\Casts\AsArrayObject::class,
            'participation_details' => \Illuminate\Database\Eloquent\Casts\AsArrayObject::class,
            'health_emergency' => \Illuminate\Database\Eloquent\Casts\AsArrayObject::class,
            'declaration' => \Illuminate\Database\Eloquent\Casts\AsArrayObject::class,
            'advanced_info' => \Illuminate\Database\Eloquent\Casts\AsArrayObject::class,
        ];
    }

    /**
     * Get the user that owns the registration.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<\App\Models\User, $this>
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the payments for the registration.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<\App\Models\Payment, $this>
     */
    public function payments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Payment::class);
    }
}
