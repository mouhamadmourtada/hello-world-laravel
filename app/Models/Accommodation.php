<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Accommodation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'accommodation_type_id',
        'price',
        'address',
        'images',
        'is_available',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price' => 'decimal:2',
        'is_available' => 'boolean',
        'images' => 'array'
    ];


    

    /**
     * Get the type that owns the accommodation.
     */
    public function accommodationType(): BelongsTo
    {
        return $this->belongsTo(AccommodationType::class);
    }

    /**
     * Get the reservations for the accommodation.
     */
    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    /**
     * Get the rates for the accommodation.
     */
    public function rates(): HasMany
    {
        return $this->hasMany(Rate::class);
    }
}
