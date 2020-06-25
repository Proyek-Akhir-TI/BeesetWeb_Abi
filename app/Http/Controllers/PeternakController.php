<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Kelompok;
use DB;
use Alert;
use Illuminate\Support\Facades\Auth;
use App\Kandang;
use App\JenisAktivitas;
use App\AktivitasKandang;
use App\Panen;
use Illuminate\Support\Facades\Gate;
use Storage;

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
            ->where('role_id',4)
            ->where('status', 1);
            // ->paginate(1);
                

        // $user = User::all(); 
        return view('ketua.peternak.listpeternak', compact('user'));
    }

    public function needToConfirm(){
        $data = Auth::user()->kelompok_id;
        $user = User::all()
            ->where('kelompok_id',$data)
            ->where('role_id',4)
            ->where('status', 0);
            // ->paginate(1);
                

        // $user = User::all(); 
        return view('ketua.peternak.verifikasi', compact('user'));
    }

    public function detailToConfirm($id){

       $peternaks = User::find($id);

        return view('ketua.peternak.verifikasidetail', compact('peternaks'));
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
        if($request->tahun == 0)
        $tahun  = Date('Y');
        else
        $tahun = $request->tahun;

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
                ->paginate(5);

        $panenyuk = Panen::select(DB::raw('YEAR(panens.created_at) as year'))
                ->join('kandangs','kandangs.id','=','panens.kandang_id')
                ->where('kandangs.user_id',$id)
                ->groupBy('year')
                ->orderBy('year','desc')
                ->get();

                // return $panenyuk;
        // return $panenyuk;
        $detailpanens->setPageName('other_page');

        $categories = [];
        $data = [];

        foreach ($panens as $panen) {
            $categories[] = $panen->name;
            $data[] = (float)$panen->total;
        }

        $maps = Kandang::where('user_id', $id)->get();

        // dd($data);
        // dd($categories);
        // dd($tahun);
        // dd($maps);

        return view('ketua.peternak.peternak', compact('kandang','users','aktivitas','tampilAktivitas','panens','categories', 'data','tahun','detailpanens','panenyuk','maps'));
    }

    public function destroy($id)
    {
        $peternak = User::findOrFail($id);

        if($peternak->photo)
        Storage::delete('public/uploads'.$peternak->photo);

        $peternak->delete();

        Alert::error('Peternak Sudah Dihapus', 'Hapus Berhasil');

        return redirect('/ketua/listpeternak');
    }


    
}


