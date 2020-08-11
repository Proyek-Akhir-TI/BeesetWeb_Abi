@extends('layouts.masterketua')

@section('title')
  <title>Beeset - Explore Farmer</title>
@endsection

@section('ul')
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="{{route('ketua.index')}}">
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
<hr class="my-3">
          <!-- Heading -->
                <h6 class="navbar-heading p-0 text-muted">
                    <span class="docs-normal">Opsi {{$users->nama}}</span>
                </h6>
          <ul class="navbar-nav mb-md-3">
            <li class="nav-item">
              <a class="nav-link active" href="{{route('ketua.explore',[$users->id]) }}">
                <i class="ni ni-chart-bar-32 text-orange"></i>
                <span class="nav-link-text">Performa Peternak</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('ketua.explore.lokasi',[$users->id]) }}" target="_blank">
                <i class="ni ni-pin-3 text-orange"></i>
                <span class="nav-link-text">Lokasi Kandang</span>
              </a>
            </li>
          </ul>
@endsection

@section('content')
<div class="header bg-warning pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-4 col-7">
              <h1 class="text-white">Performa Peternak</h1>
            </div>            
          </div>
        </div>
      </div>
    </div>
<div class="container-fluid mt--5">
        <div class="row">
        <div class="col-xl-5 order-xl-1">
                  <div class="card card-profile">
                    <img src="{{ asset('img/theme/img-1-1000x600.jpg')}}" alt="Image placeholder" class="card-img-top">
                    <div class="row justify-content-center">
                      <div class="col-lg-3 order-lg-2">
                        <div class="card-profile-image">
                          <a href="#">
                            <img src="{{ asset('storage/uploads/'.$users->photo)}}" class="rounded-circle">
                          </a>
                        </div>
                      </div>
                    </div>
                    <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                      <div class="d-flex justify-content-between">
                        
                      </div>
                    </div>
                    <div class="card-body pt-3">
                          <div class="row">
                            <div class="col">
                              <div class="card-profile-stats d-flex justify-content-center">
                              @if($jml_kandangs > 0)
                                <div>
                                  <span class="heading">{{$jml_kandangs}}</span>
                                  <span class="description">Kandang</span>
                                </div>
                                <div>
                                  <span class="heading">{{$jml_panen}} Kg</span>
                                  <span class="description">Panen Madu</span>
                                </div>
                              @else
                              <div>
                                  <span class="heading">0</span>
                                  <span class="description">Kandang</span>
                                </div>
                                <div>
                                  <span class="heading">0</span>
                                  <span class="description">Panen Madu</span>
                                </div>
                              @endif
                              </div>
                            </div>
                          </div>
                      <div class="text-center">
                        <h2>{{$users->nama}}</h2>
                        <div class="h5 font-weight-300">
                          <i class="ni location_pin mr-2"></i>{{$users->email}}
                        </div>
                        <div class="h5">
                          <i class="ni business_briefcase-24 mr-2"></i>{{$users->kelompok->nama}}
                        </div>
                        <div class="h5">
                          <i class="ni business_briefcase-24 mr-2"></i>{{$users->alamat}} - {{$users->telpon}}
                        </div>
                        <div>
                          <i class="ni education_hat mr-2"></i>
                        </div>
                      </div>
                    </div>
                  </div> 
        </div>
        <div class="col-xl-7 order-xl-1 float-right">
        <div class="card">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Kandang</h3>
                </div>
                <div class="col text-right">
                  
                </div>
                
              </div>
            </div>
            <div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center table-flush table-hover">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Kandang</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                @php
                 $no = 1
                @endphp
                 @foreach($kandang as $kandangs)
                  <tr>
                    <td>
                       {{$no++}}
                    </td>
                    <td>
                        {{$kandangs->nama}}
                    </td>
                  <td>
                    <a href="{{route('ketua.explore.kandang',[$kandangs->id])}}" class="btn btn-sm btn-primary">Explore</a>
                  </td>
                  </tr>
                @endforeach
                </tbody>
              </table>
              <div class="float-right mb-3 mt-3">
              {{ $kandang->withQueryString()->links() }}
              </div>
            </div>
        </div>
      </div>
      </div>
      @if($jml_kandangs > 0)
      <div class="row">
        <div class="col-xl-12">
            <div class="card">
              <div class="row">
                  <div class="col-xl-5">
                        <form action="{{route('ketua.explore',[$users->id])}}" method="get">
                          <div class="row pt-4 pl-3">
                              <div class="col-xl-5">
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
                              <div class="col-xl-2">
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
      <div class="row">
          <div class="col-xl-12">
          <div class="card">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Tinjauan Panen</h3>
                </div>
            </div>
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
                 @foreach($detailpanens as $panen)
                  <tr>
                    <td>
                       {{$no++}}
                    </td>
                    <td>
                        {{$panen->nama}}
                    </td>
                    <td>
                        {{$panen->berat}} Kg
                    </td>
                    <td>
                      {{$panen->created_at->diffForHumans() }}
                    </td>
                  </tr>
                @endforeach
                </tbody>
              </table>
              <div class="float-right mb-3 mt-3"> 
                <a class="btn btn-sm btn-primary" href="{{route('ketua.tinjauan',[$users->id])}}">Lebih Detail .. </a>
              </div>
            </div>
          </div>
        </div>
     @else
     <div class="text-center mb-7 mt-7"><h2 class="font-italic">---Data Kandang Belum Tersedia---</h2></div>
     @endif
    </div>
