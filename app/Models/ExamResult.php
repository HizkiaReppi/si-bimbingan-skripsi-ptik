<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamResult extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = ['id'];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function thesis()
    {
        return $this->belongsTo(Thesis::class, 'thesis_id');
    }

    public function guidance()
    {
        return $this->belongsTo(Guidance::class, 'guidance_id');
    }
}
