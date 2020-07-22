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
            

        return view('pj.listkelompok', compact('kelompoks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('pj.tambahkelompok');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        DB::table('kelompok')->insert([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'user_id' => $request->user_id  
        ]);
        
        return redirect()->route('pj.tambahketua');
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
                ->join('kandang','kandang.id','=','panen.kandang_id')
                ->where('kandang.kelompok_id', $id)
                ->get();
        
        $tables = Panen::select('kandang.nama as nama','panen.berat_panen as berat','panen.created_at as created_at','users.nama as peternak')
                ->join('kandang','kandang.id','=','panen.kandang_id')
                ->join('users','users.id','=','kandang.user_id')
                ->where('kandang.kelompok_id',$id)
                ->paginate(5);

        $anggotas = User::all()
            ->where('kelompok_id', $id)
            ->where('role_id', 4)
            ->count();


        return view('pj.kelompok', compact('kelompoks', 'ketuas', 'kandangs','anggotas','panens','tables'));
    }

    public function highlight(Request $request)
    {
        $id = Auth::user()->id;
        $datas = Panen::select('kandang.kelompok_id as kelompok', 'kelompok.nama as nama', 'kelompok.alamat as alamat', DB::raw('SUM(berat_panen) as total'), 'panen.created_at as created_at')
                ->join('kandang','kandang.id','=','panen.kandang_id')
                ->join('kelompok','kelompok.id','=','kandang.kelompok_id')
                ->where('kelompok.user_id', $id)
                ->groupBy('kelompok')
                ->paginate(10);       
        
        $datas->setCollection($datas->sortByDesc('total'));      
      
        $panen_tabel = Panen::select(DB::raw('SUM(berat_panen) as total'), DB::raw('YEAR(panen.created_at) as year'))
            ->join('kandang','kandang.id','=','panen.kandang_id')
            ->join('kelompok','kelompok.id','=','kandang.kelompok_id')
            ->where('kelompok.user_id',$id)
            ->groupBy('year')
            ->get();       
    
        $categories = [];
        $nilai = [];

        foreach ($panen_tabel as $panen) {
            $categories[] = $panen->year;
            $nilai[] = (float)$panen->total;
        }

        $jml_kelompok = Kelompok::where('user_id', $id)->count();
        $jml_peternak = User::select('users.nama as nama')
                    ->join('kelompok','kelompok.id','=','users.kelompok_id')
                    ->where('kelompok.user_id', $id)
                    ->where('users.role_id', 4)
                    ->count();
        $jml_panens = Panen::select(DB::raw('SUM(berat_panen) as total'))
                    ->join('kandang','kandang.id','=','panen.kandang_id')
                    ->join('kelompok','kelompok.id','=','kandang.kelompok_id')
                    ->where('kelompok.user_id', $id)
                    ->groupBy('kelompok.user_id')
                    ->get();

        foreach ($jml_panens as $panen) {
         $jml_panen = (float)$panen->total;
                    }
        $jml_kandang = Kandang::join('kelompok','kelompok.id','=','kandang.kelompok_id')
                        ->where('kelompok.user_id', $id)
                        ->count();

        // return $categories;
        return view('pj.highlight', compact('datas','categories','nilai','tanggal','tahun','panen','jml_kelompok','jml_peternak',
                        'jml_panen','jml_kandang'));

        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_kelompok)
    {
        $kelompoks = Kelompok::find($id_kelompok);

        return view('pj.editkelompok', compact('kelompoks'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_kelompok)
    {
        $input = Kelompok::find($id_kelompok);
        $input['nama'] = $request->nama;
        $input['alamat'] = $request->alamat;
        $input['user_id'] = $request->user_id;
        $input->save();

        Alert::success('Kelompok Sudah Diedit', 'Edit Berhasil');

        return redirect()->route('pj.daftarkelompok');
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

        return redirect()->route('pj.daftarkelompok');
    }
}
