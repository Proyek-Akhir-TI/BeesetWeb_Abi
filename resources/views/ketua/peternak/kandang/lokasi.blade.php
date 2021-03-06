@extends('layouts.masterketua')

@section('title')
  <title>Beeset - Explore Farmer</title>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.3.1/jszip-2.5.0/dt-1.10.21/af-2.3.5/b-1.6.2/b-colvis-1.6.2/b-flash-1.6.2/b-html5-1.6.2/b-print-1.6.2/cr-1.5.2/fc-3.3.1/fh-3.1.7/kt-2.5.2/r-2.2.5/rg-1.1.2/rr-1.2.7/sc-2.0.2/sp-1.1.1/sl-1.3.1/datatables.min.css">
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
                    <span class="docs-normal">Opsi Peternak</span>
                </h6>
          <ul class="navbar-nav mb-md-3">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('ketua.explore',[$users->id]) }}">
                <i class="ni ni-chart-bar-32 text-orange"></i>
                <span class="nav-link-text">Performa Peternak</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="{{ route('ketua.explore.lokasi',[$users->id]) }}" target="_blank">
                <i class="ni ni-pin-3 text-orange"></i>
                <span class="nav-link-text">Lokasi Kandang</span>
              </a>
            </li>
          </ul>
@endsection

@section('content')
<div class="container-fluid mt-3">
    <div class="row ml-1 mt-4 mb-4">
        <h1>Peta Lokasi Kandang</h1>
    </div>
      <div class="card p-3 mb-5">
           <div id="mapyuk" style="width:100%; height:400px;"></div>
      </div>
    </div>
</div>
@endsection

@section('javascript') 

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC68gJT0BtgwM_Mc8jMmC7T4FuTQ6IhISc&callback=initialize" type="application/javascript"></script>

<!-- ============= Array ============= -->

        <script>
          var array =[];
        </script>

        @foreach ($maps as $map)

        <script type="text/javascript">
            //Memasukkan data tabel ke array
            array.push(['<?php echo $map->latitude?>','<?php echo $map->longitude?>','<?php echo $map->nama?>','<?php echo $map->peternak?>']);
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
                  
                  var position = new google.maps.LatLng(array[i][0],array[i][1]);
                  bounds.extend(position);
                  var marker = new google.maps.Marker({
                    position : position,
                    map : peta,
                    icon : 'https://img.icons8.com/plasticine/40/000000/marker.png',
                    
                  });
                    google.maps.event.addListener(marker, 'click', (function(marker, i) {
                      return function() {
                        var infoWindowContent = 
                        '<div class="content"><p>'+
                        '<h2>'+array[i][2]+'</h2>'+
                        'Pemilik : '+array[i][3]+'<br/>'+
                        'Titik Koordinat : '+array[i][0]+', '+array[i][1]+'<br/>'+
                        '</p></div>';
                        infoWindow.setContent(infoWindowContent);
                        infoWindow.open(peta, marker);
                      }
                    })(marker, i));
                  }
                
                }
                
              </script>
@endsection