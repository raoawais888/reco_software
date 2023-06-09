@extends('layout.master')
@section('main-content')
    
 <main role="main" class="main-content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-12">
          {{-- <h2 class="page-title">Add Entry</h2> --}}
          @if(session()->get('success'))

          <script>
              Swal.fire(
      'purchase  Added',
      '',
      'success'
    )
          </script>
          @endif

          <div class="row">
            <div class="col-md-12">
              <div class="card shadow mb-4">
                <div class="card-header">
                  <strong class="card-title">Report Genrate </strong>
                </div>
                <div class="card-body">
                  
                    <form  method="POST">
                      @csrf
                      <div class="row d-flex align-items-center">
                        <div class="col-md-5">
                          <div class="form-group">
                            <label for="">Start Date</label>
                            <input type="date" class="form-control " name="start"/>
                          </div>
                       
                        </div>
                        <div class="col-md-5">
                          <div class="form-group">
                            <label for="">End Date</label>
                            <input type="date" class="form-control " name="end"/>
                          </div>
                        
                        </div>
                        <div class="col-md-2 text-center">
                          <button type="submit" class="btn btn-primary">Report Genrate</button>
                        </div>
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