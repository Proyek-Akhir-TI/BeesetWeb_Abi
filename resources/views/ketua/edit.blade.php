@extends('layouts.masterketua')

@section('title')
  <title>Beeset - Edit Profil</title>
@endsection

@section('ul')

          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="{{route('ketua.index')}}">
                <i class="ni ni-tv-2  text-orange"></i>
                <span class="nav-link-text">Beranda</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('ketua.konfirmasipeternak')}}">
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
<hr class="my-3">
          <!-- Heading -->
                <h6 class="navbar-heading p-0 text-muted">
                    <span class="docs-normal">Opsi {{$ketua->nama}}</span>
                </h6>
          <ul class="navbar-nav mb-md-3">
            <li class="nav-item">
              <a class="nav-link active" href="{{route('ketua.edit',[$ketua->id]) }}">
                <i class="ni ni-circle-08 text-orange"></i>
                <span class="nav-link-text">Edit Profil</span>
              </a>
            </li>
          </ul>
@endsection

@section('content') 

  <div class="row justify-content-center mt-5">
  <div class="col-lg-9 col-md-8">
          <div class="card bg-secondary border-0">
            <div class="card-body px-lg-5 py-lg-5">
              <div class=" text-center mb-5">
                 <h1 class="text-warning">Edit Profil</h1> 
            </div>
            <form role="form" action="{{route('ketua.update',[$ketua->id])}}" method="post" enctype="multipart/form-data">
              {{ csrf_field() }}
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-circle-08 text-warning"></i></span>
                    </div>
                    <input id="nama" placeholder="Nama" type="text" class="form-control text-darker" name="nama" value="{{$ketua->nama}}" required autofocus>
                    </div>
                </div>

                <div class="form-group">
                      <div class="input-group input-group-merge input-group-alternative mb-3">
                          <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="fas fa-phone-square-alt text-warning"></i></span>
                                </div>
                                <input id="telpon" placeholder="No. Telpon" type="text" class="form-control text-darker" name="telpon" value="{{$ketua->telpon}}" required>
                              </div>
                          </div>
            
                
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-pin-3 text-warning"></i></span>
                    </div>
                    <textarea id="alamat" placeholder="Alamat" type="text" class="form-control text-darker" name="alamat" required autocomplete="alamat">{{$ketua->alamat}}</textarea>
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
                    <input id="email" placeholder="Email" type="email" class="form-control text-darker" name="email" value="{{$ketua->email}}">
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

@section('javascript')
<script type="text/javascript">
  $('#password, #confirm_password').on('keyup', function () {
        if ($('#password').val() == $('#confirm_password').val()) {
          $('#message').html('Password Cocok').css('color', 'green');
        } else {
          $('#message').html('Password Tidak Cocok').css('color', 'red');
        }

      });
</script>
@endsection