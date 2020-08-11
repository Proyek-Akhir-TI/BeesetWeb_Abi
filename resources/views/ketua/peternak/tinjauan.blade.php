@extends('layouts.masterketua')

@section('title')
  <title>Beeset - Tinjauan Panen</title>
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
          <hr class="my-3">
          <!-- Heading -->
                <h6 class="navbar-heading p-0 text-muted">
                    <span class="docs-normal">Opsi</span>
                </h6>
          <ul class="navbar-nav mb-md-3">
            <li class="nav-item">
              <a class="nav-link active" href="#"> 
                <i class="ni ni-chart-bar-32 text-orange"></i>
                <span class="nav-link-text">Tinjauan Panen</span>
              </a>
            </li>
          </ul>
@endsection
@section('content')
<div class="header bg-warning pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-2 col-7">
              <h6 class="h2 text-white">Tinjauan Panen</h6>
            </div>
            <div class="col-lg-2 col-7">
            <form action="{{route('ketua.tinjauan',[$id_peternak])}}" method="get" class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main">
                <div class="form-group mb-0">
                  <div class="input-group input-group-alternative input-group-merge">
                    
                    <input class="form-control" placeholder="Cari Nama Kandang" type="text" name="cari">
                    <span class="input-group-text"><a type="submit"><i class="fas fa-search"></i></a></span>
                  </div>
                </div>
                <button type="button" class="close" data-action="search-close" data-target="#navbar-search-main" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </form>
            </div>
            
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid mt--5">
      <div class="row">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Tinjauan Panen Peternak </h3>
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
                    <th scope="col">Berat</th>
                    <th scope="col">Waktu</th>
                  </tr>
                </thead>
                <tbody>
                @php
                 $no = 1
                @endphp
                 @foreach($detailpanens as $panen)
                  <tr>
                    <td>
                       {{$no++}}
                    </td>
                    <td>
                        {{$panen->nama}}
                    </td>
                    <td>
                        {{$panen->berat}} Kg
                    </td>
                    <td>
                      {{$panen->created_at->diffForHumans() }}
                    </td>
                  </tr>
                @endforeach
                </tbody>
                
              </table>
              <div class="float-right mb-3 mt-3"> 
                {{$detailpanens->links()}}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  
@endsection

@section('javascript')


<!-- -->
@endsection