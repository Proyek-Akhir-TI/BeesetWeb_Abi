<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Kelompok;
use App\Notif;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Kandang;
use App\JenisAktivitas;
use App\AktivitasKandang;
use App\Panen;
use Illuminate\Support\Facades\Gate; 
use Storage;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;



class PeternakController extends Controller
{
    
    public function index(Request $request)
    {
        $id = Auth::user()->kelompok_id;
        $anggota = User::all()
            ->where('kelompok_id',$id)
            ->where('role_id',4)
            ->count();

        $anggota_aktif = User::all()
            ->where('kelompok_id',$id)
            ->where('role_id',4)
            ->where('status', 1)
            ->count();
        
        $kandang = Kandang::where('kelompok_id', $id)->count();

        $panen = Panen::select(DB::raw('SUM(berat_panen) as total'))
            ->join('kandang','kandang.id','=','panen.kandang_id')
            ->join('kelompok','kelompok.id','=','kandang.kelompok_id')
            ->where('kandang.kelompok_id', $id)
            ->groupBy('kandang.kelompok_id')
            ->get();
            
            foreach ($panen as $val) {
                $hasil = (float)$val->total;
            }
        
        if($request->tahun == 0)
            $tahun  = Date('Y');
        else
            $tahun = $request->tahun;
        
        $tanggal = Panen::select(DB::raw('YEAR(panen.created_at) as year'))
            ->join('kandang','kandang.id','=','panen.kandang_id')
            ->join('kelompok','kelompok.id','=','kandang.kelompok_id')
            ->where('kandang.kelompok_id',$id)
            ->groupBy('year')
            ->orderBy('year','desc')
            ->get();

        $panen_tabel = Panen::select('users.nama as nama','panen.created_at as created_at', DB::raw('SUM(berat_panen) as total'))
            ->join('kandang','kandang.id','=','panen.kandang_id')
            ->join('users','users.id','=','kandang.user_id')
            ->where('kandang.kelompok_id',$id)
            ->whereYear('panen.created_at',$tahun)
            ->groupBy('user_id')
            ->get();       
    

        $categories = [];
        $data = [];

        foreach ($panen_tabel as $panen) {
            $categories[] = $panen->nama;
            $data[] = (float)$panen->total;
        }

        $panen_tabel_2 = Panen::select('panen.created_at as created_at', DB::raw('SUM(berat_panen) as total'), DB::raw('YEAR(panen.created_at) as year'))
            ->join('kandang','kandang.id','=','panen.kandang_id')
            ->join('users','users.id','=','kandang.user_id')
            ->where('kandang.kelompok_id',$id)
            ->groupBy('year')
            ->get();

            $categories2 = [];
            $data2 = [];
    
            foreach ($panen_tabel_2 as $panen) {
                $categories2[] = \Carbon\Carbon::parse($panen->created_at)->isoFormat('Y');
                $data2[] = (float)$panen->total;
            }

        return view('ketua.index', compact('user','anggota','anggota_aktif','kandang','hasil',
            'categories','data','tahun','categories2','data2','tanggal'));
    }

    public function daftarPeternak(Request $request){
        if($request->cari == ""){
            $data = Auth::user()->kelompok_id;
            $user = User::where('kelompok_id',$data)
                ->where('role_id',4)
                ->where('status', 1)
                ->paginate(10);
        }
       
        else{
            $cari = $request->cari;
            $data = Auth::user()->kelompok_id;
            $user = User::where('kelompok_id',$data)
                ->where('role_id',4)
                ->where('status', 1)
                ->where('nama',$cari)
                ->paginate(10);
        }
        return view('ketua.peternak.listpeternak', compact('user'));
    }

    public function belumKonfirmasi(){
        $data = Auth::user()->kelompok_id;
        $user = User::where('kelompok_id',$data)
            ->where('role_id',4)
            ->where('status', 0)
            ->paginate(10);
        
        $jumlah = User::where('kelompok_id',$data)
            ->where('role_id',4)
            ->where('status', 0)
            ->count();
        
        // $jml = (integer)$jumlah;
        // dd($jml);
    
        return view('ketua.peternak.konfirmasi', compact('user','jumlah')); 
    }

