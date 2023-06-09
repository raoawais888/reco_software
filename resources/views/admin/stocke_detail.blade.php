@extends('layout.master')
@section('main-content')
    

<main role="main" class="main-content">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12">
        <div class="row">
          <div class="col-md-6 col-xl-6 mb-4">
            <a href="{{url('stocke_check')}}" style="text-decoration: none;">
            <div class="card shadow  text-white border-0">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col-3 text-center">
                    <span class="circle circle-sm bg-primary-light">
                      <i class="fe fe-16 fe-shopping-bag  mb-0"></i>
                    </span>
                  </div>
                  <div class="col pr-0">
                    <p class=" text-dark mb-0">Stock Inquery</p>
                    
                  </div>
                </div>
              </div>
            </div>
            </a>
          </div>

       
          <div class="col-md-6 col-xl-6 mb-4">
            <a href="" style="text-decoration: none;">
            <div class="card shadow border-0">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col-3 text-center">
                    <span class="circle circle-sm bg-primary">
                      <i class="fe fe-16 fe-shopping-cart text-white mb-0"></i>
                    </span>
                  </div>
                  <div class="col pr-0">
                    <p class="small text-dark mb-0">Out Of Stock</p>
                   
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
  
</main> <!-- main -->
</div> <!-- .wrapper -->
@endsection