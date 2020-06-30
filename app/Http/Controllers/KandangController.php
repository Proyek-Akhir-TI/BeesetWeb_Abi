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
use Alert;

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
        $input['tkUrl'] = $request->tkUrl;
        $input['location'] = $request->location;
        $input['latitude'] = $request->latitude;
        $input['longitude'] = $request->longitude;
        $input['status'] = $request->status;    
        $input->save();

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

    public function explore($id, Request $request){
        $kandangs = Kandang::find($id);

        $jenisaktivitas = JenisAktivitas::pluck('aktivitas','id');

        $aktivitas = AktivitasKandang::where('kandang_id', $id)->paginate(5);

        $listaktivitas = JenisAktivitas::pluck('id', 'aktivitas');

        if($request->tahun == 0)
        $tahun  = Date('Y');
        else
        $tahun = $request->tahun;

        $panens = Panen::
            select('kandangs.name as name','panens.berat_panen as berat','panens.created_at as created_at', DB::raw('SUM(berat_panen) as total'))
            ->join('kandangs','kandangs.id','=','panens.kandang_id')
            ->where('panens.kandang_id',$id)
            ->whereYear('panens.created_at',$tahun)
            // ->groupBy('kandang_id')
            ->get();
            // DB::raw('MONTH(panens.created_at) as month'),

        $panenyuk = Panen::select(DB::raw('YEAR(panens.created_at) as year'))
                ->join('kandangs','kandangs.id','=','panens.kandang_id')
                ->where('panens.kandang_id',$id)
                ->groupBy('year')
                ->orderBy('year','desc')
                ->get();

        $categories = [];
        $data = [];

        foreach ($panens as $panen) {
            $categories[] = $panen->created_at;
            $data[] = (float)$panen->total;
        }

        // dd($categories);
        // dd($data);
        
        return view('ketua.peternak.kandang.kandang', compact('kandangs', 'aktivitas', 'listaktivitas','kandang','jenisaktivitas','categories','data','tahun', 'panens','panenyuk')); 
    }

    public function destroy($id)
    {
        $kandangs = Kandang::findOrFail($id);

        $kandangs->delete();

        Alert::success('Kandang dihapus');

        return back();
    }
    
}
