<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\data;
use App\Models\user;
// use App\Models\user;
use App\Models\restaurant;
use App\Models\area;
use Illuminate\Support\Facades\Auth;

class DataController extends Controller
{
    public function index(){
        $user = Auth::user()->id;
        $users = user::find($user);
        // return $users->restaurant_id;
        $restaurant = restaurant::find($users->restaurant_id);
        $area = area::find($users->area_id);
        return view('layouts.guest', compact('user', 'area', 'restaurant', 'users'));
    }

    public function action(Request $request){
        // return $request->all();
        $data = data::create([
            'rate' => $request->input('rate'),
            'restaurant_id' => $request->input('restaurant_id'),
            'area_id' => $request->input('area_id'),
            'user_id' => $request->input('user_id')
        ]);
        return redirect()->route('rate')->with('status','Thank you for your review');


    }
}
