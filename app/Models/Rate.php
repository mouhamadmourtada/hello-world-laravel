<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rate extends Model
{
    use HasFactory;

    protected $fillable = [
        'accommodation_id',
        'duration_type',
        'price',
    ];

    public function accommodation(): BelongsTo
    {
        return $this->belongsTo(Accommodation::class);
    }
}
