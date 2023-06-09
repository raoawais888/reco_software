@extends('layout.master')
@section('main-content')

@if (session()->get('error'))
    <script>
         Swal.fire(
      'Please Select Product',
      '',
      'error'
    )
    </script>
@endif

<main role="main" class="main-content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-12">
          {{-- <h2 class="page-title">Add Entry</h2> --}}

          <div class="row">
            <div class="col-md-12">
              <div class="card shadow mb-4">
                <div class="card-header">
                  <strong class="card-title">Add Sale Entry</strong>
                </div>
                <div class="card-body">


                    <form method="POST" {{url('add_bill')}}>
                          @csrf
                        <div class="row">
                          <div class="col-md-12">
                              <div class="form-group">
                                  <label for="">Select Date</label>
                                  <input type="" class="form-control" id="date" name="date"  readonly>
                                </div>
                          </div>

                      </div>
                          <div class="row">
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Purchaser Name</label>
                                      <input type="text" class="form-control" id="client" name="client_name"  required>
                                    </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                     <label for="">Purchaser Number</label>
                                      <input type="number" class="form-control" id="number" name="number"required>
                                    </div>
                              </div>
                          </div>


                      <div id="box">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="">Select Brand</label>
                                  <select  id="branch" name="brand[]" class="form-control">
                                    @foreach ($brand as $data)
                                    <option value="{{$data->id}}">{{$data->brand}}</option>
                                    @endforeach


                                  </select>
                                </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="">Select Category</label>

                                <select  id="category" name="category[]" class="form-control">
                                    <option value="" disabled selected >Select Category</option>
                                  @foreach ($category as $data)
                                  <option value="{{$data->id}}">{{$data->category}}</option>
                                  @endforeach


                                </select>
                              </div>
                        </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Product  Name</label>

                                      <select name="name[]" id="product_data" class="form-control">

                                        <option value="">Select Product</option>
                                      </select>
                                    </div>
                              </div>

                              <div class="col-md-6">

                                <div class="form-group">
                                  <label>Packing</label>
                                  <select name="unit[]" id="unit" class="form-control">
                                      <option value="piece">Piece</option>
                                      <option value="carton">carton</option>
                                      <option value="dozen">Dozen</option>
                                  </select>
                                </div>
                              </div>
                          </div>



                          <div class="row">


                              <div class="col-md-6">


                          <div class="form-group">
                            <label for="">Price</label>
                              <input type="number" class="form-control" id="price" name="price[]" placeholder="price" required>
                            </div>
                              </div>

                              <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">QTY</label>
                                    <input type="number" class="form-control" id="qty" name="qty[]"  required>
                                  </div>
                            </div>


                          </div>









                              <div class="col-md-12 text-center mb-2">

                                  <button class="btn btn-primary btn-lg" id="add_more_btn">Add More  Field</button>
                              </div>
                          <hr>


                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group d-flex align-items-center">
                            <input type="checkbox" name="discount_type" value="percent"> <span class="mx-2"> percent %</span>
                            <input type="checkbox" name="discount_type" value="rupees" class="ml-2"> <span class="ml-1"> In Rupees</span>
                          </div>
                        </div>
                      </div>
                      <div class="row">

                        <div class="col-md-6">
                          <div class="form-group">

                              <input type="number" class="form-control" id="discount" name="discount" placeholder="Discount">
                            </div>
                      </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <select  id="branch" name="branch" class="form-control">
                                  @foreach ($branch as $data)
                                  <option value="{{$data->id}}">{{$data->name}}</option>
                                  @endforeach


                                </select>
                              </div>
                        </div>
                      </div>
                      <button type="submit" id="add_bill_btn" class="btn btn-primary">View</button>
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
        $('input:checkbox').click(function() {
            $('input:checkbox').not(this).prop('checked', false);
        });
    });

    $(document).ready(function(){


  //  add more function()
  var loop_count =1;
   $("#add_more_btn").on("click",function(e){

    let brand = '<?php  echo $brand ?>';
    let category = '<?php  echo $category ?>';
    e.preventDefault();
  
   loop_count++;
   var html_data ='<div class="row" id="attr_id'+loop_count+'"> ';
    html_data +='<div class="col-md-6"><div class="form-group">';
      html_data +='<label>Select Brand</label>';
    html_data +='<select class="form-control" name="brand[]">';

    $.each(JSON.parse(brand) , function( key, value ){
      html_data +='<option value="'+value.id +'">'+ value.brand +'</option>';

});
html_data +='</select>';
html_data+='</div></div>'

    html_data +='<div class="col-md-6"><div class="form-group">';
    html_data +='<label>Select Category</label>';
    html_data +='<select class="form-control" id="category" name="category[]">';

    $.each(JSON.parse(category) , function( key, value ){
      html_data +='<option value="'+value.id +'">'+ value.category +'</option>';

});
html_data +='</select>';
html_data+='</div></div>'


    html_data +='<div class="col-md-6"><div class="form-group">';
      html_data +='<label>Product Name</label>';
      html_data +='<select id="product_data" class="form-control" name="name[]">';


       html_data +='<option value="">Select Product</option>';

 html_data +='</select>';

  html_data+='</div></div>'


    html_data +='  <div class="col-md-6"> <div class="form-group">';
    html_data +='  <label>Packing</label>';
    html_data +=' <select name="unit[]" id="unit" class="form-control">';
    html_data +=' <option value="piece">Piece</option>';
    html_data +=' <option value="carton">carton</option>';
    html_data +='   <option value="dozen">Dozen</option>';
    html_data +='    </select>  ';
  html_data+='</div></div>'


  html_data+='<div class="col-md-6"><div class="form-group">';
    html_data +='  <label>Price</label>';
  html_data+='<input type="number" class="form-control" id="price" name="price[]" required>  ';
  html_data+='</div></div>';

  html_data+='<div class="col-md-6"><div class="form-group">';
    html_data +='  <label>QTY</label>';
  html_data+='<input type="number" class="form-control" id="qty" name="qty[]" required>';
  html_data+='</div></div>';





  html_data+='<div class="col-md-12"><div class="form-group text-center">';
  html_data+='<a class="btn btn-danger text-white remove_btn admin-btn-main" id="'+loop_count+'" ><i class="mdi mdi-minus "></i>  Remove </a>';
  html_data+='<hr>';
  html_data+= '</div> </div>';




   html_data+='</div>';


   $("#box").append(html_data);

   });

   $(document).on("click",".remove_btn",function(){

let id = $(this).attr("id");
  $("#attr_id"+id).remove();


});




    });





  $(document).ready(function(e){
     $(document).on("change","#category",function(e){
        let category = $(this).val();
        let element = $(this);
        let p_id = $(this).closest('.row').find('#product_data');




        $.ajax({
            url:"{{url('bill_category')}}",
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
