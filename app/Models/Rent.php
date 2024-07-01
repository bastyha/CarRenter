<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable =[
        'renter_email',
        'license_plate', 
        'rent_start',
        'rent_end'
        
    ];
}
