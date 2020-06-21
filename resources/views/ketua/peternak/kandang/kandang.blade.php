@extends('layouts.masterkandang')

@section('title')
  <title>Beeset - Cage</title>
@endsection

@section('content')
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-xl-6">
                <div class="card card-profile p-4">
                    <div class="card-title">
                      <div class="row">
                        <div class="col-xl-6">
                            <h2 class="text-orange">Cage Info<h2>
                        </div>
                        <div class="col-xl-6">
                            <img src="{{ asset('storage/uploads/'.$kandangs->user->photo)}}" class="rounded-circle img-info float-right" title="{{$kandangs->user->name}}">
                        </div>
                      </div>
                    </div> 
                      <div class="row">
                            <div class="col-xl-4">
                                <h4><b>Cage Name</b></h4>
                            </div>
                            <div class="col-xl-6">
                                <h4>: {{$kandangs->name}}</h4>
                            </div>                        
                       </div>
                       <div class="row">
                            <div class="col-xl-4">
                                <h4><b>Owner</b></h4>
                            </div>
                            <div class="col-xl-6">
                                <h4>: {{$kandangs->user->name}}</h4>
                            </div>                        
                       </div> 
                       <div class="row">
                            <div class="col-xl-4">
                                <h4><b>Team</b></h4>
                            </div>
                            <div class="col-xl-6">
                                <h4>: {{$kandangs->user->kelompok->name}}</h4>
                            </div>                        
                       </div> 
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-4">
                <div id="tryChart" class="card"></div>
            </div>
            <div class="col-xl-8">
          <div class="card">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Aktivitas Kandang</h3>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center table-flush table-hover">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Aktivitas</th>
                    <th scope="col">Waktu</th>
                  </tr>
                </thead>
                <tbody>
                @php
                  $no = 1;
                @endphp
                @foreach($aktivitas as $akt)
                  <tr>
                    <td>
                      {{$no++}}
                    </td>
                    <td> 
                      {{$akt->aktivitasKandang->name}}
                    </td>
                    <td>
                      {{$akt->}}
                    </td>
                  </tr>
                @endforeach
                </tbody>
              </table>
              <div class="float-right mb-3 mt-3">
             
              </div>
            </div>
          </div>
        </div>
        </div>
    </div>
@endsection