</div>
@endsection

@section('javascript') 
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC68gJT0BtgwM_Mc8jMmC7T4FuTQ6IhISc&callback=initialize" type="application/javascript"></script>

<script type="application/javascript">
  google.maps.event.addDomListener(window, 'load', initialize);
        function initialize() {
          
            //Cek Support Geolocation
            if(navigator.geolocation){
            //Mengambil Fungsi golocation
            navigator.geolocation.getCurrentPosition(lokasi);
            }
            else{
            swal("Maaf Browser tidak Support HTML 5");
            }
            //Variabel Marker
            var marker;

            function taruhMarker(peta, posisiTitik){
                
                if( marker ){
                // pindahkan marker
                marker.setPosition(posisiTitik);
                } else {
                // buat marker baru
                marker = new google.maps.Marker({
                    position: posisiTitik,
                    map: peta,
                    icon : 'https://img.icons8.com/plasticine/40/000000/marker.png',
                });
                }
                
            }
            //Buat Peta
            var peta = new google.maps.Map(document.getElementById("map"), {
                    center: {lat: -8.408698, lng: 114.2339090},
                    zoom: 9
                });
            
            //Fungsi untuk geolocation
            function lokasi(position){

                //Mengirim data koordinat ke form input
                document.getElementById("lat").value = position.coords.latitude;
                document.getElementById("leng").value = position.coords.longitude;

                //Current Location
                var lat = position.coords.latitude;
                var long = position.coords.longitude;
                var latlong = new google.maps.LatLng(lat, long);
                
                //Current Marker 
                var currentMarker = new google.maps.Marker({
                        position: latlong, 
                        icon : 'https://img.icons8.com/plasticine/40/000000/user-location.png',
                        map: peta, 
                        title: "Anda Disini"
                    }); 
                //Membuat Marker Map dengan Klik
                var latLng = new google.maps.LatLng(-8.408698,114.2339090);
                
                var addMarkerClick = google.maps.event.addListener(peta,'click',function(event) {
                    
                    
                    taruhMarker(this, event.latLng);
                
                    //Kirim data ke form input dari klik
                    document.getElementById("lat").value = event.latLng.lat();
                    document.getElementById("leng").value = event.latLng.lng(); 
                    
                });
            }
            


      }

</script>


<script src="{{asset('/js/highcharts.js')}}"></script>
<script>
  Highcharts.setOptions({
                    colors: ['#fb6340']
                });
  Highcharts.chart('tryChart', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Grafik Jumlah Panen Tiap Kandang'
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