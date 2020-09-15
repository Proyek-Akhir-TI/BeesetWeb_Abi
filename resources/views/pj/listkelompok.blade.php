@extends('layouts.masterpj')

@section('title')
	<title>Beeset - Daftar Kelompok</title>
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
              <a class="nav-link active" href="{{route('pj.listkelompok')}}">
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
                    <th scope="col" style="display:none;">id</th>
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
                    <td style="display:none;">
                      {{$kelompok->id}}
                    </td>
                    <td> 
                      {{$kelompok->nama}}
                    </td>
                    <td>
                      {{$kelompok->alamat}}
                    </td>
                    <td>
                    <a href="{{route('pj.kelompok.explore',[$kelompok->id])}}"  class="btn btn-sm btn-primary">Explore</a>
                    <a href="{{route('pj.kelompok.edit',[$kelompok->id])}}"  class="btn btn-sm btn-success edit">Edit</a>
                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#hapusModal">Hapus</button>
                    
                    <div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Hapus Kelompok</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            Menghapus kelompok akan menghapus semua data kelompok <br>beserta data peternaknya
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <a href="{{route('pj.kelompok.delete',[$kelompok->id])}}" type="button" class="btn btn-danger">Hapus</a>
                          </div>
                        </div>
                      </div>
                    </div>

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

@section('javascript')
  
@endsection