<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Value;
 
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $value =Value::all();
        $total =Value::all()->pluck('persen');
        $total1=($total->sum());
        return view('home',['value' => $value, 'total1' => $total1 ]);
    }
}
