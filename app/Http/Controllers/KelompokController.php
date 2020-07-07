<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Gate;
use App\Kelompok;
use App\User;
use App\Kandang;
use App\Panen;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class KelompokController extends Controller
{
   
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

        $kandangs = Kandang::where('kelompok_id', $id)->count();

        $panens = Panen::select(DB::raw('SUM(berat_panen) as total'))
                ->join('kandangs','kandangs.id','=','panens.kandang_id')
                ->where('kandangs.kelompok_id', $id)
                ->get();
        
        $tables = Panen::select('kandangs.name as name','panens.berat_panen as berat','panens.created_at as created_at','users.name as peternak')
                ->join('kandangs','kandangs.id','=','panens.kandang_id')
                ->join('users','users.id','=','kandangs.user_id')
                ->where('kandangs.kelompok_id',$id)
                ->paginate(5);

        $anggotas = User::all()
            ->where('kelompok_id', $id)
            ->where('role_id', 4)
            ->count();


        return view('/pj/kelompok', compact('kelompoks', 'ketuas', 'kandangs','anggotas','panens','tables'));
    }

    public function highlight()
    {
        $id = Auth::user()->id;
        $datas = Panen::select('kandangs.kelompok_id as kelompok', 'kelompoks.name as name', 'kelompoks.address as address', DB::raw('SUM(berat_panen) as total'), 'panens.created_at as created_at')
                ->join('kandangs','kandangs.id','=','panens.kandang_id')
                ->join('kelompoks','kelompoks.id','=','kandangs.kelompok_id')
                ->where('kelompoks.user_id', $id)
                ->groupBy('kelompok')
                ->paginate(10);
        
        $datas->setCollection($datas->sortByDesc('total'));

        
        return view('/pj/highlight', compact('datas'));

        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kelompoks = Kelompok::find($id);

        return view('pj.editkelompok', compact('kelompoks'));
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
        $input = Kelompok::find($id);
        $input['name'] = $request->name;
        $input['address'] = $request->address;
        $input->save();

        Alert::success('Kelompok Sudah Diedit', 'Edit Berhasil');

        return redirect('/pj/daftarkelompok');
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

        Alert::success('Kelompok Sudah Dihapus', 'Hapus Berhasil');

        return redirect('pj/daftarkelompok');
    }
}
