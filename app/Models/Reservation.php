<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Reservation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'customer_id',
        'accommodation_id',
        'rate_id',
        'check_in',
        'check_out',
        'status',
        'total_price',
        'notes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'check_in' => 'datetime',
        'check_out' => 'datetime',
        'total_price' => 'decimal:2',
    ];

    /**
     * Get the customer that owns the reservation.
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the accommodation that owns the reservation.
     */
    public function accommodation(): BelongsTo
    {
        return $this->belongsTo(Accommodation::class);
    }

    /**
     * Get the rate that owns the reservation.
     */
    public function rate(): BelongsTo
    {
        return $this->belongsTo(Rate::class);
    }

    /**
     * Get the services for the reservation.
     */
    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class)
            ->withPivot('quantity')
            ->withTimestamps();
    }
}
