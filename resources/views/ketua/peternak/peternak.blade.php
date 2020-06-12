@extends('layouts.masterketua')

@section('title')
  <title>Beeset - Explore Farmer</title>
@endsection

@section('content')
<div class="container-fluid mt-3">
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
                        <a href="/ketua/edit/{{$users->id}}" class="btn btn-sm btn-success float-right"> Edit </a>
                      </div>
                    </div>
                    <div class="card-body pt-0">
                      <!-- <div class="row">
                        <div class="col">
                          <div class="card-profile-stats d-flex justify-content-center">
                            <div>
                              <span class="heading">22</span>
                              <span class="description">Friends</span>
                            </div>
                            <div>
                              <span class="heading">10</span>
                              <span class="description">Photos</span>
                            </div>
                            <div>
                              <span class="heading">89</span>
                              <span class="description">Comments</span>
                            </div>
                          </div>
                        </div> -->
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
        <div class="col-xl-8 order-xl-1 float-right">
        <div class="card">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Cages</h3>
                </div>
                <div class="col text-right">
                  <a href="" class="btn btn-sm btn-primary" data-target="#exampleModal" data-toggle="modal">See all</a>
                </div>
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Add Cage</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="/ketua/peternak/kandang/unggah" role="form">
                              <div class="row">
                                  <div class="col-xl-6">
                                      <div id="map" style="width:100%; height:320px;"></div> 
                                  </div>
                                  <div class="col-xl-6">
                                    <div class="form-group">
                                          <label for="exampleInputEmail1">Name</label>
                                          <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name">
                                          <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                        </div>
                                        <div class="form-group">
                                          <label for="exampleInputPassword1">User</label>
                                          <input type="text" name="user_id" class="form-control" id="exampleInputPassword1" value="{{$users->id}}">
                                        </div>
                                        <div class="form-group">
                                          <label for="exampleInputPassword1">Location</label>
                                          <input type="text" name="location" class="form-control" id="exampleInputPassword1" placeholder="Enter Location">
                                        </div>
                                        <div class="form-group">
                                          <label for="exampleInputPassword1">Latitude</label>
                                          <input type="number" name="latitude" class="form-control" id="lat" placeholder="Enter Location">
                                        </div>
                                        <div class="form-group">
                                          <label for="exampleInputPassword1">Longitude</label>
                                          <input type="number" name="longitude" class="form-control" id="leng" placeholder="Enter Location">
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
                        {{$kandangs -> name}}
                    </td>
                    <td>
                    <a href="/ketua/explore/kandang/{{$kandangs->id}}" class="btn btn-sm btn-primary">Explore</a>
                    <a href="" class="btn btn-sm btn-success">Edit</a>
                    <a href="#!" class="btn btn-sm btn-danger">Delete</a>
                    </td>
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div>
          </div>
      </div>
      </div>
</div>
@endsection

@section('javascript')
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDfC8SLDMQuvfSyZObH4BPW4o9zdvBEzKA&callback=initialize" type="text/javascript"></script>

<script>
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
            var marker2;
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
@endsection