    public function detailToConfirm($id){

       $peternaks = User::find($id);

        return view('ketua.peternak.detailkonfirmasi', compact('peternaks'));
    }

   

    public function edit($id)
    {
        $roles = Role::pluck('nama','id');
        $kelompoks = Kelompok::pluck('nama','id');
        $peternaks = User::find($id);
        return view('ketua.peternak.editpeternak', compact('roles','kelompoks','peternaks'));
    }


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
                select('kandang.nama as nama','panen.berat_panen as berat', DB::raw('SUM(berat_panen) as total'))
                ->join('kandang','kandang.id','=','panen.kandang_id')
                ->where('kandang.user_id',$id)
                ->whereYear('panen.created_at',$tahun)
                ->groupBy('kandang_id')
                ->get();
        
                $categories = [];
                $data = [];
        
                foreach ($panens as $panen) {
                    $categories[] = $panen->nama;
                    $data[] = (float)$panen->total;
                }

        $detailpanens = Panen::select('kandang.nama as nama','panen.berat_panen as berat','panen.created_at as created_at')
                ->join('kandang','kandang.id','=','panen.kandang_id')
                ->where('kandang.user_id',$id)
                ->orderBy('panen.id', 'desc')
                ->take(5)
                ->get();
        
        // $kandang->setPageName('page');


        $panenyuk = Panen::select(DB::raw('YEAR(panen.created_at) as year'))
                ->join('kandang','kandang.id','=','panen.kandang_id')
                ->where('kandang.user_id',$id)
                ->groupBy('year')
                ->orderBy('year','desc') 
                ->get();       
        

        $maps = Kandang::where('user_id', $id)->get();

        $jml_kandangs = Kandang::where('user_id', $id)->count();
        $jml_panens = Panen::select(DB::raw('SUM(berat_panen) as total'))
            ->join('kandang','kandang.id','=','panen.kandang_id')
            ->where('kandang.user_id',$id)
            ->groupBy('user_id')
            ->get();


        foreach ($jml_panens as $panen) {
            $jml_panen = (float)$panen->total;
        }

        return view('ketua.peternak.peternak', compact('kandang','users','aktivitas','tampilAktivitas',
        'panens','categories', 'data','tahun','detailpanens','panenyuk','maps','jml_kandangs','jml_panen'));
    }

    public function tinjauan($id, Request $request){
        $id_peternak = $id;

        if($request->cari == ""){
            $detailpanens = Panen::select('users.id as id','users.nama as peternak','kandang.nama as nama','panen.berat_panen as berat','panen.created_at as created_at')
            ->join('kandang','kandang.id','=','panen.kandang_id')
            ->join('users','users.id','=','kandang.user_id')
            ->where('kandang.user_id',$id)
            ->paginate(10);
              
        }
       
        else{
            $cari = $request->cari;
            $detailpanens = Panen::select('users.id as id','users.nama as peternak','kandang.nama as nama','panen.berat_panen as berat','panen.created_at as created_at')
                ->join('kandang','kandang.id','=','panen.kandang_id')
                ->join('users','users.id','=','kandang.user_id')
                ->where('kandang.user_id',$id)
                ->where('kandang.nama',$cari)
                ->paginate(10);

            
        }
        
        return view('ketua.peternak.tinjauan',compact('detailpanens','nama_peternak','id_peternak'));
    }


    public function destroy($id)
    {
        $peternak = User::findOrFail($id);

        $notif = new Notif();
        $token = $peternak->api_firebase;

        $pesan = 'Akun Beeset Anda Non Aktifkan';
       
        $judul = $pternak->nama;
        $notif->suhu2($token, $judul, $pesan);


        if($peternak->photo)
        Storage::delete('public/uploads'.$peternak->photo);

        $peternak->delete();

        Alert::error('Peternak Sudah Dihapus', 'Hapus Berhasil');

        return redirect()->route('ketua.listpeternak');
    }


    
}


