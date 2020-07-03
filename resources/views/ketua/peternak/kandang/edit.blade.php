@extends('layouts.mastercrud')

@section('title')
  <title>Beeset - Edit Kandang</title>
@endsection

@section('ul')
<ul class="navbar-nav mr-auto">
          <li class="nav-item">
          </li>
        </ul>
  <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
            <li class="nav-item dropdown">
              <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="media align-items-center">
                  <div class="media-body  ml-2  d-none d-lg-block">
                    <span class="mb-0 text-sm  font-weight-bold">{{ Auth::user()->name }}</span>
                  </div>
                </div>
              </a>
              @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif 
              @else
              <div class="dropdown-menu  dropdown-menu-right ">
                <a href="{{ route('logout') }}" class="dropdown-item"  onclick="event.preventDefault();
                 document.getElementById('logout-form').submit();">
                  <i class="ni ni-user-run"></i>
                  <span>Logout</span> 
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="get" style="display: none;">
                      @csrf
                </form>
              </div>
            </li>
            @endguest
          </ul>
@endsection

@section('content')
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <!-- Table -->
      <div class="row justify-content-center">
        <div class="col-lg-10 col-md-8">
          <div class="card bg-secondary border-0">
            <div class="card-body px-lg-10 py-lg-10">
            <div class=" text-center mb-5">
                 <h1 class="text-warning">Edit Kandang</h1> 
            </div>
            <form method="post" action="/ketua/explore/kandang/update/{{$input->id}}" role="form">
                              {{ csrf_field() }}
                              <div class="row">
                                  <div class="col-xl-6">
                                      <div id="map" style="width:100%; height:320px;"></div> 
                                  </div>
                                  <div class="col-xl-6">
                                    <div class="form-group">
                                          <label for="exampleInputEmail1">Name</label>
                                          <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="{{$input->name}}" required="">
                                        </div>
                                        <div class="form-group">
                                          <input type="text" name="user_id" class="form-control" id="exampleInputPassword1" value="{{$input->user_id}}" hidden="">
                                        </div>
                                        <div class="form-group">
                                          <label for="exampleInputPassword1">Location</label>
                                          <input type="text" name="location" class="form-control" id="exampleInputPassword1" placeholder="{{$input->location}}" required="">
                                        </div>
                                        <div class="form-group">
                                          <label for="exampleInputPassword1">Latitude</label>
                                          <input type="text" name="latitude" class="form-control" id="lat" placeholder="{{$input->latitude}}" required="" >
                                        </div>
                                        <div class="form-group">
                                          <label for="exampleInputPassword1">Longitude</label>
                                          <input type="text" name="longitude" class="form-control" id="leng" placeholder="{{$input->longitude}}" required="">
                                        </div>
                                        <div class="form-group">
                                          <label for="exampleInputPassword1">Status</label>
                                          <input type="number" name="status" class="form-control" id="leng" value="1" readonly="" hidden required="">
                                          <input type="number" name="kelompok_id" class="form-control" value="{{ Auth::user()->kelompok_id }}" readonly="" hidden required="">
                                         <div class="form-group">
                                          <select class="form-control" name="status">
                                              <option value="1">Aktif</option>
                                              <option value="0">Tidak Aktif</option>
                                          </select>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="submit" class="btn btn-warning">Save changes</button>
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
@endsection