@extends('layouts.masterpj')

@section('title')
  <title>Beeset - Edit Kelompok</title>
@endsection

@section('ul')
<ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="{{route('pj.beranda')}}">
                <i class="ni ni-tv-2 text-orange"></i>
                <span class="nav-link-text">Beranda</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="{{route('pj.tambahkelompok')}}">
                <i class="ni ni-fat-add text-orange"></i>
                <span class="nav-link-text">Tambah Kelompok</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('pj.listkelompok')}}">
                <i class="ni ni-align-center text-orange"></i>
                <span class="nav-link-text">Daftar Kelompok</span>
              </a>
            </li>
          </ul>
@endsection
@section('content')
    <!-- Page content -->
      <!-- Table -->
      <div class="row justify-content-center mt-5">
        <div class="col-lg-6 col-md-8">
          <div class="card bg-secondary border-0">
            <div class="card-body px-lg-5 py-lg-5">
            <div class=" text-center mb-5">
                 <h1 class="text-warning">Tambah Kelompok</h1> 
            </div>
            <form role="form" action="{{route('pj.kelompok.update',[$kelompoks->id])}}" method="post">
              {{ csrf_field() }}
                <div class="form-group">
                  <label for="name" class="text-warning mb-3">Edit Kelompok</label>
                  <div class="input-group input-group-merge input-group-alternative mb-3">
                    <div class="input-group-prepend" style="border: 1px #fb6340 solid;">
                      <span class="input-group-text"><i class="ni ni-circle-08 text-warning"></i></span>
                    </div>
                    <input id="name" type="text" class="form-control" style="border: 1px #fb6340 solid; border-left: 1px #fff solid; color: #000;" name="nama" required autocomplete="name" autofocus value="{{$kelompoks->nama}}" >
                  </div>
                </div>
                <div class="form-group">
                    <input id="user_id" type="text" class="form-control" style="border: 1px #fb6340 solid; border-left: 1px #fff solid; color: #000;" name="user_id" required autocomplete="name" autofocus value="{{Auth::user()->id}}" readonly="" hidden="">
                </div>
                <div class="form-group">
                <label for="address" class="text-warning mb-3">Alamat</label>
                  <div class="input-group input-group-merge input-group-alternative mb-3">
                    <div class="input-group-prepend" style="border: 1px #fb6340 solid;">
                      <span class="input-group-text"><i class="ni ni-pin-3 text-warning"></i></span>
                    </div>
                    <textarea id="address" type="text" class="form-control" style="border: 1px #fb6340 solid; border-left: 1px #fff solid; color: #000;" name="alamat" required autocomplete="address" autofocus>{{$kelompoks->alamat}}</textarea>
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-warning mt-4">Tambah</button>
                </div>
            </form>
            </div>
          </div> 
        </div>
      </div>
    </div>
  </div>
@endsection
