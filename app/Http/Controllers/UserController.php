<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;
use App\Models\restaurant;
use App\Models\area;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function list(Request $request){
        $status = $request->input('status');
        $keyword = '';
        // if($status == 'all' or $status == ''){
        //     if($request->input('keyword')){
        //         $keyword = $request->input('keyword');
        //     }
        //     $users = user::where('name', 'LIKE', "%{$keyword}%")->orwhere('id', 'LIKE', "%{$keyword}%")
        //     ->paginate(7);
        // }
        if($request->input('keyword')){
            $keyword = $request->input('keyword');
        }
        $users = user::where('name', 'LIKE', "%{$keyword}%")->orwhere('id', 'LIKE', "%{$keyword}%")
        ->paginate(7);

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
            'name' => $request->input('name'),
            'password' => $request->input('password'),
            'restaurant_id' => $request->input('restaurant'),
            'area_id' => $request->input('area')
        ]);
        return redirect()->route('admin_user_add')->with('status', 'Đã thêm user thành công !');
    }

    public function edit($id, Request $request){
        $user = user::find($id);
        $restaurants = restaurant::all();
        $areas = area::all();
        return view('user.edit', compact('user', 'restaurants', 'areas'));
        // return $user;
    }

    public function update($id, Request $request){
        $user = user::find($id);
        // return $request->all();
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'password' => 'string|nullable',
                'restaurant' => 'required',
                'area' => 'required'
            ],
            [
                'required' => ':attribute không được để trống !!',
            ],
            [
                'name' => 'Họ và tên',
                'password' => 'Mật khẩu',
                'restaurant' => 'Nhà hàng',
                'area' => 'Vị trí',
            ]
        );

        if($request->input('password')){
        $user->update([
            'name' => $request->input('name'),
            'password' => $request->input('password'),
            'restaurant_id' => $request->input('restaurant'),
            'area_id' => $request->input('area'),
        ]);
        }else{
            $user->update([
                'name' => $request->input('name'),
                'restaurant_id' => $request->input('restaurant'),
                'area_id' => $request->input('area'),
            ]);
        }
        // return $user;
        return redirect()->route('admin_user_list')->with('status', 'User có id ='. $request->id.' đã sửa thành công !');
    }

    public function createtest(){
        $user = user::create([
            'name' => 'HL',
            'password' => '1',
            'restaurant_id' => 1,
            'area_id' => 1,

        ]);
        return $user;
    }

}
