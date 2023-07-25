<?php
// app/Models/Car.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = ['merk', 'model', 'plat_nomor', 'tarif_sewa_per_hari','status'];
   
    
}