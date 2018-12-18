<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Value;

class ValueController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth');
    }

    public function tambah(Request $req)
    {
    	$value = new Value;
    	$value->name =$req->name;
    	$value->persen =$req->persentase;
    	$value->save();
    	return redirect('/home'); 
    }

    public function editview($id)
    {
        $data1 = Value::find($id);
        $total =Value::all()->pluck('persen');
        $total1=($total->sum());
        $value =Value::all();
        return view('EditValue',['data1' => $data1, 'value' => $value, 'total1' => $total1]);
    }

    public function edit($id,Request $req)
    {

    	$data = Value::find($id);
        $data->name =$req->name;
        $data->persen =$req->persentase;
        $data->save();
        return redirect('/home');
    }

    public function hapus($id)
    {
    	$data = Value::find($id);
        $data->delete();
        return redirect('/home');
    }
}
