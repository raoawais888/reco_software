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
                  <strong class="card-title">Add Salary Role </strong>
                </div>
                <div class="card-body">
                  
                    <form class="form-inline py-3">
                        <input type="text" class="form-control"/>
                        <input type="text" class="form-control"/>
                        <button type="submit" class="btn btn-primary">Submit</button>
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