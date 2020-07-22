@extends('layouts.masterketua')

@section('title')
  <title>Beeset - Konfirmasi Peternak</title>
@endsection
@section('ul')
<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header  align-items-center">
        <a class="navbar-brand" href="javascript:void(0)">
          <img src="{{ asset('/img/brand/logo.png')}}"> 
          <!-- <img src="/img/brand/blue.png" class="navbar-brand-img" alt="..."> -->
        </a>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="{{route('ketua.index')}}">
                <i class="ni ni-tv-2  text-orange"></i>
                <span class="nav-link-text">Beranda</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="{{route('ketua.konfirmasipeternak')}}">
                <i class="ni ni-bell-55 text-orange"></i>
                <span class="nav-link-text">Konfirmasi Peternak</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('ketua.listpeternak')}}">
                <i class="ni ni-align-center text-orange"></i>
                <span class="nav-link-text">Daftar Peternak</span>
              </a>
            </li>
          </ul>
@endsection
@section('content')
    <div class="container-fluid mt-5">
      <div class="row">
         <div class="col-xl-4">
                  <div class="card card-profile">
                    <img src="{{ asset('img/theme/img-1-1000x600.jpg')}}" alt="Image placeholder" class="card-img-top">
                    <div class="row justify-content-center">
                      <div class="col-lg-3 order-lg-2">
                        <div class="card-profile-image">
                          <a href="#">
                            <img src="{{ asset('storage/uploads/'.$peternaks->photo)}}" class="rounded-circle">
                          </a>
                        </div>
                      </div>
                    </div>
                    <div class="card-header text-center border-0 pt-8 pt-md-6 pb-0 pb-md-3">
                      <div class="d-flex justify-content-between">
                        <a href="" class="btn btn-sm btn-danger  mr-4 ">Hapus</a>
                        <a href="#" class="btn btn-sm btn-success float-right" data-target="#konfirmasi" data-toggle="modal">Konfirmasi</a>
                      </div>
                    </div>
                    <div class="card-body pt-0">
                      </div>
                      <div class="text-center">
                        <h2>{{$peternaks->nama}}</h2>
                        <div>
                          <i class="ni education_hat mr-2"></i>
                        </div>
                      </div>
                    </div>
                  </div> 
          <div class="col-xl-8">
            <div class="card card-profile p-4">
                    <div class="card-title">
                      <div class="row">
                        <div class="col-xl-6">
                            <h2 class="text-orange">Informasi Peternak<h2>
                        </div>
                        <div class="col-xl-6">
                            
                        </div>
                      </div>
                    </div> 
                      <div class="row">
                            <div class="col-xl-4">
                                <h4><b>Nama</b></h4>
                            </div>
                            <div class="col-xl-6">
                                <h4>: {{$peternaks->nama}}</h4>
                            </div>                        
                       </div>
                       <div class="row">
                            <div class="col-xl-4">
                                <h4><b>Email</b></h4>
                            </div>
                            <div class="col-xl-6">
                                <h4>: {{$peternaks->email}}</h4>
                            </div>                        
                       </div> 
                       <div class="row">
                            <div class="col-xl-4">
                                <h4><b>Alamat</b></h4>
                            </div>
                            <div class="col-xl-6">
                                <h4>: {{$peternaks->alamat}}</h4>
                            </div>                        
                       </div>
                       <div class="row">
                            <div class="col-xl-4">
                                <h4><b>Nomor Telepon</b></h4>
                            </div>
                            <div class="col-xl-6">
                                <h4>: {{$peternaks->telpon}}</h4>
                            </div>                        
                       </div>
                       <div class="row">
                            <div class="col-xl-4">
                                <h4><b>Tanggal Daftar</b></h4>
                            </div>
                            <div class="col-xl-5">
                                <h4>: {{\Carbon\Carbon::parse($peternaks->created_at)->isoFormat('LLLL')}}</h4>
                            </div>                        
                       </div>
                       <div class="row mt-4">
                            <div class="col-xl-2">
                                <h4><b>Status</b></h4>
                            </div>
                                <h4><div class="badge-pill text-capitalize badge-danger">Belum Dikonfirmasi</div>
                                </h4>                 
                       </div>    
                </div>
          </div>
      </div>
      <div class="modal fade" id="konfirmasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                  <form method="post" action="{{route('ketua.peternak.konfirmasi',[$peternaks->id])}}" role="form" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                          <div class="form-group">
                                              <div class="form-group">
                                                  <input type="text" name="nama" value="{{$peternaks->nama}}" placeholder="{{$peternaks->nama}}" hidden="">
                                              </div>
                                              <div class="form-group">
                                                  <input type="email" name="email" value="{{$peternaks->email}}" placeholder="{{$peternaks->email}}" hidden="">
                                              </div>
                                              <div class="form-group">
                                                  <input type="text" name="password" value="{{$peternaks->password}}" hidden="">
                                              </div>
                                              <div class="form-group">
                                                  <input type="text" name="kelompok_id" value="{{$peternaks->kelompok_id}}" placeholder="{{$peternaks->kelompok_id}}" hidden="">
                                              </div>
                                              <div class="form-group">
                                                  <input type="text" name="role_id" value="{{$peternaks->role_id}}" placeholder="{{$peternaks->role_id}}" hidden="">
                                              </div>
                                              <div class="form-group">
                                                  <input type="text" name="alamat" value="{{$peternaks->alamat}}" placeholder="{{$peternaks->alamat}}" hidden="">
                                              </div>
                                              <div class="form-group">
                                                  <input type="text" name="telpon" value="{{$peternaks->telpon}}" placeholder="{{$peternaks->telpon}}" hidden="">
                                              </div>
                                              <div class="form-group">
                                                  <input type="number" name="status" value="1" placeholder="Konfirmasi" hidden="">
                                              </div>
                                              <div class="form-group">
                                            
                                                     <input id="photo" type="file" class="form-control-file" name="photo" onchange="readURL(this);" autocomplete="photo" hidden="">
                                              </div>
                                              <h3>Konfirmasi User Peternak ?</h3>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Keluar</button>
                                                <button type="submit" class="btn btn-primary">Ya, Konfirmasi</button>
                                              </div>
                                  </form>
                              </div>
                            </div>
                          </div>
                        </div>
    </div>
    <div>
  </div>
@endsection

@section('javascript')

@endsection