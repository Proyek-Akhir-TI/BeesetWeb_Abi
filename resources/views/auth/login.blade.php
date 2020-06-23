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
                 <h1 class="text-warning">Login</h1> 
            </div>
              <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group mb-3">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-email-83 text-warning"></i></span>
                    </div>
                    <input id="email" type="email" class="form-control pl-2 @error('email') is-invalid @enderror text-darker" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open text-warning"></i></span>
                    </div>
                    <input id="password" type="password" class="form-control pl-2 @error('password') is-invalid @enderror text-darker" name="password" required autocomplete="current-password" placeholder="Password">
                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                  </div>
                </div>
                <div class="custom-control custom-control-alternative custom-checkbox">
                  <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                  <label for=" customCheckLogin">
                    <span class="text-muted">Remember me</span>
                  </label>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-warning my-4">Log in</button>
                </div>
              </form>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-6">
              @if (Route::has('password.request'))
              <a href="{{ route('password.request') }}" class="text-light"><small>Forgot password?</small></a>
              @endif
            </div>
            <!-- <div class="col-6 text-right">
              <a href="#" class="text-light"><small>Create new account</small></a>
            </div> -->
          </div>
        </div>
      </div>
    </div>
  </div>
  @endsection