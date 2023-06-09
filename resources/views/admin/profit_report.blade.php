@extends('layout.master')
@section('main-content')

<style>
    a:hover{
        text-decoration: none !important;


    }
    .box  p{
        font-weight: bold !important;
        color: #fff !important;
        /* font-size: 30px; */
    }
    .box:hover {
        background: grey !important;
        color: #fff !important;
        font-weight: bold !important;
    }
</style>

{{-- @dd($branch); --}}
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



          {{-- data start boxes  --}}

          <form action="{{url('report_genrate_profit')}}" method="POST" id="report_form">
            @csrf
            <div class="container-fluid">
                {{-- <h3 class="text-uppercase bg-dark text-white p-2 text-center">  Sales Report Genrate   By Invoice</h3>  --}}
              <div class="row mb-3 align-items-center" style="background: #fff">

                     <div class="col-md-12">
                    <h4 class="text-center mb-4" style="border-bottom: 2px solid #000">Profit Reported Genrated Salary expense purcase added </h4>
                </div>



                        <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Report Selected</label>
                            <select name="type" id="" class="form-control" required>
                                <option  disabled selected>Select Report Type</option>
                                <option value="month">Month</option>
                                <option value="year">Year</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Select Branch</label>
                            <select name="branch" id="" class="form-control" required>
                                <option  disabled selected>Select Branch</option>
                            @foreach ($branch as $data)

                            <option value="{{$data->id}}">{{$data->name}}</option>

                            @endforeach
                        </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary w-100 mt-4">Report Genrated</button>
                        </div>
                    </div>





              </div>
              <!-- .row -->
            </div> <!-- .container-fluid -->
        </form>

          {{-- data end boxes  --}}
          <div class="row">
            <div class="col-md-12">
              <div class="card shadow mb-4">
                <div class="card-header">
                  <h4 class="text-center" style="border-bottom:2px solid #000 ">Report Genrate  Munallly</h4>
                </div>
                <div class="card-body">

                    <form  method="POST" id="man_form">
                      @csrf
                      <div class="row d-flex align-items-center">
                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="">Start Date</label>
                            <input type="date" class="form-control " name="start" required/>
                          </div>

                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="">End Date</label>
                            <input type="date" class="form-control " name="end" required/>
                          </div>

                        </div>

                        <div class="col-md-3">
                              <div class="form-group">
                                <label for="">Select Branch</label>
                               <select name="branch" id="" class="form-control">
                                <option value="" selected disabled> Select Branch</option>
                                @foreach ($branch as $data)

                                <option value="{{$data->id}}">{{$data->name}}</option>

                                @endforeach
                               </select>
                              </div>
                        </div>
                        <div class="col-md-3 text-center">
                          <button type="submit" class="btn btn-primary w-100 mt-2">Report Genrate</button>
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


  <script src="{{asset('js/jquery.min.js')}}"></script>
  <script>
    $(document).ready(function(){

        $("#report_form").validate({
      rules:{

        branch:"required",




      }

    });

        $("#man_form").validate({
      rules:{

        type:"required",



      }

    });

   })


  </script>
@endsection
