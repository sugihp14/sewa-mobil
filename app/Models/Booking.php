<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    public function isAvailableForDates($startDate, $endDate)
    {
        return $this->bookings()
            ->where('start_date', '<=', $endDate)
            ->where('end_date', '>=', $startDate)
            ->count() === 0;
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
