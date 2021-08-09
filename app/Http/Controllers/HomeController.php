<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
		if (Auth::check()) {
			$result = DB::select(DB::raw("SELECT SUM(ex.amount) as amount, ec.name FROM expenses ex LEFT JOIN expense_categories ec ON ex.expense_category_id = ec.id WHERE ex.user_id=".Auth::id()." GROUP BY ec.name"));
			$data = "";
			foreach($result as $val) {
				$data.="['".$val->name."',     ".$val->amount."],";
			}
			
			$chartData = $data;
			
			return view('home',compact('chartData'));
		}else{
			return view('auth\login');
		}
    }
}
