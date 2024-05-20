<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;
use App\Models\restaurant;
use App\Models\area;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;



class UserController extends Controller
{
    public function list(Request $request){
        $status = $request->input('status');
        $keyword = $request->input('keyword') ?? '';
        $user_all = User::withTrashed()
        ->where(function($query) use ($keyword) {
            $query->where('name', 'LIKE', "%{$keyword}%")
                  ->orWhere('id', 'LIKE', "%{$keyword}%");
        })->count();
        $user_active = User::where(function($query) use ($keyword) {
            $query->where('name', 'LIKE', "%{$keyword}%")
                  ->orWhere('id', 'LIKE', "%{$keyword}%");
        })->count();

        $user_trash = User::onlyTrashed()
        ->where(function($query) use ($keyword) {
            $query->where('id', 'LIKE', "%{$keyword}%")
                  ->orWhere('name', 'LIKE', "%{$keyword}%");
        })->count();

    if ($status == 'all' || $status == '') {
        $users = User::withTrashed()
            ->where(function($query) use ($keyword) {
                $query->where('name', 'LIKE', "%{$keyword}%")
                      ->orWhere('id', 'LIKE', "%{$keyword}%");
            })
            ->paginate(7);
    } elseif ($status == 'active') {
        $users = User::where(function($query) use ($keyword) {
                $query->where('name', 'LIKE', "%{$keyword}%")
                      ->orWhere('id', 'LIKE', "%{$keyword}%");
            })
            ->paginate(7);
    } elseif ($status == 'trash') { // Assuming 'inactive' is the intended status
        $users = User::onlyTrashed()
            ->where(function($query) use ($keyword) {
                $query->where('id', 'LIKE', "%{$keyword}%")
                      ->orWhere('name', 'LIKE', "%{$keyword}%");
            })
            ->paginate(7);
    }

        return view('user.list', compact('users', 'status', 'keyword', 'user_all', 'user_active', 'user_trash'));
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

    public function delete($id){
        if(Auth::id() != $id){
            $user = user::find($id);
            $user->delete();
            return redirect()->route('admin_user_list')->with('status', 'Bạn đã khóa người dùng thành công!');
            }else
            {
            return redirect()->route('admin_user_list')->with('warning', 'Bạn không thể khóa user của bạn đang đăng nhập!');
            }
        }

    public function action(Request $request){
        $list_check = $request->input('list_check');
        if($list_check){
            foreach($list_check as $k => $id){
                if(Auth::id() == $id){
                    unset($list_check[$k]);
                }
            }
            if(!empty($list_check)){
                $act = $request->input('actions');
                if($act=='block'){
                    user::destroy($list_check);
                    return redirect()->route('admin_user_list')->with('status', 'Khóa user thành công');
                }
                if($act=='restore'){
                    user::withTrashed($list_check)
                    ->whereIn('id', $list_check)
                    ->restore();
                    return redirect()->route('admin_user_list')->with('status', 'Khổi phục tài khoản thành công');
                }
            }
            return redirect()->route('admin_user_list')->with('status', 'Bạn không thể thao tác trên user của bạn');
        }
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
