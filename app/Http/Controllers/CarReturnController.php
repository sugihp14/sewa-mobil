<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class CarReturnController extends Controller
{
    public function index()
    {
        // Your logic for displaying car return information goes here
        return view('car_returns.index');
    }
}