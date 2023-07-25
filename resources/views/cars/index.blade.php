<!-- resources/views/cars/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">List of Cars</div>
                    <div class="card-body">
                        <form action="{{ route('cars.index') }}" method="GET" class="mb-3">
                            <div class="input-group">
                                <input type="text" name="keyword" class="form-control" placeholder="Search cars..." value="{{ request('keyword') }}">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </form>

                        <a href="{{ route('cars.create') }}" class="btn btn-primary mb-3">Add Car</a>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Merk</th>
                                    <th>Model</th>
                                    <th>Plat Nomor</th>
                                    <th>Tarif Sewa (per hari)</th>
                                    
                                    <th>Status</th>
                                   
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cars as $car)
                                    <tr>
                                        <td>{{ $car->merk }}</td>
                                        <td>{{ $car->model }}</td>
                                        <td>{{ $car->plat_nomor }}</td>
                                        <td>{{ $car->tarif_sewa_per_hari }}</td>
                                    
                                        <td>
                                            @if ($car->status)
                                                <span class="badge bg-success">Ready</span>
                                            @else
                                                <span class="badge bg-secondary">Not Ready</span>
                                            @endif
                                        </td>
                                        
                                        <td>
                                            <a href="{{ route('cars.edit', $car->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                            <form action="{{ route('cars.destroy', $car->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this car?')">Delete</button>
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
