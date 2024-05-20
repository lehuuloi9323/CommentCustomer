<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\data;

class RateController extends Controller
{
    //
    public function index(Request $request){
        $keyword = '';
        if($request->input('keyword')){
            $keyword=$request->input('keyword');
        }
        $status = $request->input('status');
        if($status == '' or $status == 'all'){
            $datas = data::where('restaurant_id', 'LIKE', "%{$keyword}%")->paginate(7);
            $count_data_all = data::where('restaurant_id', 'LIKE', "%{$keyword}%")->count();
            $count_data_excellent = data::where('restaurant_id', 'LIKE', "%{$keyword}%")->where('rate', 'excellent')->count();
            $count_data_average = data::where('restaurant_id', 'LIKE', "%{$keyword}%")->where('rate', 'average')->count();
            $count_data_poor = data::where('restaurant_id', 'LIKE', "%{$keyword}%")->where('rate', 'poor')->count();

        }
        elseif($status == 'excellent'){
            $datas = data::where('restaurant_id', 'LIKE', "%{$keyword}%")->where('rate', 'excellent')->paginate(7);
            $count_data_all = data::where('restaurant_id', 'LIKE', "%{$keyword}%")->count();
            $count_data_excellent = data::where('restaurant_id', 'LIKE', "%{$keyword}%")->where('rate', 'excellent')->count();
            $count_data_average = data::where('restaurant_id', 'LIKE', "%{$keyword}%")->where('rate', 'average')->count();
            $count_data_poor = data::where('restaurant_id', 'LIKE', "%{$keyword}%")->where('rate', 'poor')->count();
}
        elseif($status == 'average'){
            $datas = data::where('restaurant_id', 'LIKE', "%{$keyword}%")->where('rate', 'average')->paginate(7);
            $count_data_all = data::where('restaurant_id', 'LIKE', "%{$keyword}%")->count();
            $count_data_excellent = data::where('restaurant_id', 'LIKE', "%{$keyword}%")->where('rate', 'excellent')->count();
            $count_data_average = data::where('restaurant_id', 'LIKE', "%{$keyword}%")->where('rate', 'average')->count();
            $count_data_poor = data::where('restaurant_id', 'LIKE', "%{$keyword}%")->where('rate', 'poor')->count();
}elseif($status == 'poor'){
            $datas = data::where('restaurant_id', 'LIKE', "%{$keyword}%")->where('rate', 'poor')->paginate(7);
            $count_data_all = data::where('restaurant_id', 'LIKE', "%{$keyword}%")->count();
            $count_data_excellent = data::where('restaurant_id', 'LIKE', "%{$keyword}%")->where('rate', 'excellent')->count();
            $count_data_average = data::where('restaurant_id', 'LIKE', "%{$keyword}%")->where('rate', 'average')->count();
            $count_data_poor = data::where('restaurant_id', 'LIKE', "%{$keyword}%")->where('rate', 'poor')->count();
}
        return view('rate.list', compact('keyword', 'datas','count_data_all', 'count_data_excellent','count_data_average','count_data_poor', 'status'));
    }
}
