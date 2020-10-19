@extends('layouts.mastersuper')

@section('title')
  <title>Beeset</title>
@endsection

@section('content') 
<div class="container-fluid mt--9">
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
                  
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

@endsection