@extends('layouts.masterpj')

@section('title')
	<title>Beeset - Highlight Kelompok</title>
@endsection

@section('ul') 
<ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" href="{{route('pj.beranda')}}">
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
              <a class="nav-link" href="{{route('pj.listkelompok')}}">
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
            <div class="row">
                <div class="col-xl-6">
                    <div class="card pt-5">
                      <div class="row">
                      </div> 
                        <div id="chart"></div>
                    </div>    
                </div>
                <div class="col-xl-6">
                          <div class="row">
                            <div class="col-xl-6 col-md-6">
                              <div class="card card-stats">
                                <!-- Card body -->
                                <div class="card-body pt-5">
                                  <div class="row">
                                    <div class="col">
                                      <h5 class="card-title text-uppercase text-muted mb-0">Total Kelompok</h5>
                                      <span class="h2 font-weight-bold mb-0">{{$jml_kelompok}} Kelompok</span>
                                    </div>
                                    <div class="col-auto">
                                      <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                        <i class="ni ni-circle-08"></i>
                                      </div>
                                    </div>
                                  </div>
                                  <p class="mt-3 mb-0 text-sm">
                                    <span class="text-success mr-2"></i></span>
                                    <span class="text-nowrap"></span>
                                  </p>
                                </div>
                              </div>
                            </div>
                            <div class="col-xl-6 col-md-6">
                              <div class="card card-stats">
                                <!-- Card body -->
                                <div class="card-body pt-5">
                                  <div class="row">
                                    <div class="col">
                                      <h5 class="card-title text-uppercase text-muted mb-0">Total Peternak</h5>
                                      <span class="h2 font-weight-bold mb-0">{{$jml_peternak}} Orang</span>
                                    </div>
                                    <div class="col-auto">
                                      <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                        <i class="ni ni-circle-08"></i>
                                      </div>
                                    </div>
                                  </div>
                                  <p class="mt-3 mb-0 text-sm">
                                    <span class="text-success mr-2"></span>
                                    <span class="text-nowrap"></span>
                                  </p>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                              <div class="col-xl-6 col-md-6">
                                  <div class="card card-stats">
                                    <!-- Card body -->
                                    <div class="card-body pt-5">
                                      <div class="row">
                                        <div class="col">
                                          <h5 class="card-title text-uppercase text-muted mb-0">Total Panen</h5>
                                          <span class="h2 font-weight-bold mb-0">{{$jml_panen}} Kg</span>
                                        </div>
                                        <div class="col-auto">
                                          <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                            <i class="ni ni-chart-bar-32"></i>
                                          </div>
                                        </div>
                                      </div>
                                      <p class="mt-3 mb-0 text-sm">
                                        <span class="text-success mr-2"></span>
                                        <span class="text-nowrap"></span>
                                      </p>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-xl-6 col-md-6">
                                  <div class="card card-stats">
                                    <!-- Card body -->
                                    <div class="card-body pt-5">
                                      <div class="row">
                                        <div class="col">
                                          <h5 class="card-title text-uppercase text-muted mb-0">Total Kandang</h5>
                                          <span class="h2 font-weight-bold mb-0">{{$jml_kandang}} Kandang</span>
                                        </div>
                                        <div class="col-auto">
                                          <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                            <i class="ni ni-basket"></i>
                                          </div>
                                        </div>
                                      </div>
                                      <p class="mt-3 mb-0 text-sm">
                                        <span class="text-success mr-2"></span>
                                        <span class="text-nowrap"></span>
                                      </p>
                                    </div>
                                  </div>
                                </div>     
                          </div>
                </div>
              </div>
            </div>
            </div>
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
                      {{$data->nama}}
                    </td>
                    <td>
                      {{$data->alamat}}
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

@section('javascript')
<script src="{{ asset('/js/highcharts.js')}}"></script>
<script>
  Highcharts.chart('chart', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Grafik Panen Kelompok'
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
        name: 'Panen ',
        data: {!!json_encode($nilai)!!},
        // data: [1,2],

    }]
});
</script>
@endsection
