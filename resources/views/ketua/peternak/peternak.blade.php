@extends('layouts.masterketua')

@section('title')
  <title>Beeset - Explore Farmer</title>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.3.1/jszip-2.5.0/dt-1.10.21/af-2.3.5/b-1.6.2/b-colvis-1.6.2/b-flash-1.6.2/b-html5-1.6.2/b-print-1.6.2/cr-1.5.2/fc-3.3.1/fh-3.1.7/kt-2.5.2/r-2.2.5/rg-1.1.2/rr-1.2.7/sc-2.0.2/sp-1.1.1/sl-1.3.1/datatables.min.css">
@endsection

@section('content')
<div class="container-fluid mt-3">
    <div class="row ml-1 mt-4 mb-4">
        <h1>Performa Peternak</h1>
    </div>
        <div class="row">
        <div class="col-xl-4 order-xl-1">
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
                        <a href="" class="btn btn-sm btn-danger  mr-4 ">Delete </a>
                      </div>
                    </div>
                    <div class="card-body pt-0">
                      <div class="row">
                        <div class="col">
                          <div class="card-profile-stats d-flex justify-content-center">

                            

                          </div>
                        </div>
                      </div>
                      <div class="text-center">
                        <h2>{{$users->name}}</h2>
                        <div class="h5 font-weight-300">
                          <i class="ni location_pin mr-2"></i>{{$users->email}}
                        </div>
                        <div class="h5">
                          <i class="ni business_briefcase-24 mr-2"></i>{{$users->kelompok->name}}
                        </div>
                        <div class="h5">
                          <i class="ni business_briefcase-24 mr-2"></i>{{$users->address}} - {{$users->telp}}
                        </div>
                        <div>
                          <i class="ni education_hat mr-2"></i>
                        </div>
                      </div>
                    </div>
                  </div> 
        </div>
        <div class="col-xl-8 order-xl-1 float-right">
        <div class="card">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Kandang</h3>
                </div>
                <div class="col text-right">
                  <a href="" class="btn btn-sm btn-primary" data-target="#exampleModal" data-toggle="modal">Tambah Kandang</a>
                </div>
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Tambah Kandang</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="/ketua/peternak/kandang/unggah" role="form">
                              {{ csrf_field() }}
                              <div class="row">
                                  <div class="col-xl-6">
                                      <div id="map" style="width:100%; height:320px;"></div> 
                                  </div>
                                  <div class="col-xl-6">
                                    <div class="form-group">
                                          <label for="exampleInputEmail1">Name</label>
                                          <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name">
                                        </div>
                                        <div class="form-group">
                                          <input type="text" name="user_id" class="form-control" id="exampleInputPassword1" value="{{$users->id}}" hidden="">
                                        </div>
                                        <div class="form-group">
                                          <label for="exampleInputPassword1">URL</label>
                                          <input type="text" name="tkUrl" class="form-control" id="exampleInputPassword1" placeholder="URL Thingspeak">
                                        </div>
                                        <div class="form-group">
                                          <label for="exampleInputPassword1">Location</label>
                                          <input type="text" name="location" class="form-control" id="exampleInputPassword1" placeholder="Enter Location">
                                        </div>
                                        <div class="form-group">
                                          <label for="exampleInputPassword1">Latitude</label>
                                          <input type="text" name="latitude" class="form-control" id="lat" placeholder="Enter Location">
                                        </div>
                                        <div class="form-group">
                                          <label for="exampleInputPassword1">Longitude</label>
                                          <input type="text" name="longitude" class="form-control" id="leng" placeholder="Enter Location">
                                        </div>
                                        <div class="form-group">
                                          <input type="number" name="status" class="form-control" value="1" readonly="" hidden>
                                        </div>
                                        <div class="form-group">
                                          <input type="number" name="kelompok_id" class="form-control" value="{{ Auth::user()->kelompok_id }}" readonly="" hidden>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                          <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                  </div>
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
                    <th scope="col">Kandang</th>
                    <th scope="col">Status</th>
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
                        {{$kandangs->name}}
                    </td>
                    <td>
                      @if($kandangs->status == 0)
                        <h4 class="badge badge-pill text-capitalize badge-danger">Kandang Tidak Aktif</h4>
                      @endif
                      @if($kandangs->status == 1)
                      <h4 class="badge badge-pill text-capitalize badge-success">Kandang Aktif</h4>
                      @endif
                    </td>
                    <td>
                  @if($kandangs->status == 1)
                    <a href="/ketua/explore/kandang/{{$kandangs->id}}" class="btn btn-sm btn-primary">Explore</a>
                    <a href="/ketua/explore/kandang/edit/{{$kandangs->id}}" class="btn btn-sm btn-success">Edit</a>
                    <a href="/ketua/explore/kandang/delete/{{$kandangs->id}}" class="btn btn-sm btn-danger">Delete</a>
                  @endif
                  @if($kandangs->status == 0)
                    <a href="/ketua/explore/kandang/edit/{{$kandangs->id}}" class="btn btn-sm btn-success">Edit</a>
                    <a href="/ketua/explore/kandang/delete/{{$kandangs->id}}" class="btn btn-sm btn-danger">Delete</a>
                  @endif
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
      <div class="row">
        <div class="col-xl-12">
            <div class="card">
              <div class="row">
                  <div class="col-xl-3">
                      <div class="form">
                        <form action="{{url('ketua/explore').'/'.$users->id}}" method="get">
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
                          <button type="submit" class="btn btn-primary">Pilih</button>
                          </form>
                      </div>
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
                                          <label for="exampleInputPassword1">User</label>
                                          <select class="form-control" name="kandang_id">
                                            @foreach ($kandang as $v)
                                              <option value="{{ $v->id }}">{{ $v->name }}</option>
                                            @endforeach
                                          </select>
                                        </div>
                                        <div class="form-group">
                                          <label for="exampleInputPassword1">Aktivitas</label>
                                          <select class="form-control" name="aktivitas_id">
                                            @foreach ($aktivitas as $id => $name)
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
                        {{$panen->name}}
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
              <div class="float-right">{{$detailpanens->withQueryString()->links()}}</div>
            </div>
          </div>
        </div>

      <div class="card p-3 mb-5">
            <div class="card-header"><h2>Peta Lokasi Kandang Milik {{$users->name}}</h2></div>
           <div id="mapyuk" style="width:100%; height:400px;"></div>
      </div>
     
    </div>
