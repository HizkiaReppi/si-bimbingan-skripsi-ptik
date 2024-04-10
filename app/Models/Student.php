<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'lecturer_id',
        'nim',
        'batch',
        'concentration',
        'phone_number',
        'address',
        'photo',
    ];

    /**
     * Get the user that owns the student.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the dosen pembimbing for the student.
     */
    public function supervisor(): BelongsTo
    {
        return $this->belongsTo(Lecturer::class, 'lecturer_id');
    }

    public function guidance(): HasMany
    {
        return $this->hasMany(Guidance::class);
    }

    /**
     * Get the fullname of the dosen pembimbing.
     */
    public function getSupervisorFullnameAttribute(): string
    {
        if ($this->supervisor) {
            return $this->supervisor->front_degree . ' ' . $this->supervisor->user->name . ' ' . $this->supervisor->back_degree;
        }
        
        return 'Student has no supervisor yet.';
    }

    /**
     * Get the thesis title of the student.
     */
    public function getThesisTitleAttribute(): string
    {
        $guidance = $this->guidance->last();
        if ($guidance) {
            return $guidance->thesis_title;
        }

        return 'Belum Ada Judul Skripsi';
    }

    /**
     * Get the count of guidance for the student.
     */
    public function getGuidanceCountAttribute(): int
    {
        return $this->guidance->count();
    }

    /**
     * Get the fullname of student.
     */
    public function getFullnameAttribute(): string
    {
        return $this->user->name;
    }
}
