<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\restaurant;
use App\Models\user;


class RestaurantController extends Controller
{
    //
    public function index(Request $request){
        // $restaurants = restaurant::all();
        $keyword = '';
        if($request->input('keyword')){
            $keyword = $request->input('keyword');
        }

        $restaurants = restaurant::where('name', 'like', "%{$keyword}%")->paginate(7);
        return view('restaurant.list',compact('restaurants', 'keyword'));
    }

    public function add(Request $request){
        return view('restaurant.add');
    }
    public function insert(Request $request){
        $request->validate([
            'name' => 'required|string|max:255|unique:restaurants,name',
        ],
        [
            'required' => ':attribute không được để trống !!',
        ],
        [
            'name' => 'Tên nhà hàng'
        ]
        );
        $restaurant = restaurant::create([
            'name' => $request->input('name')
        ]);
        return redirect()->route('admin_restaurant_add')->with('status', 'Thêm nhà hàng thành công');
    }

    public function edit($id, Request $request){
        $restaurant = restaurant::find($id);
        return view('restaurant.edit', compact('restaurant'));
    }

    public function update($id, Request $request){
        $restaurant = restaurant::find($id);
        $request->validate([
            'name' => 'required|string|max:255|unique:restaurants,name,' . $restaurant->id,
        ],
        [
            'required' => ':attribute không được để trống !!',
            'unique' => ':attribute đang có trên hệ thống'
        ],
        [
            'name' => 'Tên nhà hàng'
        ]
        );
        $restaurant->update([
            'name' => $request->input('name')
        ]);

        return redirect()->route('admin_restaurant_list')->with('status', 'Đã sửa nhà hàng thành công !');
    }
    public function delete($id) {
        $restaurant = restaurant::find($id);
        $users = User::where('restaurant_id', $id)->get();

        foreach ($users as $user) {
            $user->update(['restaurant_id' => null]);
        }
        // return $users;
        $restaurant->delete();

        return redirect()->route('admin_restaurant_list')->with('status', 'Đã xóa nhà hàng thành công');
    }
}
