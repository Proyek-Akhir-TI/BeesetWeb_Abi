@extends('layouts.masterpj')

@section('title')
  <title>Beeset - Profil Saya</title>
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
          <hr class="my-3">
          <!-- Heading -->
                <h6 class="navbar-heading p-0 text-muted">
                    <span class="docs-normal">Opsi</span>
                </h6>
          <ul class="navbar-nav mb-md-3">
            <li class="nav-item">
              <a class="nav-link active" href="#">
                <i class="ni ni-circle-08 text-orange"></i>
                <span class="nav-link-text">Profil Saya</span>
              </a>
            </li>
          </ul>
@endsection
@section('content')
<div class="container-fluid row mt-5">
  <div class="col-lg-5">
  <div class="card card-profile pt-4">
                        <img src="{{ asset('img/theme/theme.jpg')}}" alt="Image placeholder" class="card-img-top" style="max-height:80px;">
                        <div class="row justify-content-center">
                          <div class="col-lg-3 order-lg-2">
                            <div class="card-profile-image">
                              <a href="#">
                                <img src="{{ asset('storage/uploads/'.$pj->photo)}}" class="rounded-circle">
                              </a>
                            </div>
                          </div>
                        </div>
                        <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                        
                      </div>
                        <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                          <div class="d-flex justify-content-between">

                          </div>
                        </div>
                        <div class="card-body pt-2">   
                          <div class="text-center">
                            <h2>{{$pj->nama}}</h2>
                            <div class="h5 font-weight-300">
                              <i class="ni location_pin mr-2"></i>{{$pj->email}}
                            </div>
                            <div class="h5">
                              <i class="ni business_briefcase-24 mr-2"></i>{{$pj->kelompok->nama}}
                            </div>
                            <div class="h5">
                              <i class="ni business_briefcase-24 mr-2"></i>{{$pj->alamat}} - {{$pj->telpon}}
                            </div>
                            <div>
                              <i class="ni education_hat mr-2"></i>
                            </div>
                          </div>
                        </div>
                      </div> 
            </div>
  
  <div class="col-lg-7">
          <div class="card bg-secondary border-0">
            <div class="card-body px-lg-5 py-lg-5">
              <div class=" text-center mb-5">
                 <h1 class="text-warning">Edit Profil</h1> 
            </div>
            <form role="form" action="{{route('pj.update',[$pj->id])}}" method="post" enctype="multipart/form-data">
              {{ csrf_field() }}
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-circle-08 text-warning"></i></span>
                    </div>
                    <input id="nama" placeholder="Nama" type="text" class="form-control text-darker" name="nama" value="{{$pj->nama}}" required autofocus>
                    </div>
                </div>

                <div class="form-group">
                      <div class="input-group input-group-merge input-group-alternative mb-3">
                          <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="fas fa-phone-square-alt text-warning"></i></span>
                                </div>
                                <input id="telpon" placeholder="No. Telpon" type="text" class="form-control text-darker" name="telpon" value="{{$pj->telpon}}" required>
                              </div>
                          </div>

                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-pin-3 text-warning"></i></span>
                    </div>
                    <textarea id="alamat" placeholder="Alamat" type="text" class="form-control text-darker" name="alamat" required autocomplete="alamat">{{$pj->alamat}}</textarea>
                  </div>
                </div>

                <div class="row">
                      <span class="h5 pl-3 text-warning">*Update Email Jika Diperlukan</span>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-email-83 text-warning"></i></span>
                    </div>
                    <input id="email" placeholder="Email" type="email" class="form-control text-darker" name="email" value="{{$pj->email}}">
                  </div>
                </div>
                
                <div class="row">
                      <span class="h5 pl-3 text-warning">*Update Password Jika Diperlukan</span>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                        <div class="form-group">
                            <div class="input-group input-group-merge input-group-alternative mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-lock-circle-open text-warning"></i></span>
                              </div>
                              <input id="password" placeholder="Password" type="password" class="form-control text-darker" name="password"  >
                            </div>
                          </div>
                  </div>
                  <div class="col-lg-6">
                        <div class="form-group">
                        <div class="input-group input-group-merge input-group-alternative mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-lock-circle-open text-warning"></i></span>
                          </div>
                          <input id="confirm_password" placeholder="Ketik Ulang Password" type="password" class="form-control text-darker" name="password_confirmation" autocomplete="new-password">
                        </div>
                        <span class="h5" id='message'></span>
                      </div>
                  </div>
                </div>
                <div class="form-group">
                    <label for="photo" class="text-warning"> Foto (Update Foto Jika Diperlukan) </label>
                    <input id="photo" type="file" class="form-control-file" name="photo" onchange="readURL(this);" autocomplete="photo" >
                </div>
                <div class="text-center">
                  <button id="button" type="submit" class="btn btn-warning mt-4">Edit</button>
                </div>
            </form>
            </div>
          </div>
        </div>
</div>
@endsection
