@extends('layouts.mastersuper')

@section('title')
  <title>Beeset - Admin Tambah Ketua</title>
@endsection

@section('content') 
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <!-- Table -->
      <div class="row justify-content-center">
        <div class="col-lg-9 col-md-8">
          <div class="card bg-secondary border-0">
            <div class="card-body px-lg-5 py-lg-5">
              <div class=" text-center mb-5">
                 <h1 class="text-warning">Tambah User</h1> 
            </div>
            <form role="form" action="{{route('administrator.buatuser')}}" method="post" enctype="multipart/form-data">
              {{ csrf_field() }}
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-circle-08 text-warning"></i></span>
                    </div>
                    <input id="name" placeholder="Name" type="text" class="form-control text-darker" name="nama" required autocomplete="name" autofocus>
                    
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-email-83 text-warning"></i></span>
                    </div>
                    <input id="email" placeholder="Email" type="email" class="form-control text-darker" name="email" required autocomplete="email">
                   
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open text-warning"></i></span>
                    </div>
                    <input id="password" placeholder="Password" type="password" class="form-control text-darker" name="password" required autocomplete="new-password">
                    
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open text-warning"></i></span>
                    </div>
                    <input id="password-confirm" placeholder="Re-type Password" type="password" class="form-control text-darker" name="password_confirmation" required autocomplete="new-password">
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-circle-08 text-warning"></i></span>
                    </div>
                    <select id="role_id" class="form-control @error('role_id') is-invalid @enderror" name="role_id" required autocomplete="role_id" autofocus>
                          @foreach ($roles as $id => $nama)
                              <option value="{{ $id }}">{{ $nama }}</option>
                          @endforeach
                    </select>
                  </div>
                </div>

                <div class="row">
                      <div class="col-lg-6">
                          <div class="form-group">
                            <div class="input-group input-group-merge input-group-alternative mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-circle-08 text-warning"></i></span>
                              </div>
                              <select id="kelompok_id" class="form-control @error('kelompok_id') is-invalid @enderror" name="kelompok_id" required autocomplete="kelompok_id" autofocus>
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
                                <input id="telp" placeholder="Telp" type="text" class="form-control text-darker" name="telpon" value="{{ old('telp') }}" required autocomplete="telp" autofocus>
                              </div>
                            </div>
                      </div>
                </div>


                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-pin-3 text-warning"></i></span>
                    </div>
                    <textarea id="address" placeholder="Address" type="text" class="form-control text-darker" name="alamat" required autocomplete="address" autofocus></textarea>
                  </div>
                </div>
                
                <div class="form-group">
                    <label for="photo" class="text-warning"> Foto </label>
                    <input id="photo" type="file" class="form-control-file" name="photo" onchange="readURL(this);" required autocomplete="photo" >
                </div>

                <div class="text-center">
                  <button type="submit" class="btn btn-warning mt-4">Add</button>
                </div>
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection