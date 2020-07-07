<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Kandang;
use App\AktivitasPeternak;
use Illuminate\Support\Facades\Gate;
use App\AktivitasKandang;
use App\JenisAktivitas;
use App\Panen;
use DB;
use Carbon\Carbon;

class KandangController extends Controller
{

    public function store(Request $request){
        
    $input = ([
        'name' => $request->name,
        'user_id' => $request->user_id,
        'tkUrl' => $request->tkUrl,
        'location' => $request->location,
        'latitude' => $request->latitude,
        'longitude' => $request->longitude,
        'status' => $request->status,
        'kelompok_id' => $request->kelompok_id,
    ]);
    
    $kandang_id = Kandang::create($input)->id;
    
    $panen = new Panen();
    $panen->kandang_id = $kandang_id;
    $panen->save();

    alert()->success('Tambah Berhasil');

        return back();
    }

    public function edit($id){
        $input = Kandang::find($id);
       return view('/ketua/peternak/kandang/edit', compact('input')); 
    }
    public function update(Request $request, $id)
    {
        $input = Kandang::find($id);
        $input->name = $request->name;
        $input->user_id = $request->user_id;
        $input->location = $request->location;
        $input->latitude = $request->latitude;
        $input->longitude = $request->longitude;
        $input->status = $request->status;
        $input->kelompok_id = $request->kelompok_id;    
        $input->save();

        return back();
    }

    public function storeAktivitas(Request $request)
    {
        $input = new AktivitasKandang();
        $input['kandang_id'] = $request->kandang_id;
        $input['aktivitas_id'] = $request->aktivitas_id;
        $input->save();
    }

    public function explore($id, Request $request){
        $kandangs = Kandang::find($id);

        // $qr = 

        $jenisaktivitas = JenisAktivitas::pluck('aktivitas','id');

        $aktivitas = AktivitasKandang::where('kandang_id', $id)->paginate(5);

        $listaktivitas = JenisAktivitas::pluck('id', 'aktivitas');

        if($request->tahun == 0)
        $tahun  = Date('Y');
        else
        $tahun = $request->tahun;

        $panens = Panen::
            select('kandangs.name as name','panens.berat_panen as berat','panens.created_at as created_at')
            ->join('kandangs','kandangs.id','=','panens.kandang_id')
            ->where('panens.kandang_id',$id)
            ->whereYear('panens.created_at',$tahun)
            ->get();

        $panenyuk = Panen::select(DB::raw('YEAR(panens.created_at) as year'))
                ->join('kandangs','kandangs.id','=','panens.kandang_id')
                ->where('panens.kandang_id',$id)
                ->groupBy('year')
                ->orderBy('year','desc')
                ->get();

        $categories = [];
        $data = [];

        foreach ($panens as $panen) {
            $categories[] = \Carbon\Carbon::parse($panen->created_at)->isoFormat('LL');
            $data[] = $panen->berat;
        }

        // dd($categories);
        // dd($data);
        
        return view('ketua.peternak.kandang.kandang', compact('kandangs', 'aktivitas', 'listaktivitas','kandang','jenisaktivitas','categories','data','tahun', 'panens','panenyuk')); 
    }

    public function lokasi($id){
        $maps = Kandang::where('id', $id)->get();

        return view('/ketua/peternak/kandang/lokasi2', compact('maps'));

    }

    public function destroy($id)
    {
        $kandangs = Kandang::findOrFail($id);

        $kandangs->delete();

        Alert::success('Kandang dihapus');

        return back();
    }
    
}
