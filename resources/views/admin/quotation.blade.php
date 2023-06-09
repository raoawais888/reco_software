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




.bill_show_model_style.modal.fade .modal-dialog{
  margin: 0px !important;

}
.bill_show_model_style .modal-xl {
    max-width: 100%;
}
.modal-open .modal {
    overflow-x: hidden;
    padding-right: 0px !important;
    overflow-y: auto;
}
.bill_show_model_style.modal {
    position: fixed;
    top: 0;
    left: 0;
    z-index: 1050;
    display: none;
    width: 100%;
    height: 100%;
    overflow: hidden;
    outline: 0;
    z-index: 11111;
}
.bill_show_model_style .modal-header{
  border: none !important;
}

.bill_show_model_style .modal-content {
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
        z-index: 2222;
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
  .bill_show_model_style .modal-header .close {
    padding: 1rem 1rem;
    margin: -1rem -1rem -1rem auto;
    display: none;
}
body{
  color: #000;
}

}


</style>


@if(session()->get('update'))


<script>
  Swal.fire(
      'Bill Updated',
      '',
      'success'
    )
</script>

@endif


@if (session()->get('error'))
    <script>
         Swal.fire(
      'Please Select Product',
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

  <div class="modal fade bill_show_model_style" id="editModalShow" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body" id="bill_data_veiw">

        </div>




      </div>
    </div>
  </div>
  {{--  edit model entry end   --}}
  <button type="button" class="btn btn-primary d-none" data-toggle="modal" data-target="#editModalShow" data-whatever="@mdo" id="bill_show_btn">btn</button>



{{--  edit model entry start   --}}

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Quatation</h5>
          <button type="button" class="close close_edit" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method='POST'  id="edit_form">
          @csrf
        <div class="modal-body" id="bill_data">

        </div>


        </form>

        <div class="col-md-12 text-center mb-2">

          <button class="btn btn-primary btn-lg" id="add_more_btn_edit">Add More  Field</button>
      </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          {{-- <button type="button" id="update_entry_btn" class="btn btn-primary">Update Entry</button> --}}
          <img src="loader.gif" alt="" id="edit_loader">
        </div>
      </div>
    </div>
  </div>
{{--  edit model entry end   --}}






<main role="main" class="main-content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-12">
            <div class="row">
                <div class="col-md-10">
                    <h2 class=" page-title text-uppercase">Llist of Quations Data table</h2>
                </div>
                <div class="col-md-2">

{{--
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Add bill</button>
                     --}}

                </div>
            </div>



          <div class="row my-4">
            <!-- Small table -->
            <div class="col-md-12">
              <div class="card shadow">
                <div class="card-body">
                  <button type="button" class="btn btn-primary d-none" data-toggle="modal" data-target="#editModal" data-whatever="@mdo" id="bill_edit_btn">btn</button>
                  <!-- table -->
                  <table class="table datatables" id="dataTable-1">
                    <thead>
                      <tr>
                        <th class="text-center">Sr #</th>
                        <th class="text-center"> Date</th>
                        <th class="text-center"> client Name</th>
                        <th class="text-center">client number</th>
                        <th class="text-center">Quatation Number</th>
                        {{-- <th class="text-center">Change</th> --}}
                        <th class="text-center">View</th>
                        <th class="text-center">Edit</th>
                        <th class="text-center">Remove</th>
                      </tr>
                    </thead>
                     <tbody>
                        @php
                        $sr=0;
                        @endphp
                        @foreach ($bill->unique('bill_number') as $data)
                        @php
                            $sr++;
                        @endphp


                      <tr>
                        <td>{{$sr}}</td>
                        <td>{{$data->date}}</td>
                        <td>{{$data->client_name}}</td>
                        <td>{{$data->number}}</td>
                        <td>{{$data->bill_number}}</td>


                        {{-- <td> <a class="btn btn-success btn-sm text-white"  id="bill_change" data-bcid="{{$data->bill_number}}">Change</a></td>
                        --}}

                        <td> <a class="btn btn-success btn-sm text-white" href="{{url('invoice_bill',[$data->bill_number])}}" id="bill_view" data-bvid="{{$data->bill_number}}">View</a></td>
                        <td>
                          <a class="btn btn-primary btn-sm" href="#" id="bill_edit" data-beid="{{$data->bill_number}}">Edit</a></td>
                        <td>
                          <a class="btn btn-danger btn-sm" href="#" id="bill_remove" data-brid="{{$data->bill_number}}">Remove</a></td>

                      </tr>
                      @endforeach


                    </tbody>
                  </table>
                </div>
              </div>
            </div> <!-- simple table -->
          </div> <!-- end section -->
        </div> <!-- .col-12 -->
      </div> <!-- .row -->
    </div> <!-- .container-fluid -->

  </main> <!-- main -->
</div> <!-- .wrapper -->
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script>

$(document).ready(function(){
    $(document).on("click","#bill_view",function(e){
        e.preventDefault();
        let bill = $(this).attr("data-bvid");

        $.ajax({
            url:"invoice_quotation",
            data:{bill:bill},
            beforeSend:function(){
       $("#loader_stock").css("visibility","visible");
        },
        complete:function(){

        $("#loader_stock").css("visibility","hidden");

        },
            success:function(data){

                $("#bill_data_veiw").html(data);
              $("#bill_show_btn").trigger("click");

            }
        })

    })
})


    $(document).ready(function(){
        $('input:checkbox').click(function() {
            $('input:checkbox').not(this).prop('checked', false);
        });






    var loop_count =100;
   $("#add_more_btn_edit").on("click",function(e){
    //  alert("click");
    let product_clone = $("#product_data").html();

e.preventDefault();

loop_count++;
   var html_data ='<div class="row" id="attr_id'+loop_count+'"> ';




    html_data +='<div class="col-md-5"><div class="form-group">';
      html_data +='<label>Product Name</label>';
      html_data +='<select id="product_data" class="form-control js-example-basic-single" name="name[]">';


     html_data +=`${product_clone}`;

 html_data +='</select>';

  html_data+='</div></div>'


    html_data +='  <div class="col-md-3"> <div class="form-group">';
    html_data +='  <label>Packing</label>';
    html_data +=' <select name="unit[]" id="unit" class="form-control">';
    html_data +=' <option value="piece">Piece</option>';
    html_data +=' <option value="carton">carton</option>';
    html_data +='   <option value="dozen">Dozen</option>';
    html_data +='    </select>  ';
  html_data+='</div></div>'


  html_data+='<div class="col-md-2"><div class="form-group">';
    html_data +='  <label>Price</label>';
  html_data+='<input type="number" class="form-control" id="price" name="price[]" required>  ';
  html_data+='</div></div>';

  html_data+='<div class="col-md-2"><div class="form-group">';
    html_data +='  <label>QTY</label>';
  html_data+='<input type="number" class="form-control" id="qty" name="qty[]" required>';
  html_data+='</div></div>';





  html_data+='<div class="col-md-12"><div class="form-group text-center">';
  html_data+='<a class="btn btn-danger btn-sm text-white remove_btn admin-btn-main" id="'+loop_count+'" ><i class="mdi mdi-minus "></i>  Remove </a>';
  html_data+='<hr>';
  html_data+= '</div> </div>';




   html_data+='</div>';


   $("#box_edit").append(html_data);

   $('.js-example-basic-single').select2({
      tags: true
    });
   });

   $(document).on("click",".remove_btn",function(){

let id = $(this).attr("id");
  $("#attr_id"+id).remove();

  $('.js-example-basic-single').select2({
      tags: true
    });
});

    });





    // bill update form code start

    $(document).ready(function(){

        $("#edit_form").on("submit",function(e){
      e.preventDefault();
      $.ajax({

        url:"{{url("bill")}}",
        type:"POST",
        data:$("#edit_form").serialize(),
        beforeSend:function(){
       $("#loader_stock").css("visibility","visible");
},
complete:function(){

 $("#loader_stock").css("visibility","hidden");

},
        success:function(data){

          console.log(data);

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

              $(".close_edit").trigger("click");
              $("#bill_data_veiw").html(data);
              $("#bill_show_btn").trigger("click");

             }

             // product error end

        }

      })
    });

    })
    // bill update form code end




// product price add
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
