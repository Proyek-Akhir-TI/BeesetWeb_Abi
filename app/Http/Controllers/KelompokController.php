<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Gate;
use App\Kelompok;
use App\User;
use Alert;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class KelompokController extends Controller
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
        $data = Auth::user()->id;
        $kelompoks = Kelompok::where('user_id', $data)
            ->paginate(5);
            

        return view('/pj/listkelompok', compact('kelompoks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('/pj/tambahkelompok');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::table('kelompoks')->insert([
            'name' => $request->name,
            'address' => $request->address,
            'user_id' => $request->user_id
        ]);
        
        return redirect('/pj/tambahketua');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kelompoks = Kelompok::find($id);

        $ketuas  = User::all()
            ->where('kelompok_id', $id)
            ->where('role_id', 3);

        // $panens = Panen::

            // return $ketuas;

        return view('/pj/kelompok', compact('kelompoks', 'ketuas'));
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
        $kelompoks = Kelompok::findOrFail($id);

        $kelompoks->delete();

        $anggota = User::where('kelompok_id', $id);

        foreach ($anggota as $val) {
            if ($val->photo)
            Storage::delete('public/uploads'.$val->photo);
        }

        

        $anggota->delete();

        alert()->success('Kelompok Sudah Dihapus', 'Hapus Berhasil')->persistent('Konfirmasi');

        return redirect('pj/daftarkelompok');
    }
}
