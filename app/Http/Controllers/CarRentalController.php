<?php

// app/Http/Controllers/CarRentalController.php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class CarRentalController extends Controller
{
    public function index()
    {
        $cars = Car::all();

        return view('car-rentals.index', compact('cars'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'start_date' => 'required|date|before_or_equal:end_date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $car = Car::find($request->input('car_id'));
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        if (!$car->isAvailableForDates($start_date, $end_date)) {
            return back()->with('error', 'Car is not available for the selected dates.');
        }

        $rentalDays = (strtotime($end_date) - strtotime($start_date)) / (60 * 60 * 24);
        $totalPrice = $rentalDays * $car->tarif_sewa_per_hari;

        return back()->with('success', 'Car rental created successfully. Total price: ' . $totalPrice);
    }
}
