@extends('layouts.mastercrud')

@section('title')
  <title>Beeset - Edit Farmer</title>
@endsection

@section('content')
<div class="container mt--8 pb-5">
      <!-- Table -->
      <div class="row justify-content-center">
        <div class="col-lg-9 col-md-8">
          <div class="card bg-secondary border-0">
            <div class="card-body px-lg-5 py-lg-5">
              <div class=" text-center mb-5">
                 <h1 class="text-warning">Tambah Ketua Kelompok</h1> 
            </div>
            <form role="form" action="/pj/uploadketua" method="post" enctype="multipart/form-data">
              {{ csrf_field() }}
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-circle-08 text-warning"></i></span>
                    </div>
                    <input class="form-control" type="text" name="name" placeholder="{{$peternaks->name}}" hidden="">>
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-email-83 text-warning"></i></span>
                    </div>
                    <input type="email" name="email" value="{{$peternaks->email}}" placeholder="{{$peternaks->email}}" hidden="">
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                        <div class="form-group">
                            <div class="input-group input-group-merge input-group-alternative mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-lock-circle-open text-warning"></i></span>
                              </div>
                              <div class="form-group">
                                                  <input type="text" name="password" value="{{$peternaks->password}}" hidden="">
                                              </div>
                            </div>
                          </div>
                  </div>
                  

                <input id="role" type="text" class="form-control" name="telp" value="3" required autofocus readonly hidden>

                <!-- <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-circle-08 text-warning"></i></span>
                    </div>
                    <select id="role_id" class="form-control @error('role_id') is-invalid @enderror" name="role_id" required autocomplete="role_id" autofocus>
                          @foreach ($roles as $id => $name)
                              <option value="{{ $id }}">{{ $name }}</option>
                          @endforeach
                    </select>
                  </div>
                </div> -->

                <div class="row">
                      <div class="col-lg-6">
                          <div class="form-group">
                            <div class="input-group input-group-merge input-group-alternative mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-circle-08 text-warning"></i></span>
                              </div>
                              <select id="kelompok_id" class="form-control @error('kelompok_id') is-invalid @enderror" name="kelompok_id" required autocomplete="kelompok_id" autofocus>
                                          @foreach ($kelompoks as $val)
                                              <option class="text-darker" value="{{ $val->id }}">{{ $val->name }}</option>
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
                                <input id="telp" placeholder="Telp" type="text" class="form-control @error('telp') is-invalid @enderror text-darker" name="telp" value="{{ old('telp') }}" required autocomplete="telp" autofocus>
                              </div>
                            </div>
                      </div>
                </div>


                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-pin-3 text-warning"></i></span>
                    </div>
                    <textarea id="address" placeholder="Address" type="text" class="form-control text-darker" name="address" required autocomplete="address" autofocus></textarea>
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