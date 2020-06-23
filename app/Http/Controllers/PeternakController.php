<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Kelompok;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Kandang;
use App\JenisAktivitas;
use App\AktivitasKandang;
use App\Panen;
use Illuminate\Support\Facades\Gate;

class PeternakController extends Controller
{
    public function __construct(){
        $this->middleware(function ($request, $next) {
            if(Gate::allows('ketua-role'))
            return $next($request);
            // abort(403, 'Anda tidak memiliki hak akses');
            abort(redirect()->route('login'));
        });
    }
    public function index()
    {
        //
        $data = Auth::user()->kelompok_id;
        $user = User::all()
            ->where('kelompok_id',$data)
            ->where('role_id',4);
            // ->paginate(1);
                

        // $user = User::all(); 
        return view('ketua.peternak.listpeternak', compact('user'));
    }

    public function edit($id)
    {
        $roles = Role::pluck('name','id');
        $kelompoks = Kelompok::pluck('name','id');
        $users = User::find($id);
        return view('ketua.peternak.editpeternak',
        [
            'roles' => $roles, 
            'kelompoks' => $kelompoks,
            'users' => $users,
        ]);
    }

    // public function update(Request $request, $id){

    // }
    public function explore($id, Request $request){
        $tahun  = Date('Y');
        $users = User::find($id);
        $kandang = Kandang::where('user_id', $id)->paginate(5);

        $aktivitas = JenisAktivitas::pluck('aktivitas','id');
        // $kandangs = Kandang::pluck('name','id');

        // $tampilAktivitas = AktivitasKandang::all()
        //         ->where('user_id', $id)
        //         ->where('aktivitas_id', 1);
       $panens = Panen::
                select('kandangs.name as name','panens.berat_panen as berat','panens.created_at as created_at', DB::raw('SUM(berat_panen) as total'))
                ->join('kandangs','kandangs.id','=','panens.kandang_id')
                ->where('kandangs.user_id',$id)
                ->whereYear('panens.created_at',$tahun)
                ->groupBy('kandang_id')
                ->get();

        $detailpanens = Panen::select('kandangs.name as name','panens.berat_panen as berat','panens.created_at as created_at')
                ->join('kandangs','kandangs.id','=','panens.kandang_id')
                ->where('kandangs.user_id',$id)
                ->paginate(1);

        $categories = [];
        $data = [];

        foreach ($panens as $panen) {
            $categories[] = $panen->name;
            $data[] = (float)$panen->total;
        }

        // dd($data);
        // dd($categories);

        return view('ketua.peternak.peternak', compact('kandang','users','aktivitas','tampilAktivitas','panens','categories', 'data','tahun','detailpanens'));
    }

    public function storeAktivitas(Request $request)
    {
        $input = new AktivitasKandang();
        $input['kandang_id'] = $request->kandang_id;
        $input['aktivitas_id'] = $request->aktivitas_id;
        $input->save();

        echo "Tambah Aktivitas Berhasil";
    }

    
}


