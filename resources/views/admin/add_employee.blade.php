@extends('layout.master')
@section('main-content')
    
<main role="main" class="main-content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-12">
          {{-- <h2 class="page-title">Add Entry</h2> --}}
          
          @if (session()->get('success'))
           <script>
                 Swal.fire(
      'Employee Added',
      '',
      'success'
    )
               </script>    

@elseif(session()->get('error'))
<script>Swal.fire(
      'Invalid Code',
      '',
      'error'
    )
               </script> 
          @endif
          <div class="row">
            <div class="col-md-12">
              <div class="card shadow mb-4">
                <div class="card-header">
                  <strong class="card-title">Add Employee</strong>
                </div>
                <div class="card-body">
                  
                    <form  method="POST" action="{{url('add_employee')}}">
                        @csrf 
                        <div class="row">
                          <div class="col-md-12">
                              <div class="form-group">
                                  <label for="">Name</label>
                                  <input type="text" class="form-control" id="name" name="name" value="" required>
                                </div>
                          </div>
                          <div class="col-md-12">
                              <div class="form-group">
                                  <label for="">Number</label>
                                  <input type="text" class="form-control" id="number" name="number" value="" required>
                                </div>
                          </div>
                          <div class="col-md-12">
                              <div class="form-group">
                                  <label for="">CNIC NUMBER</label>
                                  <input type="text" class="form-control" id="cnic" name="cnic"  value="" required>
                                </div>
                          </div>
                          <div class="col-md-12">
                              <div class="form-group">
                                  <label for="">Employee Code</label>
                                  <input type="text" class="form-control" id="code" name="code"  value="" required>
                                </div>
                          </div>
                          <div class="col-md-12">
                              <div class="form-group">
                                  <label for="">Select  Branch</label>
                                  <select name="branch" id="branch" class="form-control" required>
                                      @foreach ($branch as $data)
                                          
                                      <option value="{{$data->id}}">{{$data->name}}</option>
                                      @endforeach
                                  </select>
                                </div>
                          </div>
                          <div class="col-md-12">
                              <div class="form-group">
                                  <label for="Invoice No">Salary</label>
                                  <input type="text" class="form-control" id="salary" name="salary" value="" required>
                                </div>
                          </div>

                      </div>
                          
                          
              
                     
                        
                        
              
                          
                          <button type="submit"  class="btn btn-primary">Add Employee </button>
        
              
                      </div>
                      
                      </form>
               

                </div> <!-- /.card-body -->
              </div> <!-- /.card -->
            </div> <!-- /.col -->
       </div> <!-- end section -->
        </div> <!-- /.col-12 col-lg-10 col-xl-10 -->
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
@endsection