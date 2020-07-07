@extends('layouts.masterpj')

@section('title')
	<title>Beeset - Highlight Kelompok</title>
@endsection

@section('ul')
<ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" href="/pj/index">
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
              <a class="nav-link" href="/pj/daftarkelompok">
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
                  <h3 class="mb-0">Hasil Panen Kelompok</h3>
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
                    <th scope="col">Hasil Panen</th>
                    <th scope="col">Terakhir Panen</th>
                  </tr>
                </thead>
                <tbody>
                @php
                  $no = 1;
                @endphp
                @foreach($datas as $data)
                  <tr>
                    <td>
                      {{$no++}}
                    </td>
                    <td> 
                      {{$data->name}}
                    </td>
                    <td>
                      {{$data->address}}
                    </td>
                    @if($data->total > 0)
                    <td>
                      {{$data->total}} Kg
                    </td>
                    @endif
                    @if($data->total == null)
                    <td>
                      Belum Panen
                    </td>
                    @endif
                    @if($data->total > 0)
                    <td>
                      {{$data->created_at->diffForHumans()}}
                    </td>
                    @endif
                    @if($data->total == null)
                    <td>
                      Belum Panen
                    </td>
                    @endif
                  </tr>
                @endforeach
                </tbody>
              </table>
              <div class="float-right mb-3 mt-3">
             	    {{$datas->links()}}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection

