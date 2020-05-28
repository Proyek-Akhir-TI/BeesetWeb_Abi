<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Kelompok;
use Image;
use Illuminate\Support\Facades\Hash;

class KetuaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $roles = Role::pluck('name','id');
        $kelompoks = Kelompok::pluck('name','id');

        return view('pj.tambahketua', [
            'roles' => $roles, 
            'kelompoks' => $kelompoks
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = new User();
        $input['name'] = $request->name;
        $input['email'] = $request->email;
        $input['password'] = Hash::make($request->password);
        $input['role_id'] = $request->role_id;
        $input['kelompok_id'] = $request->kelompok_id;
        $input['address'] = $request->address;
        $input['telp'] = $request->telp;
        if($request->file('photo')){
            $image = $request->file('photo');
            $images = 'user_photo'.$request->file('photo')->getClientOriginalName().'.'.$request->file('photo')->extension();
            Image::make($image)->resize(300, 300)->save(storage_path('app/uploads/' . $images));
            $input['photo'] = $images;
            $images = $request->photo;
        }
        $input->save();
        return redirect('/pj/index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
