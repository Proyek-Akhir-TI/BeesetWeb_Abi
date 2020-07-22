<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Image;
use App\Panen;
use DB;
use App\LokasiKandang;

use Carbon\Carbon;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct(){
        setlocale(LC_TIME, 'nl_NL.utf8');
        Carbon::setLocale('id');
    }

    public function tampilRegister(){
        return view('auth.register');
    }

    public function register(Request $request){
        $this->validate($request, [
            'email'  => 'required|unique:users',
        ]);

        $input = new User();
        $input['nama'] = $request->nama;
        $input['email'] = $request->email;
        $input['password'] = Hash::make($request->password);
        $input['role_id'] = 2;
        $input['kelompok_id'] = 2;
        $input['alamat'] = $request->alamat;
        $input['telpon'] = $request->telpon;
        if($request->file('photo')){
            $image = $request->file('photo');
            $images = 'user_photo'.time().'.'.$request->file('photo')->extension();
            Image::make($image)->resize(300, 300)->save(storage_path('app/public/uploads/' . $images));
            $input['photo'] = $images;
            $images = $request->photo;
        }
        $input->save();

        Alert::success('User Berhasil Dibuat');

        // return redirect('login');
        // return redirect('/pj/tambahkelompok');

    }

    public function landing(){
        $panen_tabel_2 = Panen::select('panen.created_at as created_at', DB::raw('SUM(berat_panen) as total'), DB::raw('YEAR(panen.created_at) as year'))
            ->groupBy('year')
            ->get();

            $categories2 = [];
            $data2 = [];
    
            foreach ($panen_tabel_2 as $panen) {
                $categories2[] = \Carbon\Carbon::parse($panen->created_at)->isoFormat('Y');
                $data2[] = (float)$panen->total;
            }
        
        $maps = LokasiKandang::select('users.nama as peternak','kandang.nama as nama','lokasi_kandang.latitude as latitude', 'lokasi_kandang.longitude as longitude')
            ->join('kandang','kandang.id','=','lokasi_kandang.kandang_id')
            ->join('users','users.id','=','kandang.user_id')
            ->get();

        // return $maps;

        return view('landing', compact('data2','categories2','maps'));

    }
    
}
