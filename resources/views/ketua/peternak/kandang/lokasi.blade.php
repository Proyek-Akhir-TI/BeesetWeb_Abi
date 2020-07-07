@extends('layouts.masterketua')

@section('title')
  <title>Beeset - Explore Farmer</title>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.3.1/jszip-2.5.0/dt-1.10.21/af-2.3.5/b-1.6.2/b-colvis-1.6.2/b-flash-1.6.2/b-html5-1.6.2/b-print-1.6.2/cr-1.5.2/fc-3.3.1/fh-3.1.7/kt-2.5.2/r-2.2.5/rg-1.1.2/rr-1.2.7/sc-2.0.2/sp-1.1.1/sl-1.3.1/datatables.min.css">
@endsection

@section('ul')
<hr class="my-3">
          <!-- Heading -->
                <h6 class="navbar-heading p-0 text-muted">
                    <span class="docs-normal">Opsi Peternak</span>
                </h6>
          <ul class="navbar-nav mb-md-3">
            <li class="nav-item">
              <a class="nav-link" href="/ketua/explore/{{$users->id}}">
                <i class="ni ni-chart-bar-32 text-orange"></i>
                <span class="nav-link-text">Performa Peternak</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/ketua/explore/{{$users->id}}/lokasi" target="_blank">
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
            <div class="card-header"><h2>Peta Lokasi Kandang Milik {{$users->name}}</h2></div>
           <div id="mapyuk" style="width:100%; height:400px;"></div>
      </div>
    </div>
</div>
@endsection

@section('javascript') 

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC68gJT0BtgwM_Mc8jMmC7T4FuTQ6IhISc&callback=initialize" type="application/javascript"></script>
<!-- 
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

</script> -->

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
@endsection