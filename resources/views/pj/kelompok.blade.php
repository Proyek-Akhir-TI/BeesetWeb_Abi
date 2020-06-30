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
                            <div class="col-xl-4">
                                <h4><b>Nama Kelompok</b></h4>
                            </div>
                            <div class="col-xl-6">
                                <h4>: {{$kelompoks->name}}</h4>
                            </div>                        
                       </div>
                       <div class="row">
                            <div class="col-xl-4">
                                <h4><b>Alamat</b></h4>
                            </div>
                            <div class="col-xl-6">
                                <h4>: {{$kelompoks->address}}</h4>
                            </div>                        
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
