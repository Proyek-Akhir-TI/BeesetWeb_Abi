@extends('layouts.masterketua')

@section('title')
  <title>Beeset - Daftar Peternak</title>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
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
              <a class="nav-link active" href="{{route('ketua.listpeternak')}}">
                <i class="ni ni-align-center text-orange"></i>
                <span class="nav-link-text">Daftar Peternak</span>
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
              <h6 class="h2 text-white">Daftar Peternak</h6>
            </div>
            <div class="col-lg-2 col-7">
            <form action="{{route('ketua.listpeternak')}}" method="get" class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main">
                <div class="form-group mb-0">
                  <div class="input-group input-group-alternative input-group-merge">
                    
                    <input class="form-control" placeholder="Cari Nama Peternak" type="text" name="cari">
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
                  <h3 class="mb-0">Daftar Peternak Aktif </h3>
                </div>
              </div>
            </div>
            <div class="table-responsive" >
              <!-- Projects table -->
              <table class="table align-items-center table-flush table-hover" style="max-width: 100%;" >
                <thead class="thead-light">
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">Kelompok</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                @php
                  $no = 1;
                @endphp
                @foreach($user as $peternak)
                  <tr>
                    <td>
                      {{$no++}}
                    </td>
                    <td> 
                      {{$peternak->nama}}
                    </td>
                    <td>
                      {{$peternak->email}}
                    </td>
                    <td>
                      {{$peternak->kelompok->nama}}
                    </td>
                    <td>
                      {{$peternak->alamat}}
                    </td>
                    <td>
                    <a href="{{route('ketua.explore',[$peternak->id])}}"  class="btn btn-sm btn-primary">Explore</a>
                    <!-- <a href="/ketua/edit/{{$peternak->id}}" class="btn btn-sm btn-success">Edit</a> -->
                    <a href="{{route('ketua.hapus',[$peternak->id])}}" class="btn btn-sm btn-danger">Hapus</a>
                    </td>
                  </tr>
                @endforeach
                </tbody>
              </table>
              <div class="float-right mb-3 mt-3 mr-3">
                  {{$user->links()}}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div>
  </div>
@endsection
