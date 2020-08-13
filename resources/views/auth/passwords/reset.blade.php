@extends('layouts.masterlogin')

@section('title')
  <title>Beeset - Login</title>
@endsection

@section('content')
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary border-0 mb-0">
            <div class="card-body px-lg-5 py-lg-5">
              <div class=" text-center mb-5">
                 <h1 class="text-warning">Reset Password</h1> 
            </div>
              <form method="POST" action="{{ route('reset') }}">
                @csrf
                <div class="form-group mb-3">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-email-83 text-warning"></i></span>
                    </div>
                    <input id="email" type="text" class="form-control pl-2 text-darker" name="nama" required autocomplete="email" autofocus placeholder="Nama Lengkap">
                  </div>
                </div>
                <div class="form-group mb-3">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-email-83 text-warning"></i></span>
                    </div>
                    <input id="email" type="email" class="form-control pl-2 text-darker" name="email" required autocomplete="email" autofocus placeholder="Email">
                  </div>
                </div>
                <div class="form-group mb-3">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-email-83 text-warning"></i></span>
                    </div>
                    <input id="email" type="text" class="form-control pl-2 text-darker" name="telpon" required autocomplete="email" autofocus placeholder="No. Telpon">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open text-warning"></i></span>
                    </div>
                    <input id="password" type="password" class="form-control pl-2 text-darker" name="password" required autocomplete="current-password" placeholder="Password">
                    
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-warning my-4">Reset</button>
                </div>
              </form>
            </div>
          </div>
          
        </div>
      </div>
    </div>
  </div>
  @endsection