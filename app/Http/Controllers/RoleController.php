<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    //
    public function list(Request $request){
        return view('role.list');
    }

    public function add(Request $request){
        return view('role.add');
    }
}
