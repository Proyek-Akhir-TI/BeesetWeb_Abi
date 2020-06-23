@extends('layouts.mastercrud')

@section('title')
  <title>Beeset - Edit Kandang</title>
@endsection

@section('ul')
<ul class="navbar-nav mr-auto">
          <li class="nav-item">
          </li>
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