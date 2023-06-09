@extends('layout.master')
@section('main-content')

    <style>
    hr {
    margin-top: 1rem;
    margin-bottom: 1rem;
    border: 0;
    border-top: 2px solid #000;
}
.header{
    width: 100%;
      /* background-color: green; */
      /* paddin: auto; */
      text-align: center;
      text-transform: uppercase;
      border-bottom: 2px solid #000;
}

.total{
    font-size:13px;
}
.header img{
    width: 90%;
    height: 70px;
    margin-left: 5% !important;
}
.header h3{
    margin: 0;
    color:#000 !important;
}
.midlle{
    /* width: 100%; background-color: green; */
    margin-top: 10px;
    display: flex;
    justify-content: space-between;
}

.left{
    margin-left: 6% !important;
    width: 30%;
    /* background-color: red; */

}
b{
    margin: 0;
    padding: 0;
}
p{
    padding: 0 !important;
    margin: 5px 0px  !important;
}
.heading h3{
    margin-top:0px;
    margin-bottom:0px;
    font-size:16px;
    color:#000;
}
.right{

    /* background-color: rgb(228, 162, 138); */
    text-align: right;
    margin-right: 30px;
}
.heading,.text,.note{
    margin-left: 6%;
}
.text{
   margin-top: 10px;

}
.footer{
    margin-top: 70px;
    background-color: #aec1ec;
    width: 92%;
    margin-left: 5%;
    padding: 5px;
    color: #000000;
    /* position: fixed; */
    /* bottom: 0; */
}
.data{
    width: 92%;
    margin-left: 6%;

}
.data table{
    width: 100%;
}
.data table th{
    /* background-color: #3867d6; */
    color: #000000;
    padding:5px;
    border-bottom: 1px solid #000;
    font-size:16px;
    color:#000;
   text-align: center
}

.data table td{
    text-align: center;
    font-weight: bold;
    /* border-bottom: 1px solid #000; */

}


.dark{
    background-color: #87a6ee;
    /* color: #fff; */

}
.data table tr{
    border-bottom: 1px solid #000;
}
.data table tr .light{
    border-bottom: 1px solid #000;
    font-size:14px;
    color:#000;
}
.data table{
    border-collapse: unset;
    border-spacing: 0;
}
.header_head{
    display: flex;
   align-items: center;


}
.header_head .btn{

 background-color: #3867d6;
 text-decoration: none;
 padding: 10px;
 color: #fff;
 margin: 0px 10px;

 /* margin-left: 200px; */
 /* border-radius: 20px; */
}
.data table{
    border: 2px solid #000000;
}

.space{
    width: 25%;
}
.header_head h3{
    width: 50%;
    margin-top:12px;
}

.left b , .left p{
     font-size:16px;
    color:#000;
}
.right b , .right p{
      font-size:16px;
    color:#000;
}




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


    .select2-container .select2-selection--single {
    box-sizing: border-box;
    cursor: pointer;
    display: block;
    height: 34px;
    user-select: none;
    -webkit-user-select: none;
}

.select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #495057;
    line-height: 36px;
}
.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 35px;
    position: absolute;
    top: 1px;
    right: 1px;
    width: 20px;
}


.select2-container--default .select2-selection--single {
    background-color: #fff;
    border: 1px solid #dee2e6;
    border-radius: 4px;
}


    @media print {

  .header_head .btn {
    display: none;
  }
  #save_btn{
      display:none;
  }

  body{
      color:#000;
  }

  .header h3{
    margin: 0;
    color:#000 !important;
}

.header_head h3{
    margin-top:16px;
}

.left b , .left p{
       font-size:18px !important;
    color:#000;
}
.right b , .right p{
      font-size:18px !important;
    color:#000;
}
.data table tr .light{

     font-size:18px !important;
    color:#000;
}

.data table td {
    text-align: center;
    font-weight: bold;
    /* border-bottom: 1px solid #000; */
    color: #000;
    font-size: 18px !important;
}
.footer{
    font-size: 16px !important;
}

.left p {
    font-size: 18px;
    color: #000;
}


.footer {
    margin-top: 70px;
    background-color: #aec1ec;
    width: 92%;
    margin-left: 5%;
    padding: 5px;
    color: #000000;
    position: fixed;
    bottom: 0;
}

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


</style>

