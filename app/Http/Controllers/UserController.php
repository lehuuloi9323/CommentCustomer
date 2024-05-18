<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;
use App\Models\restaurant;
use App\Models\area;

class UserController extends Controller
{
    public function list(Request $request){
        $status = $request->input('status');
        $keyword = '';
        $users = user::all();
        return view('user.list', compact('users', 'status', 'keyword'));
    }

    public function add(Request $request){
        $restaurants = restaurant::all();
        $areas = area::all();
        return view('user.add', compact('restaurants', 'areas'));
    }

    public function create(Request $request){
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'password' => 'required|string|confirmed',
                'restaurant' => 'required',
                'area' => 'required'
            ],
            [
                'required' => ':attribute không được để trống !!',
                'confirmed  ' => 'Mật khẩu và nhập lại mật khẩu không trùng khớp',
            ],
            [
                'name' => 'Họ và tên',
                'password' => 'Mật khẩu',
                'restaurant' => 'Nhà hàng',
                'area' => 'Vị trí',
            ]
        );

        $user = user::create([
            'name'
        ]);
        return $request->all();
    }


    public function createtest(){
        $user = user::create([
            'name' => 'HL',
            'password' => '1',
        ]);
        return $user;
    }

}
