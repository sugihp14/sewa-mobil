<!-- resources/views/car-rentals/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Car Rental') }}</div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Car</th>
                                <th>Availability Start Date</th>
                                <th>Availability End Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cars as $car)
                                <tr>
                                    <td>{{ $car->merk }} - {{ $car->model }} ({{ $car->plat_nomor }})</td>
                                    <td>{{ $car->availability_start_date ? $car->availability_start_date->format('Y-m-d') : 'Not set' }}</td>
                                    <td>{{ $car->availability_end_date ? $car->availability_end_date->format('Y-m-d') : 'Not set' }}</td>
                                    <td>
                                        <form method="POST" action="{{ route('car-rentals.store') }}">
                                            @csrf

                                            <input type="hidden" name="car_id" value="{{ $car->id }}">

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

                                                <button type="submit" class="btn btn-primary">Calculate Price</button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
