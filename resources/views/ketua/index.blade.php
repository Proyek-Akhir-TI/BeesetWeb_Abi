@extends('layouts.masterketua')

@section('title')
  <title>Beeset - Beranda</title>
@endsection

@section('ul')

          <!-- Nav items -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" href="{{route('ketua.index')}}">
                <i class="ni ni-tv-2  text-orange"></i>
                <span class="nav-link-text">Beranda</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('ketua.konfirmasipeternak')}}">
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
    <div class="row">
        <div class="col-xl-5">
            <div class="card card-profile pt-4">
                        <div class="d-flex justify-content-between">
                          
                          <a href="{{route('ketua.edit',[Auth::user()->id])}}" class="btn btn-sm btn-warning">Edit Profil</a>
                        </div>
                        <img src="{{ asset('img/theme/theme.jpg')}}" alt="Image placeholder" class="card-img-top" style="max-height:80px;">
                        <div class="row justify-content-center">
                          <div class="col-lg-3 order-lg-2">
                            <div class="card-profile-image">
                              <a href="#">
                                <img src="{{ asset('storage/uploads/'.$ketua->photo)}}" class="rounded-circle">
                              </a>
                            </div>
                          </div>
                        </div>
                        <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                        
                      </div>
                        <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                          <div class="d-flex justify-content-between">

                          </div>
                        </div>
                        <div class="card-body pt-2">   
                          <div class="text-center">
                            <h2>{{$ketua->nama}}</h2>
                            <div class="h5 font-weight-300">
                              <i class="ni location_pin mr-2"></i>{{$ketua->email}}
                            </div>
                            <div class="h5">
                              <i class="ni business_briefcase-24 mr-2"></i>{{$ketua->kelompok->nama}}
                            </div>
                            <div class="h5">
                              <i class="ni business_briefcase-24 mr-2"></i>{{$ketua->alamat}} - {{$ketua->telpon}}
                            </div>
                            <div>
                              <i class="ni education_hat mr-2"></i>
                            </div>
                          </div>
                        </div>
                      </div> 
            </div>
            <div class="col-xl-7 col-md-6">
              <div class="row">
                <div class="col-xl-6 col-md-6">
                  <div class="card card-stats pb-5">
                    <!-- Card body -->
                    <div class="card-body">
                      <div class="row">
                        <div class="col">
                          <h5 class="card-title text-uppercase text-muted mb-0">Total Anggota</h5>
                          <span class="h2 font-weight-bold mb-0">{{$anggota}} Peternak</span>
                        </div>
                        <div class="col-auto">
                          <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                            <i class="ni ni-circle-08"></i>
                          </div>
                        </div>
                      </div>
                    
                    </div>
                  </div>
                </div>
                <div class="col-xl-6 col-md-6">
                  <div class="card card-stats pb-5">
                    <!-- Card body -->
                    <div class="card-body">
                      <div class="row">
                        <div class="col">
                          <h5 class="card-title text-uppercase text-muted mb-0">Anggota Aktif</h5>
                          <span class="h2 font-weight-bold mb-0">{{$anggota_aktif}} Peternak</span>
                        </div>
                        <div class="col-auto">
                          <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                            <i class="ni ni-chart-pie-35"></i>
                          </div>
                        </div>
                      </div>
                      
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xl-6 col-md-6">
                  <div class="card card-stats pb-5">
                    <!-- Card body -->
                    <div class="card-body">
                      <div class="row">
                        <div class="col">
                          <h5 class="card-title text-uppercase text-muted mb-0">Kandang Lebah</h5>
                          <span class="h2 font-weight-bold mb-0">{{$kandang}} Kandang</span>
                        </div>
                        <div class="col-auto">
                          <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                            <i class="ni ni-money-coins"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xl-6 col-md-6">
                  <div class="card card-stats pb-5">
                    <!-- Card body -->
                    <div class="card-body">
                      <div class="row">
                        <div class="col">
                          <h5 class="card-title text-uppercase text-muted mb-0">Hasil Panen</h5>
                          <span class="h2 font-weight-bold mb-0">{{$hasil}} Kg</span>
                        </div>
                        <div class="col-auto">
                          <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                            <i class="ni ni-chart-bar-32"></i>
                          </div>
                        </div>
                      </div>
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
    </div>
          <div class="row">
            <div class="col-xl-12">
            <div class="row">
                <div class="col-xl-6">
                    <div class="card">
                      <div class="row">
                          <div class="col-xl-5">
                                <form action="{{route('ketua.index')}}" method="get">
                                  <div class="row pt-4 pl-3">
                                      <div class="col-xl-10">
                                        <div class="form-group">
                                              <div class="input-group input-group-merge input-group-alternative mb-3">
                                                    <div class="input-group-prepend">
                                                      <span class="input-group-text bg-light text-darker">Tahun</span>
                                                    </div>
                                                    <select class="form-control text-darker pl-2" name="tahun">
                                                      @foreach ($tanggal as $val)
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
                        <div id="Chart_1"></div>
                    </div>    
                </div>
                <div class="col-xl-6">
                    <div class="card pt-7">
                          <div id="Chart_2"></div>
                    </div>
                    
                </div>
              </div>
            </div>
            </div>
        </div>
    </div>
    <div class="row">
          <div class="col-xl-6">
              <div class="card">
                  <div id="Chart_1"></div>
              </div>
          </div>
    </div>
    </div>
  
@endsection

@section('javascript')
<script src="{{ asset('/js/highcharts.js')}}"></script>
<script>
  Highcharts.setOptions({
                    colors: ['#fb6340']
                });
  Highcharts.chart('Chart_1', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Grafik Panen Anggota'
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
<script>
  Highcharts.setOptions({
                    colors: ['#fb6340']
                });
  Highcharts.chart('Chart_2', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Grafik Panen Per Tahun'
    },
    xAxis: {
        categories: {!!json_encode($categories2)!!},
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
        name: 'Panen',
        data: {!!json_encode($data2)!!},
        // data: [1,2],

    }]
});
</script>
@endsection