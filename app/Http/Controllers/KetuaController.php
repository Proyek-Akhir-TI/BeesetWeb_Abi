<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Kelompok;
use App\Kandang;
use App\Panen;
use Image;
use DB;
use Mail;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class KetuaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Auth::user()->id;
        $kelompoks = Kelompok::where('user_id', $data)
            ->orderBy('id', 'desc')->get();
        return view('pj.tambahketua', compact('kelompoks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $this->validate($request, [
            'email'  => 'required|unique:users',
        ]);
        
        $isi = array(
            'Nama Pengguna' => $request->nama,
            'Email' => $request->email,
            'Password' => $request->password,
            'Alamat' => $request->alamat,
            'No. Telepon' => $request->telpon,

        );
        $to = explode(',',$isi['Email']);

        Mail::send('isiemail', $isi, function($pesan) use($request){
            $pesan->to($request->email)->subject('Pemberitahuan Akun Aktif Ketua Kelompok');
            $pesan->from(env('MAIL_USERNAME','sipetani.it@gmail.com'),'Pemberitahuan Akun Aktif');
        });


        $input = new User();
        $input['nama'] = $request->nama;
        $input['email'] = $email;
        $input['password'] = Hash::make($request->password);
        $input['role_id'] = 3;
        $input['kelompok_id'] = $request->kelompok_id;
        $input['alamat'] = $request->alamat;
        $input['telpon'] = $request->telpon;
        if($request->file('photo')){
            $image = $request->file('photo');
            $images = 'user_photo'.$request->telp.'.'.$request->file('photo')->extension();
            Image::make($image)->resize(300, 300)->save(storage_path('app/public/uploads/' . $images));
            $input['photo'] = $images;
            $images = $request->photo;
        }
        $input->save();
 
        Alert::success('Kelompok dan Ketua Berhasil Dibuat');

        

        // foreach($data['ccpeople'] as $people){
        //     $cc = $people;
        // }

       
        return redirect()->route('pj.beranda');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ketua = User::find($id);
       

        return view('ketua.edit', compact('ketua'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'email' => [
                'required',
                Rule::unique('users')->ignore($id,'id')
            ],
        ]);

        $input = User::find($id);
        $input->nama = $request->nama;
        $input->alamat = $request->alamat;
        $input->telpon = $request->telpon;
        $new_photo = $request->file('photo');
        
        if($request->email){
            $input->email = $request->email;
        }

        if($request->password){
            $input->password = Hash::make($request->password);
        }

        if($new_photo){
            if($input->photo && file_exists(storage_path('app/public/uploads/' .$input->photo))){
                    Storage::delete('public/uploads/'. $input->photo);
                    }
            $images = 'user_photobaru'.time().'.'.$request->file('photo')->extension();
            Image::make($new_photo)->resize(300, 300)->save(storage_path('app/public/uploads/' . $images));
            $input->photo = $images;
        }

        $input->save();

        Alert::success('Data Berhasil Diupdate');

        return redirect()->route('ketua.index');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }

    public function profil(Request $request)
    {
        $data = Auth::user()->id;
        $ketua = User::find($data);

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
            'categories','data','tahun','categories2','data2','tanggal','ketua'));

    }
}
