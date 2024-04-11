<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Thesis extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = ['id'];

    public function guidance(): BelongsTo
    {
        return $this->belongsTo(Thesis::class);
    }

}
