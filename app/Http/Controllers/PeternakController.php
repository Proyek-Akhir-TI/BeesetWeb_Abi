<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Kelompok;
use DB;
use Illuminate\Support\Facades\Auth;

class PeternakController extends Controller
{
    public function index()
    {
        //
        $data = Auth::user()->kelompok_id;
        $user = User::all()
            ->where('kelompok_id',$data)
            ->where('role_id',4)
            ; 
        // $user = User::all(); 
        return view('ketua.peternak.listpeternak', compact('user'));
    }

    public function edit($id)
    {
        $roles = Role::pluck('name','id');
        $kelompoks = Kelompok::pluck('name','id');
        $users = User::find($id);
        return view('ketua.peternak.editpeternak',
        [
            'roles' => $roles, 
            'kelompoks' => $kelompoks,
            'users' => $users,
        ]);
    }

    // public function update(Request $request, $id){

    // }
    public function explore($id){
        $users = User::find($id);
        return view('ketua.peternak.peternak', ['users' => $users]);
    }

    
}


