@extends('layouts.masterpj')

@section('title')
  <title>Beeset - Detail Kelompok</title>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
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
                    <span class="docs-normal">Opsi {{$kelompoks->nama}}</span>
                </h6>
          <ul class="navbar-nav mb-md-3">
            <li class="nav-item">
              <a class="nav-link active" href="{{route('pj.kelompok.explore',[$kelompoks->id])}}">
                <i class="ni ni-chart-bar-32 text-orange"></i>
                <span class="nav-link-text">Detail Kelompok</span>
              </a>
            </li>
          </ul>
@endsection

@section('content')
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-xl-6">
                <div class="card card-profile p-4">
                    <div class="card-title">
                      <div class="row">
                        <div class="col-xl-6">
                            <h2 class="text-orange">Detail Kelompok<h2>
                        </div>
                      </div>
                    </div> 
                      <div class="row">
                            <div class="col-xl-6">
                                <h4><b>Nama Kelompok</b></h4>
                            </div>
                            <div class="col-xl-6">
                                <h4>: {{$kelompoks->nama}}</h4>
                            </div>                        
                       </div>
                       <div class="row">
                            <div class="col-xl-6">
                                <h4><b>Alamat</b></h4>
                            </div>
                            <div class="col-xl-6">
                                <h4>: {{$kelompoks->alamat}}</h4>
                            </div>                        
                       </div>
                       @foreach($ketuas as $ketua)     
                       <div class="row">
                            <div class="col-xl-6">
                                <h4><b>Nama Ketua Kelompok</b></h4>
                            </div>
                            <div class="col-xl-6">
                                <h4>: {{$ketua->nama}}</h4>
                            </div>                        
                       </div>
                       @endforeach
                       <div class="row">
                            <div class="col-xl-6">
                                <h4><b>Jumlah Anggota</b></h4>
                            </div>
                            <div class="col-xl-6">
                                <h4>: {{$anggotas}}</h4>
                            </div>                        
                       </div>
                       <div class="row">
                            <div class="col-xl-6">
                                <h4><b>Jumlah Kandang</b></h4>
                            </div>
                            <div class="col-xl-6">
                                <h4>: {{$kandangs}}</h4>
                            </div>                        
                       </div>
                       @foreach($panens as $panen) 
                       <div class="row">
                            <div class="col-xl-6">
                                <h4><b>Total Madu Yang Dipanen</b></h4>
                            </div>
                            <div class="col-xl-6">
                                <h4>: {{(float)$panen->total}} Kg</h4>
                            </div>                        
                       </div>
                       @endforeach
                </div>
            </div>
        </div>
        <div class="row">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Tinjauan Panen Anggota Kelompok {{$kelompoks->nama}}</h3>
                </div>
              </div>
            </div>
            <div class="table-responsive">
                <!-- Projects table -->
                <table class="table align-items-center table-flush table-hover">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Kandang</th>
                        <th scope="col">Peternak</th>
                        <th scope="col">Berat</th>
                        <th scope="col">Waktu</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                    $no = 1
                    @endphp
                    @foreach($tables as $val)
                    <tr>
                        <td>
                        {{$no++}}
                        </td>
                        <td>
                            {{$val->nama}}
                        </td>
                        <td>
                            {{$val->peternak}}
                        </td>
                        <td>
                            {{$val->berat}} Kg
                        </td>
                        <td>
                            {{$val->created_at->diffForHumans() }}
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                    
                </table>
                <div class="float-right">{{$tables->links()}}</div>
                </div>
            </div>
          </div>
        </div>
      </div>   
    </div>
@endsection

@section('javascript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
@include('sweet::alert')
@endsection
