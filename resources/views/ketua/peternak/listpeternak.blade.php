@extends('layouts.masterketua')

@section('title')
  <title>Beeset - Farmer List</title>
@endsection

@section('content')
    <div class="container-fluid mt-5">
      <div class="row">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Farmer List</h3>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center table-flush table-hover">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Email</th>
                    <th scope="col">Address</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                @php
                  $no = 1;
                @endphp
                @foreach($user as $peternak)
                  <tr>
                    <td>
                      {{$no++}}
                    </td>
                    <td>
                      {{$peternak->name}}
                    </td>
                    <td>
                      {{$peternak->email}}
                    </td>
                    <td>
                      {{$peternak->kelompok->name}}
                    </td>
                    <td>
                      {{$peternak->address}}
                    </td>
                    <td>
                    <a href="/ketua/explore/{{$peternak->id}}"  class="btn btn-sm btn-primary">Explore</a>
                    <a href="/ketua/edit/{{$peternak->id}}" class="btn btn-sm btn-success">Edit</a>
                    <a href="#!" class="btn btn-sm btn-danger">Delete</a>
                    </td>
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div>
            <div class="card-footer py-4">
              <nav aria-label="...">
                <ul class="pagination justify-content-end mb-0">
                  <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">
                      <i class="fas fa-angle-left"></i>
                      <span class="sr-only">Previous</span>
                    </a>
                  </li>
                  <li class="page-item">
                    <a class="page-link"></a>
                  </li>
                  <li class="page-item">
                    <a class="page-link" href="#">
                      <i class="fas fa-angle-right"></i>
                      <span class="sr-only">Next</span>
                    </a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div>
  </div>
@endsection