<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Pediatrician extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'password', 'hospital', 'rpps_number'];

}
