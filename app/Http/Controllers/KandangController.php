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
use App\User;
use App\LokasiKandang;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class KandangController extends Controller
{

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

        $aktivitas = AktivitasKandang::select('jenis_aktivitas.aktivitas as aktivitas','aktivitas_kandang.created_at as created_at')
                ->join('jenis_aktivitas','jenis_aktivitas.id','=','aktivitas_kandang.aktivitas_id')
                ->where('kandang_id', $id)->paginate(5);

        $listaktivitas = JenisAktivitas::pluck('id', 'aktivitas');

        if($request->tahun == 0)
        $tahun  = Date('Y');
        else
        $tahun = $request->tahun;

        $panens = Panen::
            select('kandang.nama as nama','panen.berat_panen as berat','panen.created_at as created_at')
            ->join('kandang','kandang.id','=','panen.kandang_id')
            ->where('panen.kandang_id',$id)
            ->whereYear('panen.created_at',$tahun)
            ->get();

        $panenyuk = Panen::select(DB::raw('YEAR(panen.created_at) as year'))
                ->join('kandang','kandang.id','=','panen.kandang_id')
                ->where('panen.kandang_id',$id)
                ->groupBy('year')
                ->orderBy('year','desc')
                ->get();
        
        $jml_panens = Panen::select(DB::raw('SUM(berat_panen) as total'))
                ->join('kandang','kandang.id','=','panen.kandang_id')
                ->where('kandang_id',$id)
                ->groupBy('kandang_id')
                ->get();

                foreach ($jml_panens as $panen) {
                    $jml_panen = (float)$panen->total;
                }

        $categories = [];
        $data = [];

        foreach ($panens as $panen) {
            $categories[] = \Carbon\Carbon::parse($panen->created_at)->isoFormat('LL');
            $data[] = $panen->berat;
        }

        $curl = curl_init(); 
        curl_setopt($curl, CURLOPT_URL, 'https://api.thingspeak.com/channels/1085076/feeds.json?api_key=R28BW9NXV8RGGCQ6&results=1000'); 
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
        $result = curl_exec($curl); 
        curl_close($curl);      

        $result = json_decode($result, true);

        $panjang = count($result['feeds']);

        $suhu = $result['feeds'][$panjang-1]['field1'];
        $kelembapan = $result['feeds'][$panjang-1]['field2'];

        
        // return $kelembapan;
        
        return view('ketua.peternak.kandang.kandang', compact('kandangs', 'aktivitas', 'listaktivitas','kandang',
        'jenisaktivitas','categories','data','tahun', 'panens','panenyuk', 'jml_panen','suhu','kelembapan')); 
    }

    public function lokasi($id){
        $users = User::find($id);
        $maps = LokasiKandang::select('users.nama as peternak','kandang.nama as nama','lokasi_kandang.latitude as latitude', 'lokasi_kandang.longitude as longitude')
            ->join('kandang','kandang.id','=','lokasi_kandang.kandang_id')
            ->join('users','users.id','=','kandang.user_id')
            ->where('kandang.user_id', $id)
            ->get();

        // return $maps;

        return view('ketua.peternak.kandang.lokasi', compact('maps','users'));

    }

    public function destroy($id)
    {
        $kandangs = Kandang::findOrFail($id);

        $kandangs->delete();

        Alert::success('Kandang dihapus');

        return back();
    }
    
}
