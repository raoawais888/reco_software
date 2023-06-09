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
                  <strong class="card-title">Add Product Entry</strong>
                </div>
                <div class="card-body">


                    <form id="entry_from">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Today Date</label>
                                    <input type="text" readonly class="form-control date_select" id="date" name="date" value="">


                                  </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Select Brand Name</label>
                                  <select name="brand" id="brand" class="form-control">
                                    @foreach ($brand as $data)

                                    <option value="{{$data->id}}">{{$data->brand}}</option>
                                    @endforeach
                                  </select>
                                  </div>
                            </div>
                        </div>
                        <div class="row">


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Category</label>

                                    <select name="category" id="category" class="form-control">
                                        <option value="" disabled selected>Select Category</option>
                                       @foreach ($category as $data)

                                       <option value="{{$data->id}}">{{$data->category}}</option>
                                       @endforeach

                                    </select>


                                  </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Product Name</label>
                                    <div id="product_data" >
                                        <select name="" id="" class="form-control">
                                            <option value="">Select Product</option>
                                        </select>
                                    </div>

                                  </div>
                            </div>
                        </div>



                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Packing</label>
                                <select name="unit" id="unit" class="form-control">
                                    <option value="piece">Piece</option>
                                    <option value="carton">carton</option>
                                    <option value="dozen">Dozen</option>
                                </select>
                              </div>
                        </div>

                          <div class="col-md-6">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Qty</label>
                                <input type="text" class="form-control" name="qty" id="qty">
                              </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Branch</label>
                                <select name="branch_id" id="" class="form-control">
                                    <option value="" disabled selected>select Branch</option>
                                    @foreach ($branch as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                  </select>
                              </div>
                        </div>

                        </div>





                        <button type="button" id="add_entry_btn" class="btn btn-primary">Add Entry</button>
                        <img src="loader.gif" alt="" id="loader">

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

    $("#entry_from").validate({
      rules:{

        client_name:"required",



      }

    });
       });
    
       $(document).ready(function(e){
     $(document).on("change","#category",function(e){
        let category = $(this).val();
        let element = $(this);
        let p_id = $(this).closest('.row').find('#product_data');




        $.ajax({
            url:"{{url('entry_category')}}",
            type:"get",
            data:{category:category},
            success:function(data){
               $(element).closest('.row').find('#product_data').html(data);

            }


        })

     })

  })
    </script>
@endsection

