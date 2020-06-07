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
                  <h3 class="mb-0">Cage</h3>
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
                  <tr>
                    <td>
                      1
                    </td>
                    <td>
                      Kandang 1
                    </td>
                    <td>
                    <a href=""  class="btn btn-sm btn-primary">Explore</a>
                    <a href="" class="btn btn-sm btn-success">Edit</a>
                    <a href="#!" class="btn btn-sm btn-danger">Delete</a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
      </div>
      </div>
</div>
@endsection