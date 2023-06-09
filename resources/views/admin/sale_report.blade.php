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


            <div class="container-fluid">
                {{-- <h3 class="text-uppercase bg-dark text-white p-2 text-center">  Sales Report Genrate on one click to box </h3>  --}}
              <div class="row justify-content-center">

                <div class="col-12">
                  <div class="row">

                    <div class="col-md-6 col-xl-3 mb-4">
                        <a href="{{url('today')}}">
                      <div class="card shadow box  text-white border-0 bg-warning">
                        <div class="card-body">
                          <div class="row align-items-center">
                            <div class="col-3 text-center">
                              <span class="circle circle-sm bg-white">
                                <i class="fe fe-16 fe-calendar text-warning mb-0"></i>
                              </span>
                            </div>
                            <div class="col pr-0">
                              <p class="small text-white mb-0">Today Sales</p>

                            </div>
                          </div>
                        </div>
                      </div>
                    </a>
                    </div>

                    <div class="col-md-6 col-xl-3 mb-4">
                        <a href="{{url('week')}}">
                      <div class="card shadow box border-0 bg-info">
                        <div class="card-body">
                          <div class="row align-items-center">
                            <div class="col-3 text-center">
                              <span class="circle circle-sm bg-white">
                                <i class="fe fe-16 fe-calendar text-info mb-0"></i>
                              </span>
                            </div>
                            <div class="col pr-0">
                              <p class="small text-muted mb-0">Current Week sales</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </a>
                    </div>
                    <div class="col-md-6 col-xl-3 mb-4">
                        <a href="{{url('month')}}">
                      <div class="card box shadow border-0 bg-danger">
                        <div class="card-body">
                          <div class="row align-items-center">
                            <div class="col-3 text-center">
                              <span class="circle circle-sm bg-white">
                                <i class="fe fe-16 fe-calendar text-danger mb-0"></i>
                              </span>
                            </div>
                            <div class="col">
                              <p class="small text-muted mb-0">Current Month Sales</p>
                              <div class="row align-items-center no-gutters">
                                <div class="col-auto">

                                </div>

                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </a>
                    </div>
                    <div class="col-md-6 col-xl-3 mb-4">
                        <a href="{{url('year')}}">
                      <div class="card shadow box border-0 bg-success">
                        <div class="card-body">
                          <div class="row align-items-center">
                            <div class="col-3 text-center">
                              <span class="circle circle-sm bg-white">
                                <i class="fe fe-16 fe-calendar text-success mb-0"></i>
                              </span>
                            </div>
                            <div class="col">
                              <p class="small text-muted mb-0">Current Year Sales </p>

                            </div>
                          </div>
                        </div>
                      </div>
                    </a>
                    </div>


                    <div class="col-md-12 col-xl-12 mb-4">
                        <a href="{{url('sale_report_view')}}">
                      <div class="card shadow box border-0 bg-dark">
                        <div class="card-body">
                          <div class="row align-items-center">

                            <div class="col text-center">
                              <p class="text-muted mb-0 text-uppercase" style="font-size: 25px;">Reports Genrated By Invoice Number Please Click Here</p>

                            </div>
                          </div>
                        </div>
                      </div>
                    </a>
                    </div>
                  </div> <!-- end section -->
                              </div>
              </div> <!-- .row -->
            </div> <!-- .container-fluid -->


          {{-- data end boxes  --}}
          <div class="row">
            <div class="col-md-12">
              <div class="card shadow mb-4">
                <div class="card-header">
                  <strong class="card-title">Report Genrate  Munallly</strong>
                </div>
                <div class="card-body">

                    <form  method="POST">
                      @csrf
                      <div class="row d-flex align-items-center">
                        <div class="col-md-5">
                          <div class="form-group">
                            <label for="">Start Date</label>
                            <input type="date" class="form-control " name="start" required/>
                          </div>

                        </div>
                        <div class="col-md-5">
                          <div class="form-group">
                            <label for="">End Date</label>
                            <input type="date" class="form-control " name="end" required/>
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
