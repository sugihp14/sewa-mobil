<!-- resources/views/car-rentals/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Car Rental') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('car-rentals.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="car_id">Select Car</label>
                            <select id="car_id" name="car_id" class="form-control @error('car_id') is-invalid @enderror" required>
                                <option value="">Select Car</option>
                                @foreach ($cars as $car)
                                    <option value="{{ $car->id }}">{{ $car->merk }} - {{ $car->model }} ({{ $car->plat_nomor }})</option>
                                @endforeach
                            </select>
                            @error('car_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="start_date">Start Date</label>
                            <input type="date" id="start_date" name="start_date" class="form-control @error('start_date') is-invalid @enderror" required>
                            @error('start_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="end_date">End Date</label>
                            <input type="date" id="end_date" name="end_date" class="form-control @error('end_date') is-invalid @enderror" required>
                            @error('end_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Calculate Price</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