</div>
@endsection

@section('javascript') 
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/jszip-2.5.0/dt-1.10.21/af-2.3.5/b-1.6.2/b-colvis-1.6.2/b-flash-1.6.2/b-html5-1.6.2/b-print-1.6.2/cr-1.5.2/fc-3.3.1/fh-3.1.7/kt-2.5.2/r-2.2.5/rg-1.1.2/rr-1.2.7/sc-2.0.2/sp-1.1.1/sl-1.3.1/datatables.min.js"></script>


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
<!-- ============= Array ============= -->

    <script>
      var array =[];
    </script>

    @foreach ($maps as $map)

    <script type="text/javascript">
        //Memasukkan data tabel ke array
        array.push(['<?php echo $map->location?>','<?php echo $map->latitude?>','<?php echo $map->longitude?>','<?php echo $map->name?>','<?php echo $map->user->name?>']);
    </script> 

    @endforeach
  
<!-- ============= Array ============= -->

<script>
     
      function initialize() {
        var bounds = new google.maps.LatLngBounds();
        var peta = new google.maps.Map(document.getElementById("mapyuk"), {
          center : {lat: -8.408698, lng: 114.2339090},
          zoom : 9.5
        });
        var infoWindow = new google.maps.InfoWindow(), marker, i;
        for (var i = 0; i < array.length; i++) {
          
          var position = new google.maps.LatLng(array[i][1],array[i][2]);
          bounds.extend(position);
          var marker = new google.maps.Marker({
            position : position,
            map : peta,
            icon : 'https://img.icons8.com/plasticine/40/000000/marker.png',
            title : array[i][0]
          });
          google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
              var infoWindowContent = 
              '<div class="content"><p>'+
              '<h2>'+array[i][3]+'</h2>'+
              '<h4>'+array[i][0]+'</h4>'+
              'Pemilik : '+array[i][4]+'<br/>'+
              'Titik Koordinat : '+array[i][1]+', '+array[i][2]+'<br/>'+
              '</p></div>';
              infoWindow.setContent(infoWindowContent);
              infoWindow.open(peta, marker);
            }
          })(marker, i));
        }
       
      }
      
    </script>


<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
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