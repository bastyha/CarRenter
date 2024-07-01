<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use Illuminate\Http\Request;

class RentController
{

    public function getAll()
    {
        return Rent::all();
    }
    public function create(Request $request){
        $rent = new Rent();
        error_log($request["licensePlate"]);
        $validated = $request->validate([
            'email'=>'required|max:200',
            'license_plate'=>'required|exists:cars',
            'start_date'=> 'required|date|after_or_equal:today', 
            'end_date'=>'required|date|after_or_equal:startDate'
        ]);
        $rent->renter_email=$validated["email"];
        $rent->license_plate=$validated["license_plate"];
        $rent->rent_start=$validated["start_date"];
        $rent->rent_end=$validated["end_date"];
        $rent->save();
    }
    public function helper(Request $request){
        $rc = new RentController();
        $uc=new UserController();
        $rc->create($request);
        $uc->create($request);
        redirect("main.index");
    }
}
