@extends('layout.master')
@section('main-content')
    
<main role="main" class="main-content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-12">
          {{-- <h2 class="page-title">Add Entry</h2> --}}
          
          <div class="row">
            <div class="col-md-12">
              <div class="card shadow mb-4">
                <div class="card-header">
                  <strong class="card-title">Add Branch</strong>
                </div>
                <div class="card-body">
                  
                    <form id="branch_from">
                        @csrf 
                        <div class="row">
                          <div class="col-md-12">
                              <div class="form-group">
                                  
                                  <input type="text" class="form-control" id="name" name="name" placeholder="Branch Name" value="" required>
                                </div>
                          </div>
                          <div class="col-md-12">
                              <div class="form-group">
                                  
                                  <textarea name="address" id="address" cols="30" rows="10" class="form-control"></textarea>
                                </div>
                          </div>
                      </div>
                          
                          
              
                     
                        
                        
              
                          
                          <button type="submit" id="add_branch_btn" class="btn btn-primary">Add Branch </button>
        <img src="loader.gif" alt="" id="loader">
              
                      </div>
                      
                      </form>
               

                </div> <!-- /.card-body -->
              </div> <!-- /.card -->
            </div> <!-- /.col -->
       </div> <!-- end section -->
        </div> <!-- /.col-12 col-lg-10 col-xl-10 -->
      </div> <!-- .row -->
    </div> <!-- .container-fluid -->
    
  </main> <!-- main -->
@endsection