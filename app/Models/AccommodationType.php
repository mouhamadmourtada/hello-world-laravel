<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AccommodationType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'status'
    ];

    /**
     * Get the accommodations for the accommodation type.
     */
    public function accommodations(): HasMany
    {
        return $this->hasMany(Accommodation::class);
    }
}
