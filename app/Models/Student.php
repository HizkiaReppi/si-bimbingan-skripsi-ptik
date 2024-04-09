<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
     * Get the fullname of student.
     */
    public function getFullnameAttribute(): string
    {
        return $this->user->name;
    }
}
