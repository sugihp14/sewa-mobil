<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CarController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $cars = Car::when($keyword, function ($query, $keyword) {
            return $query->where('merk', 'like', '%' . $keyword . '%')
                ->orWhere('model', 'like', '%' . $keyword . '%')
                ->orWhere('plat_nomor', 'like', '%' . $keyword . '%');
        })->get();

        return view('cars.index', compact('cars'));
    }

    public function create()
    {
        return view('cars.create');
    }
    private function convertToDate($date)
    {
        return $date ? Carbon::createFromFormat('Y-m-d', $date) : null;
    }
    public function store(Request $request)
    {
        $request->validate([
            'merk' => 'required',
            'model' => 'required',
            'plat_nomor' => 'required|unique:cars',
            'tarif_sewa_per_hari' => 'required|numeric',
            'status' => 'boolean',
            'availability_start_date' => 'nullable|date',
            'availability_end_date' => 'nullable|date|after_or_equal:availability_start_date',
        ]);
    
        $data = $request->all();
        $data['status'] = $request->has('status');
        $data['availability_start_date'] = $this->convertToDate($request->availability_start_date);
        $data['availability_end_date'] = $this->convertToDate($request->availability_end_date);
        
        Car::create($data);
    
        return redirect()->route('cars.index')
            ->with('success', 'Car created successfully.');
    }
    
    public function edit(Car $car)
    {
        return view('cars.edit', compact('car'));
    }

    public function update(Request $request, Car $car)
    {
        $request->validate([
            'merk' => 'required',
            'model' => 'required',
            'plat_nomor' => 'required|unique:cars,plat_nomor,' . $car->id,
            'tarif_sewa_per_hari' => 'required|numeric',
            'status' => 'boolean',
            'availability_start_date' => 'nullable|date',
            'availability_end_date' => 'nullable|date|after_or_equal:availability_start_date',
        ]);
    
        $data = $request->all();
        $data['status'] = $request->has('status');
        $data['availability_start_date'] = $this->convertToDate($request->availability_start_date);
        $data['availability_end_date'] = $this->convertToDate($request->availability_end_date);
       
        $car->update($data);
    
        return redirect()->route('cars.index')
            ->with('success', 'Car updated successfully.');
    }
    

    // ...


    public function destroy(Car $car)
    {
        $car->delete();

        return redirect()->route('cars.index')
            ->with('success', 'Car deleted successfully.');
    }
}