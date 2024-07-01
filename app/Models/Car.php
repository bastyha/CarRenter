<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    protected $primaryKey = 'license_plate';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable =[
        'license_plate', 
        'image_url', 
        'daily_price'
    ];
    public $timestamps = false;
}