@if (session()->get('error'))
    <script>
         Swal.fire(
      'Select Atleast One product',
      '',
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
{{--  edit model entry end   --}}
<button type="button" class="btn btn-primary d-none" data-toggle="modal" data-target="#editModal" data-whatever="@mdo" id="bill_show_btn">btn</button>

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


                    <form method="POST"  id="bill_form">
                          @csrf
                        <div class="row">
                          <div class="col-md-4">
                              <div class="form-group">
                                  <label for="">Select Date</label>
                                  <input type="" class="form-control" id="date" name="date"  readonly>
                                </div>
                          </div>

                          <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Client Name</label>
                                <input type="text" class="form-control" id="client" name="client_name"  required>
                              </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group">
                             <label for="">Client Number</label>
                              <input type="number" class="form-control" id="number" name="number"required>
                            </div>
                      </div>

                      </div>


                      <div id="box">
                          <div class="row">
                              <div class="col-md-5">
                                  <div class="form-group">
                                      <label for="">Product  Name</label>


                                      <select name="name[]" id="product_data" class="form-control e9" data-placeholder="Select a Product" required>

                                        <option value="" disabled selected>Select Product</option>

                                            @foreach($product as $data)
                                  <option value="{{$data->id}}">{{$data->name}}</option>

                                            @endforeach

                                      </select>
                                    </div>
                              </div>

                              <div class="col-md-3">

                                <div class="form-group">
                                  <label>Packing</label>
                                  <select name="unit[]" id="unit" class="form-control" required>
                                      <option value="piece">Piece</option>
                                      <option value="carton">carton</option>
                                      <option value="dozen">Dozen</option>
                                  </select>
                                </div>
                              </div>



                              <div class="col-md-2">


                                <div class="form-group">
                                 <label for="">Price</label>
                                   <input type="text" class="form-control" id="price" name="price[]" placeholder="price"  value="">
                                 </div>
                              </div>


                              <div class="col-md-2">
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

                        <div class="col-md-3">
                          <div class="form-group">

                              <input type="number" class="form-control" id="discount" name="discount" placeholder="Discount">
                            </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                                   {{-- <label for="">Balance</label> --}}
                            <input type="number" class="form-control" id="balance" name="balance" placeholder="Balance">
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

             <!-- /.card-body -->
                </div>
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

    $(".e9").select2();

    $("#bill_form").validate({
      rules:{

        client_name:"required",



      }

    });


    $("#bill_form").on("submit",function(e){
      e.preventDefault();
      $.ajax({

        url:"{{url("add_bill")}}",
        type:"POST",
        data:$("#bill_form").serialize(),
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
               'Please Add Product Qty For this Branch',
                `${data.data}`,
                'error'
                 )

             }else if(data == "product_null"){
                   Swal.fire(
               'Select Atleast One product',
                '',
                'error'
                 )

             }else{

              $("#bill_form").trigger("reset");
              $("#bill_data").html(data);
              $("#bill_show_btn").trigger("click");

             }

             // product error end

        }

      })
    });

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
var html_data ='<div class="w-100" id="attr_id'+loop_count+'">';

html_data +='<div class="row">';
    html_data +='<div class="col-md-5"><div class="form-group">';
      html_data +='<label>Product Name</label>';
      html_data +='<select id="product_data"  class="form-control js-example-basic-single" name="name[]" required>';


       html_data +=`${product_clone}`;

 html_data +='</select>';

  html_data+='</div></div>'


    html_data +='  <div class="col-md-3"> <div class="form-group">';
    html_data +='  <label>Packing</label>';
    html_data +=' <select name="unit[]" id="unit" class="form-control" required>';
    html_data +=' <option value="piece">Piece</option>';
    html_data +=' <option value="carton">carton</option>';
    html_data +='   <option value="dozen">Dozen</option>';
    html_data +='</select>';
  html_data+='</div></div>'

  html_data+='<div class="col-md-2"><div class="form-group">';
    html_data +='  <label>Price</label>';
  html_data+='<input type="text" class="form-control" id="price" name="price[]" required value="">  ';
  html_data+='</div></div>';


  html_data+='<div class="col-md-2"><div class="form-group">';
    html_data +='  <label>QTY</label>';
  html_data+='<input type="number" class="form-control" id="qty" name="qty[]" required value="">';
  html_data+='</div></div>';

  html_data +='</div>';




  html_data+='<div class="col-md-12"><div class="form-group text-center">';
  html_data+='<a class="btn btn-danger btn-sm text-white remove_btn admin-btn-main" id="'+loop_count+'" ><i class="mdi mdi-minus "></i>  Remove </a>';
  html_data+='<hr>';
  html_data+= '</div> </div>';




   html_data+='</div>';
   html_data+='</div>';


   $("#box").append(html_data);



   $('.js-example-basic-single').select2();

   });

   $(document).on("click",".remove_btn",function(){

let id = $(this).attr("id");
  $("#attr_id"+id).remove();

  $('.js-example-basic-single').select2({});
});




    });





  $(document).ready(function(e){



     $(document).on("change", "#product_data", function(e){

        let id = $(this).val();
        let element = $(this);
        $.ajax({

           url:"{{url('bill_price')}}",
           data:{id:id},
           success:function(data){
              console.log(data);
            $(element).closest('.row').find('#price').val(data);

           }


        })

     })

  })

    </script>
@endsection
