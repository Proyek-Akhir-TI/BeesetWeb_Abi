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
    public function __construct(){
        $this->middleware(function ($request, $next) {
            if(Gate::allows('pj-role'))
            return $next($request);
            // abort(403, 'Anda tidak memiliki hak akses');
            abort(redirect()->route('login'));
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','id');
        $kelompoks = Kelompok::pluck('name','id');

        return view('pj.tambahketua', [
            'roles' => $roles, 
            'kelompoks' => $kelompoks
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $no = 1;
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
            $images = 'user_photo'.$no++.'.'.$request->file('photo')->extension();
            Image::make($image)->resize(300, 300)->save(storage_path('app/public/uploads/' . $images));
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
