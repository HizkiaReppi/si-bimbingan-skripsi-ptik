<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lecturer extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'nip',
        'nidn',
        'front_degree',
        'back_degree',
        'position',
        'rank',
        'type',
        'phone_number',
    ];

    /**
     * Get the user that owns the student.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * 1 Lecturer has many Student.
     */
    public function student(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    /**
     * Get the fullname with gelar depan and gelar belakang.
     */
    public function getFullnameAttribute(): string
    {
        return $this->front_degree . ' ' . $this->user->name . ' ' . $this->back_degree;
    }

    /**
     * Format NIP.
     */
    public function getFormattedNIPAttribute(): string
    {
        return formatNIP($this->nip);
    }

    /**
     * Format NIDN.
     */
    public function getFormattedNIDNAttribute(): string
    {
        return formatNIDN($this->nidn);
    }
}
