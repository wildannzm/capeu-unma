<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Registration extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'registration_number',
        'participant_type',
        'status',
        'personal_info',
        'academic_info',
        'participation_details',
        'health_emergency',
        'transportation',
        'declaration',
        'advanced_info',
        'passport_path',
        'student_card_path',
        'formal_photo_path',
        'cv_path',
        'motivation_letter_path',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'personal_info' => AsArrayObject::class,
            'academic_info' => AsArrayObject::class,
            'participation_details' => AsArrayObject::class,
            'health_emergency' => AsArrayObject::class,
            'transportation' => AsArrayObject::class,
            'declaration' => AsArrayObject::class,
            'advanced_info' => AsArrayObject::class,
        ];
    }

    /**
     * Get the user that owns the registration.
     *
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the payments for the registration.
     *
     * @return HasMany<Payment, $this>
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}
