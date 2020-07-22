@extends('layouts.masterketua')

@section('title')
  <title>Beeset - Konfirmasi Peternak</title>
@endsection
@section('ul')
<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header  align-items-center">
        <a class="navbar-brand" href="javascript:void(0)">
          <img src="{{ asset('/img/brand/logo.png')}}"> 
          <!-- <img src="/img/brand/blue.png" class="navbar-brand-img" alt="..."> -->
        </a>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
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
@endsection
@section('content')
    <div class="container-fluid mt-5">
    @if($jumlah != 0)
    <div class="row">
      <div class="row">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Peternak Tidak Aktif</h3>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center table-flush table-hover" >
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
                    <a href="{{route('ketua.detailkonfirmasi',[$peternak->id])}}"  class="btn btn-sm btn-primary">Detail</a>
                    <!-- <a href="/ketua/edit/{{$peternak->id}}" class="btn btn-sm btn-success">Edit</a> -->
                    <a href="{{route('ketua.hapus',[$peternak->id])}}" class="btn btn-sm btn-danger">Hapus</a>
                    </td>
                  </tr>
                @endforeach
                </tbody>
              </table>
              <div class="float-right mb-3 mt-3"> 
                {{--$user->links()--}}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @elseif($jumlah == 0)
    <div class="text-center mt-7">
          <h2>--Tidak Ada Peternak Yang Harus Dikonfirmasi--</h2>
    </div>
    @endif
    </div>
  
@endsection

@section('javascript')


<!-- -->
@endsection