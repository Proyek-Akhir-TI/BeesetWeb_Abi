<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Kelompok;
use Image;
use SweetAlert;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

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
        $data = Auth::user()->id;
        $roles = Role::pluck('name','id');
        $kelompoks = Kelompok::where('user_id', $data)
            ->orderBy('id', 'desc')->get();

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
            $images = 'user_photo'.$request->telp.'.'.$request->file('photo')->extension();
            Image::make($image)->resize(300, 300)->save(storage_path('app/public/uploads/' . $images));
            $input['photo'] = $images;
            $images = $request->photo;
        }
        $input->save();

        // SweetAlert::message('Message','Kelompok Berhasil Dibuat');

        return redirect('/pj/index');
        // return redirect('/pj/tambahkelompok');

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
        $users = User::findOrFail($id);

        // if($users->photo)
        // Storage::delete('public/uploads'.$users->photo);

        $pegawai->delete();

        return redirect('pj.listkelompok');
    }
}
