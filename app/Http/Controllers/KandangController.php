<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kandang;
use App\AktivitasPeternak;
use Illuminate\Support\Facades\Gate;
use App\AktivitasKandang;
use App\JenisAktivitas;
use App\Panen;
use DB;

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

    public function store(Request $request, $user_id){
        
        $input = new Kandang();
        $input['name'] = $request->name;
        $input['user_id'] = $request->user_id;
        $input['location'] = $request->location;
        $input['latitude'] = $request->latitude;
        $input['longitude'] = $request->longitude;
        $input['status'] = $request->status;    
        $input->save();

        return redirect('/ketua/explore/{user_id}');
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
        $input->save();

        return redirect('/ketua/explore/kandang/{id}');
    }

    public function storeAktivitas(Request $request)
    {
        $input = new AktivitasKandang();
        $input['kandang_id'] = $request->kandang_id;
        $input['aktivitas_id'] = $request->aktivitas_id;
        $input->save();
    }

    public function explore($id){
        $kandangs = Kandang::find($id);

        $jenisaktivitas = JenisAktivitas::pluck('aktivitas','id');

        $aktivitas = AktivitasKandang::where('kandang_id', $id)->paginate(5);

        $listaktivitas = JenisAktivitas::pluck('id', 'aktivitas');

        $tahun  = Date('Y');

        // $panens = Panen::
        //     select('kandangs.name as name','panens.berat_panen as berat','panens.created_at as created_at', DB::raw('SUM(berat_panen) as total'))
        //     ->join('kandangs','kandangs.id','=','panens.kandang_id')
        //     ->where('panens.kandang_id',$id)
        //     ->whereYear('panens.created_at',$tahun)
        //     ->groupBy('kandang_id')
        //     ->get();

        $panens = Panen::
            select('kandangs.name as name','panens.berat_panen as berat','panens.created_at as created_at')
            ->join('kandangs','kandangs.id','=','panens.kandang_id')
            ->where('panens.kandang_id',$id)
            ->whereYear('panens.created_at',$tahun)
            // ->groupBy('kandang_id')
            ->get();

        // $kandangs = Kandang::select('kandangs.name as name','panens.berat_panen as berat','panens.created_at as created_at')
        //         ->join('kandangs','kandangs.id','=','panens.kandang_id')
        //         ->where('kandangs.user_id',$id)
        //         ->get();

        $categories = [];
        $data = [];

        foreach ($panens as $panen) {
            $categories[] = $panen->name;
            $data[] = (float)$panen->berat;
        }

        // dd($categories);
        // dd($data);
        
        return view('ketua.peternak.kandang.kandang', compact('kandangs', 'aktivitas', 'listaktivitas','kandang','jenisaktivitas','categories','data','tahun', 'panens')); 
    }
    
}
