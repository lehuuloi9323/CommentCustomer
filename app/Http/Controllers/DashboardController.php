<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\data;
use App\Models\user;
use App\Models\restaurant;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request){
        $datas = data::orderBy('id', 'desc')->paginate(7);
        $count = data::count();
        $count_poor = data::where('rate','=','poor')->count();
        $count_excellent = data::where('rate','=','excellent')->count();
        $count_average = data::where('rate','=','average')->count();
        // return redirect()->route('loginForm');
        return view('dashboard', compact('datas', 'count','count_poor', 'count_average', 'count_excellent'));
    }
}
