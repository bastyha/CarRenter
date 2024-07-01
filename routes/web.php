<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\RentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

use function Laravel\Prompts\error;

Route::get('/',[CarController::class, "find"] )->name("main.index");
Route::post('/',[CarController::class, 'find'])->name("main.search");

Route::post('/api/rentcar', [RentController::class, "helper"])->name("main.rentpoint");




Route::get('admin/{page?}', function (RentController $rc, CarController $cc, ?string $page=null) {
    if($page =="rentviewer"){
        return view('admin', ['page'=>"adminviews/".$page, 'rents'=> $rc->getAll()]); 
    }elseif($page=="changecar"){
        return view('admin', ["page"=>"adminviews/".$page, 'cars'=>$cc->getAll()]);
    }

    return view('admin', ['page'=>"adminviews/".$page]); 
})->name('admin');

Route::post("admin/newcar", [CarController::class, 'create'])-> name("admin.newcar");
Route::post("admin/changecar", [CarController::class, 'update'])-> name("admin.changecar");
