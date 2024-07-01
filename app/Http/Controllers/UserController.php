<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController
{
    public function create(Request $request) {
        $user = new User();
        $validated = $request->validate([
            'email'=>'required|email|max:200',
            'name'=>'required|max:200',
            'address'=>'required|max:200', 
            'phone'=>'required|max:200'
        ]);
        $user->email=$validated["email"];
        $user->name=$validated["name"];
        $user->address=$validated["address"];
        $user->phone=$validated["phone"];
        User::updateOrCreate([$user->email]);
    }


}
