<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Kandang;

class PeternakApiController extends Controller
{
    public function users(User $user)
    {
    	$users = $user->all();

    	return response()->json($users);
    }

    public function kandang(Request $request)
    {
    	$kandang = Kandang::where('user_id',$request->user()->id)->get();
        return response()->json( ['kandang' => $kandang] ,200);
    }

    public function kelompok(){
    	$kelompoks = Kelompok::pluck('name','id');

    	return response()->json($kelompoks)
    }
}
