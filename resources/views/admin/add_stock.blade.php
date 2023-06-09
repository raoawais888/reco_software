@extends('layout.master')
@section('main-content')


    <style>

.modal.fade .modal-dialog{
  margin: 0px !important;

}
.modal-xl {
    max-width: 100%;
}
.modal-open .modal {
    overflow-x: hidden;
    padding-right: 0px !important;
    overflow-y: auto;
}
.modal {
    position: fixed;
    top: 0;
    left: 0;
    z-index: 1050;
    display: none;
    width: 100%;
    height: 100%;
    overflow: hidden;
    outline: 0;
    z-index: 99999;
}
.modal-header{
  border: none !important;
}

.modal-content {
    position: relative;
    display: flex;
    flex-direction: column;
    width: 100%;
    pointer-events: auto;
    background-color: #ffffff;
    background-clip: padding-box;
    border: 1px solid rgba(0, 0, 0, 0.2);
    border-radius: 0.3rem;
    outline: 0;
    border-radius: 0px;
    border: 0px;
}




@media print {
  /* styling goes here */
  .main-content {
    display: none;
  }
  #save_btn{
      display:none;
  }
  .modal-header .close {
    padding: 1rem 1rem;
    margin: -1rem -1rem -1rem auto;
    display: none;
}
body{
  color: #000;
}
}
     #loader_stock{
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255,0.9);
        z-index: 9999;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 99999;
        visibility: hidden;
    }
</style>
@if (session()->get('error_product'))
    <script>
         Swal.fire(
      'Please Select Product',
      '',
      'error'
    )
    </script>
@endif
@if (session()->get('same'))
    <script>
         Swal.fire(
      'You Select same branches',
      ' Please select the diffrent branches for exchange the stock',
      'error'
    )
    </script>
@endif
@if (session()->get('entry'))
    <script>
         Swal.fire(
      '<?php echo  session('entry')  ?>',
      'No Entry Add for this product for this branch',
      'error'
    )
    </script>
@endif


@if (session()->get('stock'))
    <script>
         Swal.fire(
      '<?php echo  session('stock')  ?>',
      'No quantity Availabel in this amount',
      'error'
    )
    </script>
@endif

@if (session()->get('null'))
    <script>
         Swal.fire(
      'This Product Not available',
      '',
      'error'
    )
    </script>
@endif
<div id="loader_stock">
    <img src="{{asset('assets/images/loader.gif')}}" alt="">
  </div>


  <button type="button" class="btn btn-primary d-none" data-toggle="modal" data-target="#editModal" data-whatever="@mdo" id="bill_show_btn">btn</button>


  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body" id="bill_data">

        </div>




      </div>
    </div>
  </div>


<main role="main" class="main-content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-12">
          {{-- <h2 class="page-title">Add Entry</h2> --}}

{{-- product modal show start  --}}
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">All Products</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <table class="table  hover multiple-select-row nowrap" id="dataTable-1">
                <thead>
                  <tr class="bg-primary">
                    <th>Sr #</th>
                    <th>Product Name</th>
                    <th>Branch</th>
                    <th>Qty</th>

                  </tr>
                </thead>
                <tbody>
                    @php
                    $sr=0;
                    @endphp
                    @foreach ($entry as $data)
                    @php
                        $sr++;
                    @endphp


                  <tr>
                    <td>{{$sr}}</td>
                    <td>{{$data->product->name}}</td>
                    <td>{{$data->branch->name}}</td>
                    <td>{{$data->qty}}</td>



                  </tr>
                  @endforeach


                </tbody>
              </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>

