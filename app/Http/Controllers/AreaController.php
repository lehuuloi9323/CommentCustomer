<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\area;
use App\Models\user;

class AreaController extends Controller
{

    public function index(Request $request){
        $keyword = '';
        if($request->input('keyword')){
            $keyword = $request->input('keyword');
        }

        $areas = area::where('name', 'like', "%{$keyword}%")->paginate(7);
        return view('area.list', compact('areas', 'keyword'));
    }

    public function add(Request $request){
        return view('area.add');
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
        $area = area::create([
            'name' => $request->input('name')
        ]);
        return redirect()->route('admin_area_add')->with('status', 'Đã thêm vị trí thành công');
    }

    public function edit($id, Request $request){
        $area = area::find($id);
        return view('area.edit', compact('id', 'area'));
    }

    public function update($id, Request $request){
        $area = area::find($id);
        $request->validate([
            'name' => 'required|string|max:255|unique:restaurants,name,' . $area->id,
        ],
        [
            'required' => ':attribute không được để trống !!',
            'unique' => ':attribute đang có trên hệ thống'
        ],
        [
            'name' => 'Tên nhà hàng'
        ]
        );
        $area->update([
            'name' => $request->input('name')
        ]);
        return redirect()->route('admin_area_list')->with('status', 'Đã sửa vị trí thành công');
    }

    public function delete(Request $request,$id){
        $area = area::find($id);
        $users = User::where('area_id', $id)->get();

        foreach ($users as $user) {
            $user->update(['area' => null]);
        }
        // return $users;
        $area->delete();
        return redirect()->route('admin_area_list')->with('status', 'Đã xóa vị trí thành công !');
    }
}
