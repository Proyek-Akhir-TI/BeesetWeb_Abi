@extends('layouts.masterketua')

@section('title')
  <title>Beeset - Kandang</title>
@endsection

@section('ul')
<hr class="my-3">
          <!-- Heading -->
                <h6 class="navbar-heading p-0 text-muted">
                    <span class="docs-normal">Opsi {{$kandangs->name}}</span>
                </h6>
          <ul class="navbar-nav mb-md-3">
            <li class="nav-item">
              <a class="nav-link active" href="/ketua/explore/kandang/{{$kandangs->id}}">
                <i class="ni ni-chart-bar-32 text-orange"></i>
                <span class="nav-link-text">Performa Kandang</span>
              </a>
            </li>
          </ul>
@endsection

@section('content')
    <div class="container-fluid mt-3">
    <div class="row ml-1 mt-4 mb-4">
        <h1>Performa Kandang</h1>
    </div>
        <div class="row">
            <div class="col-xl-6">
                <div class="card card-profile p-4">
                    <div class="card-title">
                      <div class="row">
                        <div class="col-xl-6">
                            <h2 class="text-orange">Informasi Kandang<h2>
                        </div>
                        <div class="col-xl-6">
                            
                        </div>
                      </div>
                    </div> 
                      <div class="row">
                            <div class="col-xl-4">
                                <h4><b>Nama Kandang</b></h4>
                            </div>
                            <div class="col-xl-6">
                                <h4>: {{$kandangs->name}}</h4>
                            </div>                        
                       </div>
                       <div class="row">
                            <div class="col-xl-4">
                                <h4><b>Nama Pemilik</b></h4>
                            </div>
                            <div class="col-xl-6">
                                <h4>: {{$kandangs->user->name}}</h4>
                            </div>                        
                       </div> 
                       <div class="row">
                            <div class="col-xl-4">
                                <h4><b>Kelompok</b></h4>
                            </div>
                            <div class="col-xl-6">
                                <h4>: {{$kandangs->user->kelompok->name}}</h4>
                            </div>                        
                       </div>
                       <div class="row">
                            <div class="col-xl-4">
                                <h4><b>Lokasi</b></h4>
                            </div>
                            <div class="col-xl-6">
                                <h4>: {{$kandangs->location}}</h4>
                            </div>                        
                       </div>
                       @if($kandangs->status == 1)
                       <div class="row">
                            <div class="col-xl-4">
                                <h4><b>Status</b></h4>
                            </div>
                            <div class="col-xl-6">
                                <h4>: Aktif
                                </h4>
                            </div>                        
                       </div>
                       @endif
                       @if($kandangs->status == 0)
                       <div class="row">
                            <div class="col-xl-4">
                                <h4><b>Status</b></h4>
                            </div>
                            <div class="col-xl-6">
                                <h4>: Tidak Aktif
                                </h4>
                            </div>                        
                       </div>
                       @endif    
                </div>
            </div>
        </div>
        @if($kandangs->status == 1)
        <div class="row">
            <div class="col-xl-6">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                      <div class="row">
                          <div class="col-xl-5">
                                <form action="{{url('ketua/explore/kandang').'/'.$kandangs->id}}" method="get">
                                  <div class="row pt-4 pl-3">
                                      <div class="col-xl-10">
                                        <div class="form-group">
                                              <div class="input-group input-group-merge input-group-alternative mb-3">
                                                    <div class="input-group-prepend">
                                                      <span class="input-group-text bg-light text-darker">Tahun</span>
                                                    </div>
                                                    <select class="form-control text-darker pl-2" name="tahun">
                                                      @foreach ($panenyuk as $val)
                                                        <option value="{{$val->year}}" @if($val->year == $tahun) {{'selected="selected"'}} @endif >{{$val->year}}</option>
                                                      @endforeach
                                                    </select>
                                              </div>
                                        </div>
                                      </div>
                                      <div class="col-xl-1">
                                        <button type="submit" class="btn btn-primary">Filter  </button>
                                      </div>
                                  </div>
                                  </form>
                          </div>
                      </div> 
                        <div id="tryChart"></div>
                    </div>    
                </div>
              </div>
            </div>
            <div class="col-xl-6">
          <div class="card">
            <div class="card-header border-0">
              <div class="row align-items-center pb-3">
                <div class="col">
                  <h3 class="mb-0">Aktivitas Kandang</h3>
                </div>
                <div class="col text-right">
                  <a href="" class="btn btn-sm btn-primary" data-target="#tambah-aktivitas" data-toggle="modal">Tambah Aktivitas</a>
                </div>
                <div class="modal fade" id="tambah-aktivitas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Tambah Aktivitas</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="/ketua/peternak/kandang/aktivitas/unggah" role="form">
                              {{ csrf_field() }}
                                    <div class="form-group">
                                        <div class="form-group">
                                          <label for="exampleInputPassword1">Kandang</label>
                                          <select class="form-control" name="kandang_id">
                                            
                                              <option value="{{ $kandangs->id }}">{{ $kandangs->id }}</option>
                                          </select>
                                        </div>
                                        <div class="form-group">
                                          <label for="exampleInputPassword1">Aktivitas</label>
                                          <select class="form-control" name="aktivitas_id">
                                            @foreach ($jenisaktivitas as $id => $name)
                                              <option value="{{ $id }}">{{ $name }}</option>
                                            @endforeach
                                          </select>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                          <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                            </form>
                        </div>
                      </div>
                    </div>
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
                      {{$akt->aktivitasKandang->aktivitas}}
                    </td>
                    <td>
                      {{$akt->created_at->diffForHumans()}}
                    </td>
                  </tr>
                @endforeach
                </tbody>
              </table>
              <div class="float-right mb-3 mt-3">
                {{$aktivitas->withQueryString()->links()}}
              </div>
            </div>
          </div>
        </div>
        </div>
    </div>
    @endif
    @if($kandangs->status == 0)
      <div class="card">
        <div class="card-header">Data Tidak Tersedia</div>
      </div>
    @endif
@endsection

@section('javascript')
  <script src="https://code.highcharts.com/highcharts.js"></script>
<script>
  Highcharts.chart('tryChart', {
    chart: {
        type: 'area'
    },
    title: {
        text: 'Grafik Jumlah Panen Kandang {{$kandangs->name}}'
    },
    xAxis: {
        categories: {!!json_encode($categories)!!},
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Berat Panen Madu (Kg)'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} kg</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Panen '+{!!json_encode($tahun)!!},
        data: {!!json_encode($data)!!},
        // data: [1,2],

    }]
});
</script>
@endsection

