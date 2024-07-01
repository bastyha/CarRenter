<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Car;
use App\Models\Rent;

class CarController 
{
    public function find(Request $request){
        $validated["startDate"]=Carbon::now()->isoFormat("YYYY-MM-DD");
        $validated["endDate"]=Carbon::now()->isoFormat("YYYY-MM-DD");
        if(isset($request["startDate"])){
            
            $validated = $request->validate([
                'startDate'=> 'required|date|after_or_equal:today', 
                'endDate'=>'required|date|after_or_equal:startDate'
            ]);
        }

        //$rent = new Rent;
        //$rent->license_plate = "qqq-321";
        //$rent->rent_start = "2024-07-05";
        //$rent->rent_end = "2024-07-07";
        //$rent->renter_email = "a@a.a";
        //$rent->save();

        /*
        $res = Car::select('cars.*')
            ->leftJoin('rents', 'cars.license_plate', "=", "rents.license_plate")
            ->where(function ($query) use($validated) {$query
                ->where('rent_start', '<',   $validated["startDate"])
                ->where('rent_end'  , '<',   $validated["startDate"]) ;
            })
            ->orWhere(function ($query) use ($validated) {
                $query
                ->where('rent_start', '>',   $validated["startDate"]) 
                ->where('rent_start'  , '>',   $validated["endDate"]);
            })
            ->orWhere(function ($query) use ($validated) {
                $query
                ->whereNull('rents.license_plate');
            })->distinct()->get();
        */
        $res = 
            DB::select("SELECT cars.* 
                            FROM cars 
                            LEFT JOIN (
                                SELECT license_plate
                                FROM rents
                                WHERE (date(?) BETWEEN rent_start AND rent_end)
                                OR (date(?) BETWEEN rent_start AND rent_end)
                                OR (rent_start BETWEEN date(?) AND date(?)) 
                                ) as bad
                            ON cars.license_plate = bad.license_plate
                            WHERE bad.license_plate IS NULL;", [$validated["startDate"], $validated["endDate"], $validated["startDate"], $validated["endDate"]]);
            
        return view("main", ['cars'=>$res, 'startDate'=>$validated["startDate"], 'endDate'=>$validated["endDate"]]);
    }

    public function getAll(){
        return Car::all();
    }

    public function create(Request $request){

        $validated = $request->validate([
            'license_plate'=>'required|unique:cars,license_plate',
            'daily_price'=>'numeric|required|gte:10'
        ]);
        DB::insert('insert into cars (license_plate, daily_price) values (?, ?)', [$validated["license_plate"], $validated["daily_price"]]);
        return to_route("main.index");
    }
    public function update(Request $request) {
        $validated = $request->validate([
            'license_plate'=>'required|exists:cars,license_plate',
            'daily_price'=>'numeric|required|gte:10'
        ]);
        $car = Car::find($validated["license_plate"]);
        $car->daily_price=$validated['daily_price'];
        $car->save();
        return redirect()->to(route("admin")."/changecar");
    }
}
