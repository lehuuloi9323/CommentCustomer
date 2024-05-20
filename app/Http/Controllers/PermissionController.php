<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PermissionController extends Controller
{
    //
    public function add(Request $request){
        return view('premission.add');
    }
}
