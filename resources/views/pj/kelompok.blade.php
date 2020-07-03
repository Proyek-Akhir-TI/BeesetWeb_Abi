@extends('layouts.masterpj')

@section('title')
  <title>Beeset - Detail Kelompok</title>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
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
                                <h4>: {{$kelompoks->name}}</h4>
                            </div>                        
                       </div>
                       <div class="row">
                            <div class="col-xl-6">
                                <h4><b>Alamat</b></h4>
                            </div>
                            <div class="col-xl-6">
                                <h4>: {{$kelompoks->address}}</h4>
                            </div>                        
                       </div>
                       @foreach($ketuas as $ketua)     
                       <div class="row">
                            <div class="col-xl-6">
                                <h4><b>Nama Ketua Kelompok</b></h4>
                            </div>
                            <div class="col-xl-6">
                                <h4>: {{$ketua->name}}</h4>
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
        <div class="card">
            <div class="table-responsive pt-4">
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
                    @foreach($tables as $val)
                    <tr>
                        <td>
                        {{$no++}}
                        </td>
                        <td>
                            {{$val->name}}
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
@endsection

@section('javascript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
@include('sweet::alert')
@endsection
