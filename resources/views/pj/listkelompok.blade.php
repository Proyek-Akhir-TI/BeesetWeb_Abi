@extends('layouts.masterpj')

@section('title')
	<title>Beeset - Daftar Kelompok</title>
@endsection

@section('ul')
<ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="/pj/index">
                <i class="ni ni-tv-2 text-orange"></i>
                <span class="nav-link-text">Beranda</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/pj/tambahkelompok">
                <i class="ni ni-fat-add text-orange"></i>
                <span class="nav-link-text">Tambah Kelompok</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="/pj/daftarkelompok">
                <i class="ni ni-align-center text-orange"></i>
                <span class="nav-link-text">Daftar Kelompok</span>
              </a>
            </li>
          </ul>
@endsection

@section('content')
	<div class="container-fluid mt-5">
      <div class="row">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Daftar Kelompok</h3>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center table-flush table-hover">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Kelompok</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                @php
                  $no = 1;
                @endphp
                @foreach($kelompoks as $kelompok)
                  <tr>
                    <td>
                      {{$no++}}
                    </td>
                    <td> 
                      {{$kelompok->name}}
                    </td>
                    <td>
                      {{$kelompok->address}}
                    </td>
                    <td>
                    <a href="/pj/kelompok/explore/{{$kelompok->id}}"  class="btn btn-sm btn-primary">Explore</a>
                    <a href="/pj/editkelompok/{{$kelompok->id}}" class="btn btn-sm btn-success">Edit</a>
                    <a href="/pj/kelompok/delete/{{$kelompok->id}}" class="btn btn-sm btn-danger">Delete</a>
                    </td>
                  </tr>
                @endforeach
                </tbody>
              </table>
              <div class="float-right mb-3 mt-3">
             		{{ $kelompoks->links()}}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection

