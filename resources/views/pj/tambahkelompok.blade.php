@extends('layouts.mastercrud')

@section('title')
  <title>Beeset - Tambah Kelompok</title>
@endsection

@section('ul')
<ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a href="/pj/index" class="nav-link">
              <span class="nav-link-inner--text"><h3 class="text-white">Dashboard</h3></span>
            </a>
          </li>
        </ul>
@endsection
@section('content')
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <!-- Table -->
      <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
          <div class="card bg-secondary border-0">
            <div class="card-body px-lg-5 py-lg-5">
            <div class=" text-center mb-5">
                 <h1 class="text-warning">Tambah Kelompok</h1> 
            </div>
            <form role="form" action="/pj/uploadkelompok" method="post">
              {{ csrf_field() }}
                <div class="form-group">
                  <label for="name" class="text-warning mb-3">Nama Kelompok</label>
                  <div class="input-group input-group-merge input-group-alternative mb-3">
                    <div class="input-group-prepend" style="border: 1px #fb6340 solid;">
                      <span class="input-group-text"><i class="ni ni-circle-08 text-warning"></i></span>
                    </div>
                    <input id="name" type="text" class="form-control" style="border: 1px #fb6340 solid; border-left: 1px #fff solid; color: #000;" name="name" required autocomplete="name" autofocus>
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
                    <textarea id="address" type="text" class="form-control" style="border: 1px #fb6340 solid; border-left: 1px #fff solid; color: #000;" name="address" required autocomplete="address" autofocus></textarea>
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
