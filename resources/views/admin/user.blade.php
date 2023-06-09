@extends('layout.master')

@section('main-content')



{{--  edit model entry start   --}}

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="user_data">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" id="update_user_btn" class="btn btn-primary">Update User</button>
          <img src="loader.gif" alt="" id="edit_loader">
        </div>
      </div>
    </div>
  </div>
{{--  edit model entry end   --}}





{{--  entry add   --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="user_from">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Select Role</label>
                       <select name="role" id="role" class="form-control">
                           <option value="0">User</option>
                           <option value="1">Admin</option>
                       </select>
                      </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="recipient-name"   class="col-form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name">
                      </div>
                </div>

                <div class="col-md-6">


            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Phone</label>
                <input type="number" class="form-control" id="number" name="number">
              </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">

            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username">
              </div>
                </div>

                <div class="col-md-6">

            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
              </div>
                </div>
            </div>


        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="add_user_btn" class="btn btn-primary">Add User</button>
        <img src="loader.gif" alt="" id="loader">
      </div>
    </div>
  </div>
</div>
{{--  entry add   --}}

<main role="main" class="main-content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-12">
            <div class="row">
                <div class="col-md-10">
                    <h2 class=" page-title">Data table</h2>
                </div>
                <div class="col-md-2">


          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Add User</button>

          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal" data-whatever="@mdo" id="edit_btn"></button>
                </div>
            </div>



          <div class="row my-4">
            <!-- Small table -->
            <div class="col-md-12">
              <div class="card shadow">
                <div class="card-body">
                  <!-- table -->
                  <table class="table datatables" id="dataTable-1">
                    <thead>
                      <tr>
                        <th class="text-center">Sr #</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Username</th>
                        <th class="text-center">phone</th>
                        <th class="text-center">Password</th>
                        <th class="text-center">Role</th>
                        <th colspan="2" class="text-center">Action</th>
                      </tr>
                    </thead>
                     <tbody>
                        @php
                        $sr=0;
                        @endphp
                        @foreach ($user as $data)
                        @php
                            $sr++;
                        @endphp


                      <tr class="text-center">
                        <td>{{$sr}}</td>
                        <td>{{$data->name}}</td>
                        <td>{{$data->email}}</td>
                        <td>{{$data->number}}</td>
                        <td>{{$data->password}}</td>
                        @if ($data->role ==1)
                            <td>Admin</td>
                            @else
                            <th>User</th>
                        @endif



                        <td>  <a class="btn btn-success" href="#" id="user_edit" data-ueid="{{$data->id}}">Edit</a></td>

                        <td>
                            <a class="btn btn-danger" href="#" id="user_remove" data-urid="{{$data->id}}">Remove</a>
                        </td>

                      </tr>
                      @endforeach


                    </tbody>
                  </table>
                </div>
              </div>
            </div> <!-- simple table -->
          </div> <!-- end section -->
        </div> <!-- .col-12 -->
      </div> <!-- .row -->
    </div> <!-- .container-fluid -->
    <div class="modal fade modal-notif modal-slide" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="defaultModalLabel">Notifications</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="list-group list-group-flush my-n3">
              <div class="list-group-item bg-transparent">
                <div class="row align-items-center">
                  <div class="col-auto">
                    <span class="fe fe-box fe-24"></span>
                  </div>
                  <div class="col">
                    <small><strong>Package has uploaded successfull</strong></small>
                    <div class="my-0 text-muted small">Package is zipped and uploaded</div>
                    <small class="badge badge-pill badge-light text-muted">1m ago</small>
                  </div>
                </div>
              </div>
              <div class="list-group-item bg-transparent">
                <div class="row align-items-center">
                  <div class="col-auto">
                    <span class="fe fe-download fe-24"></span>
                  </div>
                  <div class="col">
                    <small><strong>Widgets are updated successfull</strong></small>
                    <div class="my-0 text-muted small">Just create new layout Index, form, table</div>
                    <small class="badge badge-pill badge-light text-muted">2m ago</small>
                  </div>
                </div>
              </div>
              <div class="list-group-item bg-transparent">
                <div class="row align-items-center">
                  <div class="col-auto">
                    <span class="fe fe-inbox fe-24"></span>
                  </div>
                  <div class="col">
                    <small><strong>Notifications have been sent</strong></small>
                    <div class="my-0 text-muted small">Fusce dapibus, tellus ac cursus commodo</div>
                    <small class="badge badge-pill badge-light text-muted">30m ago</small>
                  </div>
                </div> <!-- / .row -->
              </div>
              <div class="list-group-item bg-transparent">
                <div class="row align-items-center">
                  <div class="col-auto">
                    <span class="fe fe-link fe-24"></span>
                  </div>
                  <div class="col">
                    <small><strong>Link was attached to menu</strong></small>
                    <div class="my-0 text-muted small">New layout has been attached to the menu</div>
                    <small class="badge badge-pill badge-light text-muted">1h ago</small>
                  </div>
                </div>
              </div> <!-- / .row -->
            </div> <!-- / .list-group -->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Clear All</button>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade modal-shortcut modal-slide" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="defaultModalLabel">Shortcuts</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body px-5">
            <div class="row align-items-center">
              <div class="col-6 text-center">
                <div class="squircle bg-success justify-content-center">
                  <i class="fe fe-cpu fe-32 align-self-center text-white"></i>
                </div>
                <p>Control area</p>
              </div>
              <div class="col-6 text-center">
                <div class="squircle bg-primary justify-content-center">
                  <i class="fe fe-activity fe-32 align-self-center text-white"></i>
                </div>
                <p>Activity</p>
              </div>
            </div>
            <div class="row align-items-center">
              <div class="col-6 text-center">
                <div class="squircle bg-primary justify-content-center">
                  <i class="fe fe-droplet fe-32 align-self-center text-white"></i>
                </div>
                <p>Droplet</p>
              </div>
              <div class="col-6 text-center">
                <div class="squircle bg-primary justify-content-center">
                  <i class="fe fe-upload-cloud fe-32 align-self-center text-white"></i>
                </div>
                <p>Upload</p>
              </div>
            </div>
            <div class="row align-items-center">
              <div class="col-6 text-center">
                <div class="squircle bg-primary justify-content-center">
                  <i class="fe fe-users fe-32 align-self-center text-white"></i>
                </div>
                <p>Users</p>
              </div>
              <div class="col-6 text-center">
                <div class="squircle bg-primary justify-content-center">
                  <i class="fe fe-settings fe-32 align-self-center text-white"></i>
                </div>
                <p>Settings</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main> <!-- main -->
</div> <!-- .wrapper -->

@endsection
