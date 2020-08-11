@extends('layouts.masterpj')

@section('title')
  <title>Beeset - Tambah Ketua</title>
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
              <a class="nav-link" href="{{route('pj.tambahkelompok')}}">
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
                <i class="ni ni-fat-add text-orange"></i>
                <span class="nav-link-text">Tambah Ketua</span>
              </a>
            </li>
          </ul>
@endsection

@section('content') 
    <!-- Page content -->
    <!-- <div class="container mt--8 pb-5"> -->
      <!-- Table -->
      <div class="row justify-content-center mt-5">
        <div class="col-lg-9 col-md-8">
          <div class="card bg-secondary border-0">
            <div class="card-body px-lg-5 py-lg-5">
              <div class=" text-center mb-5">
                 <h1 class="text-warning">Tambah Ketua Kelompok</h1> 
            </div>
            <form role="form" action="{{route('pj.uploadketua')}}" method="post" enctype="multipart/form-data">
              {{ csrf_field() }}
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-circle-08 text-warning"></i></span>
                    </div>
                    <input id="nama" placeholder="Nama" type="text" class="form-control text-darker" name="nama" required autofocus>
                    </div>
                </div>

                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-email-83 text-warning"></i></span>
                    </div>
                    <input id="email" placeholder="Email" type="email" class="form-control text-darker" name="email" required>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                        <div class="form-group">
                            <div class="input-group input-group-merge input-group-alternative mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-lock-circle-open text-warning"></i></span>
                              </div>
                              <input id="password" placeholder="Password" type="password" class="form-control text-darker" name="password" required >
                            </div>
                          </div>
                  </div>
                  <div class="col-lg-6">
                        <div class="form-group">
                        <div class="input-group input-group-merge input-group-alternative mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-lock-circle-open text-warning"></i></span>
                          </div>
                          <input id="confirm_password" placeholder="Ketik Ulang Password" type="password" class="form-control text-darker" name="password_confirmation" required autocomplete="new-password">
                        </div>
                        <span class="h5" id='message'></span>
                      </div>
                  </div>
                </div>

                   <div class="row">
                      <div class="col-lg-6">
                          <div class="form-group">
                            <div class="input-group input-group-merge input-group-alternative mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-circle-08 text-warning"></i></span>
                              </div>
                              <select id="kelompok_id" class="form-control text-darker" name="kelompok_id" required autocomplete="kelompok_id" autofocus>
                                          @foreach ($kelompoks as $val)
                                              <option class="text-darker" value="{{ $val->id }}">{{ $val->nama }}</option>
                                          @endforeach
                              </select>
                            </div>
                          </div>
                      </div>
                      <div class="col-lg-6">
                          <div class="form-group">
                              <div class="input-group input-group-merge input-group-alternative mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="fas fa-phone-square-alt text-warning"></i></span>
                                </div>
                                <input id="telpon" placeholder="No. Telpon" type="text" class="form-control text-darker" name="telpon" required>
                              </div>
                            </div>
                      </div>
                </div>

                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-pin-3 text-warning"></i></span>
                    </div>
                    <textarea id="alamat" placeholder="Alamat" type="text" class="form-control text-darker" name="alamat" required autocomplete="alamat"></textarea>
                  </div>
                </div>
                <div class="form-group">
                    <label for="photo" class="text-warning"> Foto </label>
                    <input id="photo" type="file" class="form-control-file" name="photo" onchange="readURL(this);" required autocomplete="photo" >
                </div>

                <div class="text-center">
                  <button id="button" type="submit" class="btn btn-warning mt-4" disabled="">Tambah</button>
                </div>
            </form>
            </div>
          </div>
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
          $('#button').removeAttr("disabled");
        } else {
          $('#message').html('Password Tidak Cocok').css('color', 'red');
          var element = document.getElementById('button');
          element.setAttribute('disabled','disabled');
        }

      });
</script>
@endsection