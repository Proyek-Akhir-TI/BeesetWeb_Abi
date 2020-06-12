<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kandang;

class KandangController extends Controller
{
    public function showAdd(){
        $kandangs = Kandang::all();
        return view('/ketua/peternak/kandang/tambah');
    }

    public function store(Request $request){
        
        $input = new Kandang();
        $input['name'] = $request->name;
        $input['user_id'] = $request->user_id;
        $input['location'] = $request->location;
        $input['latitude'] = $request->latitude;
        $input['longitude'] = $request->longitude;
        $input->save();

        return redirect('/ketua/explore/{id}');
    }

    public function explore($id){
        
        $kandangs = Kandang::find($id);
        
        return view('/ketua/peternak/kandang/kandang', compact('kandangs'));
    }
}
