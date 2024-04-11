<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
     * Get the dosen pembimbing 1 for the student.
     */
    public function firstSupervisor(): BelongsTo
    {
        return $this->belongsTo(Lecturer::class, 'lecturer_id_1');
    }

    /**
     * Get the dosen pembimbing 2 for the student.
     */
    public function secondSupervisor(): BelongsTo
    {
        return $this->belongsTo(Lecturer::class, 'lecturer_id_2');
    }

    public function guidance(): HasMany
    {
        return $this->hasMany(Guidance::class);
    }

    public function thesis(): HasOne
    {
        return $this->hasOne(Thesis::class);
    }

    /**
     * Get the fullname of the dosen pembimbing 1.
     */
    public function getFirstSupervisorFullnameAttribute(): string
    {
        if ($this->firstSupervisor) {
            return $this->firstSupervisor->front_degree . ' ' . $this->firstSupervisor->user->name . ' ' . $this->firstSupervisor->back_degree;
        }
        
        return 'Mahasiswa Belum Memiliki Dosen Pembimbing 1';
    }

    /**
     * Get the fullname of the dosen pembimbing 2.
     */
    public function getSecondSupervisorFullnameAttribute(): string
    {
        if ($this->secondSupervisor) {
            return $this->secondSupervisor->front_degree . ' ' . $this->secondSupervisor->user->name . ' ' . $this->secondSupervisor->back_degree;
        }
        
        return 'Mahasiswa Belum Memiliki Dosen Pembimbing 2';
    }

    /**
     * Get the thesis title of the student.
     */
    public function getThesisTitleAttribute(): string
    {
        $latestThesis = $this->thesis()->latest()->first();

        if ($latestThesis) {
            return $latestThesis->title;
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