{{-- product modal show  end--}}

          <div class="row">
            <div class="col-md-12">
              <div class="card shadow mb-4">
                <div class="card-header d-flex justify-content-between">
                  <strong class="card-title">Stock Transfer</strong>
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                   Show All Products
                  </button>
                </div>
                <div class="card-body">


                    <form method="POST" {{url('add_stock')}} id="stock_form">
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
                                      <label for="">From Branch</label>
                                      <select name="from" class="form-control" required>
                                      @foreach($branch as $data)
                                              <option value="{{$data->id}}">{{$data->name}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="">To Branch</label>
                                    <select name="to" class="form-control" required>
                                    @foreach($branch as $data)
                                            <option value="{{$data->id}}">{{$data->name}}</option>
                                    @endforeach
                                  </select>
                                    </div>
                              </div>
                          </div>


                      <div id="box">
                          <div class="row">
                            

                         
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label for="">Product  Name</label>


                                  <select name="name[]" id="product_data" class="form-control js-example-basic-single" required>

                                    <option value="" disabled selected>Select Product</option>

                                        @foreach($product as $data)


                                        <option value="{{$data->name}}">{{$data->name}}</option>

                                        @endforeach

                                  </select>
                                </div>
                              </div>

                              <div class="col-md-4">

                                <div class="form-group">
                                  <label>Packing</label>
                                  <select name="unit[]" id="unit" class="form-control" required>
                                      <option value="piece">Piece</option>
                                      <option value="carton">carton</option>
                                      <option value="dozen">Dozen</option>
                                  </select>
                                </div>
                              </div>

                              <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">QTY</label>
                                    <input type="number" class="form-control" id="qty" name="qty[]"  required>
                                  </div>
                            </div>
                          </div>



                          <div class="row">




                           


                           </div>









                              <div class="col-md-12 text-center mb-2">

                                  <button class="btn btn-primary btn-lg" id="add_more_btn">Add More  Field</button>
                              </div>
                          <hr>


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
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script>

   $(document).ready(function(){

     $("#stock_form").validate({

       rules:{


       }


     })


//    stock form ajax start
$("#stock_form").on("submit",function(e){
      e.preventDefault();
      $.ajax({

        url:"{{url("add_stock")}}",
        type:"POST",
        data:$("#stock_form").serialize(),
        beforeSend:function(){
       $("#loader_stock").css("visibility","visible");
},
complete:function(){

 $("#loader_stock").css("visibility","hidden");

},
        success:function(data){

          console.log(data);
          // product error

             if(data == "error_product"){


              Swal.fire(
               'Select Atleast One product',
                '',
                'error'
                 )
             }else if(data.stock == "stock"){
                Swal.fire(
                  `${data.data}`,
                  'No quantity Availabel in this amount',
                  'error'
                )
             }else if(data.entry == "entry"){
              Swal.fire(
               'Please Add Product Qty',
                `${data.data}`,
                'error'
                 )

             }else if (data == "same"){
                Swal.fire(
               'You Select Same Branch',
                '',
                'error'
                 )
             }else{

              $("#stock_form").trigger("reset");
              $("#bill_data").html(data);
              $("#bill_show_btn").trigger("click");

             }

             // product error end

        }

      })
    });

//    stock form ajax end



   })









    $(document).ready(function(){
        $('input:checkbox').click(function() {
            $('input:checkbox').not(this).prop('checked', false);
        });
    });

    $(document).ready(function(){


  //  add more function()
  var loop_count =1;
   $("#add_more_btn").on("click",function(e){

    

e.preventDefault();
let product_clone = $("#product_data").html();
loop_count++;
   var html_data ='<div class="row" id="attr_id'+loop_count+'"> ';
  
    html_data +='<div class="col-md-4"><div class="form-group">';
      html_data +='<label>Product Name</label>';
      html_data +='<select id="product_data"  class="form-control js-example-basic-single" name="name[]" required>';


       html_data +=`${product_clone}`;

 html_data +='</select>';

  html_data+='</div></div>'


    html_data +='  <div class="col-md-4"> <div class="form-group">';
    html_data +='  <label>Packing</label>';
    html_data +=' <select name="unit[]" id="unit" class="form-control">';
    html_data +=' <option value="piece">Piece</option>';
    html_data +=' <option value="carton">carton</option>';
    html_data +='   <option value="dozen">Dozen</option>';
    html_data +='    </select>  ';
  html_data+='</div></div>';



  html_data+='<div class="col-md-4"><div class="form-group">';
    html_data +='  <label>QTY</label>';
  html_data+='<input type="number" class="form-control" id="qty" name="qty[]" required>';
  html_data+='</div></div>';





  html_data+='<div class="col-md-12"><div class="form-group text-center">';
  html_data+='<a class="btn btn-danger text-white remove_btn admin-btn-main" id="'+loop_count+'" ><i class="mdi mdi-minus "></i>  Remove </a>';
  html_data+='<hr>';
  html_data+= '</div> </div>';




   html_data+='</div>';


   $("#box").append(html_data);

   $('.js-example-basic-single').select2();

   });

   $(document).on("click",".remove_btn",function(){

let id = $(this).attr("id");
  $("#attr_id"+id).remove();

  $('.js-example-basic-single').select2();


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
