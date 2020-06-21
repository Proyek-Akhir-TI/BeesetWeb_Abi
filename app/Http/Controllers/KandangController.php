<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kandang;
use App\AktivitasPeternak;
use Illuminate\Support\Facades\Gate;
use App\AktivitasKandang;
use App\JenisAktivitas;

class KandangController extends Controller
{
    public function __construct(){
        $this->middleware(function ($request, $next) {
            if(Gate::allows('ketua-role'))
            return $next($request);
            // abort(403, 'Anda tidak memiliki hak akses');
            abort(redirect()->route('login'));
        });
    }

    public function store(Request $request){
        
        $input = new Kandang();
        $input['name'] = $request->name;
        $input['user_id'] = $request->user_id;
        $input['location'] = $request->location;
        $input['latitude'] = $request->latitude;
        $input['longitude'] = $request->longitude;
        $input['status'] = $request->status;    
        $input->save();

        // return echo "Tambah Kandang Berhasil";
    }

    public function update(Request $request)
    {
        $input = new Kandang();
        $input['name'] = $request->name;
        $input['user_id'] = $request->user_id;
        $input['location'] = $request->location;
        $input['latitude'] = $request->latitude;
        $input['longitude'] = $request->longitude;
        $input['status'] = $request->status;    
        $input->save();

        // return echo "Tambah Kandang Berhasil" 
    }

    public function storeActivity(Request $request)
    {
        $input = new AktivitasKandang();
        $input['kandang_id'] = $request->kandang_id;
        $input['aktivitas_id'] = $request->aktivitas_id;
        $input->save();
    }

    public function explore($id){
        $kandangs = Kandang::find($id);

        $aktivitas = AktivitasKandang::where('kandang_id', $id)->paginate(10);

        $listaktivitas = JenisAktivitas::pluck('id', 'name');


        // $kandangs = Kandang::select('kandangs.name as name','panens.berat_panen as berat','panens.created_at as created_at')
        //         ->join('kandangs','kandangs.id','=','panens.kandang_id')
        //         ->where('kandangs.user_id',$id)
        //         ->get();

        // $categories = [];
        // $data = [];

        // foreach ($kandangs as $kandang) {
        //     $categories[] = $kandang->name;
        //     $data[] = $panen->berat;
        // }

        // dd($categories);
        // // dd($data);
        
        return view('ketua.peternak.kandang.kandang', compact('kandangs', 'aktivitas', 'listaktivitas')); 
    }
    
}
