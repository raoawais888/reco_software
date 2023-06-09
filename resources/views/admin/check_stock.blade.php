@extends('layout.master')

@section('main-content')

<style>
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
        visibility: hidden;
    }
</style>


<style>
    @media print{


          #employee_edit , #employe_remove  , #print ,#dataTable-1_info , #dataTable-1_paginate ,#dataTable-1_length ,#dataTable-1_filter ,
          #delete_th , #edit_th , .print_none{
            display: none;
          }

    }
</style>

<button type="button" class="btn btn-primary d-none" data-toggle="modal" data-target="#editModal" data-whatever="@mdo" id="bill_show_btn">btn</button>
{{--  edit model entry start   --}}

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Stock</h5>
          <button type="button" class="close update_stock_data" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="entry_data">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" id="update_stock" class="btn btn-primary">Update Stock</button>
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
                    <h2 class=" page-title text-uppercase">List Of Stock Data - <span id="branch_name">All Stock</span> </h2>
                </div>
                <div class="col-md-2">



          <button type="button" class="btn btn-primary d-none" data-toggle="modal" data-target="#editModal" data-whatever="@mdo" id="edit_btn_entry"></button>
                </div>
            </div>


        <div class="row my-y print_none">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-body">
                <form action="">
                    <div class="form-group">
                      <h4>Select Branch  To Show Branch Wise Stock</h4>
                        <select name="" id="stock_branch" class="form-control">

                            <option value="all_stock">ALL STOCK</option>

                            @foreach ($branch as  $data)

                            <option value="{{$data->id}}">{{$data->name}}</option>

                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
        </div>
            </div>
            </div>


            <div id="loader_stock">
                <img src="{{asset('assets/images/loader.gif')}}" alt="">
            </div>


            <div class="row my-3 print_none">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-body">

                 <button class="btn btn-danger" id="out">Out Of Stock Products</button>
                 <button class="btn btn-danger" id="less">Less Then 10 stock products</button>
                 <button class="btn btn-danger" id="all">All Stock </button>


                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 text-right">
                    <button id="print" class="btn btn-primary">Print</button>
                </div>
            </div>
          <div class="row my-4">
            <!-- Small table -->
            <div class="col-md-12">

              <div class="card shadow" id="stock_table">
                <div class="card-body">

                  <!-- table -->
                  <table class="table datatables" id="dataTable-1">
                    <thead>
                      <tr class="bg-primary text-white">
                        <th>Sr #</th>
                        <th>Name</th>
                        <th>Packing</th>
                        <th>QTY</th>
                        <th>Branch</th>
                        <th>Edit Stock</th>
                        <th>Delete Stock</th>
                      </tr>
                    </thead>
                    <tbody>

                        @php
                            $sr = 0;
                        @endphp
                        @foreach ($entry as $data )

                        @php
                            $sr++;
                        @endphp

                             <tr>
                                <td>{{$sr}}</td>
                                <td>{{$data->product->name}}</td>
                                <td>{{$data->unit}}</td>
                                <td id="qty_val">{{$data->qty}}</td>
                                <td>{{$data->branch->name}}</td>
                                <td><a data-id="{{$data->id}}"  id="stock_edit" class="text-white btn btn-primary btn-sm {{$data->id}}">Edit</a></td>
                                <td><a data-did="{{$data->id}}" data-bid = "{{$data->branch_id}}"  id="stock_delete" class="text-white btn btn-danger btn-sm {{$data->id}}">Delete</a></td>
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


<script>
$(document).ready(function(){


    // sdit Delete for balance
    $(document).on("click", "#stock_delete", function(e){
    
    let id = $(this).attr("data-did");
    let bid = $(this).attr("data-bid");

                Swal.fire({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              if (result.isConfirmed) {
                $.ajax({

                url: "{{url('edit_stock_delete')}}",
                type:"get",
                data:{id , bid},
                success:function(data){
                  $("#dataTable-1").find(`.${id}`).closest("tr").fadeOut(500);
                  Swal.fire(
                      'Deleted!',
                      'Your file has been deleted.',
                      'success'
                    )

                }
                })
              }
            })
   
      
        })



         
    // sdit stock for balance

    $(document).on("click", "#stock_edit", function(e){

      

        let id = $(this).attr("data-id");
        $.ajax({

            url: "{{url('edit_stock_manage')}}",
            type:"get",
            data:{id:id},
            success:function(data){

            $("#entry_data").html(data);
            $("#bill_show_btn").trigger("click");

            }
        })


        // update stock start
        $("#update_stock").on("click", function(e){
          let qty = $("#qty").val();
          let id = $("#stock_id").val();
          $.ajax({

            url: "{{url('update_stock_manage')}}",
            type:"get",
            data:{qty:qty, id:id},
            beforeSend:function(){
            $("#loader_stock").css("visibility","visible");
            },
            complete:function(){

            $("#loader_stock").css("visibility","hidden");

            },
            success:function(data){
                $("#dataTable-1").find(`.${id}`).closest("tr").css("background","#F8F4EA");
                $("#dataTable-1").find(`.${id}`).closest("tr").find("#qty_val").html(qty);
                if(data == 1){
                $(".update_stock_data").trigger('click');
                Swal.fire(
               'Stock Updated',
                '',
                'success'
                 )




                }


          }
})


        })
        // update stock end

    })


    // sdit stock for balance




    $("#print").on("click",function(){
    // alert("click");
    window.print();
});

//     $('#dataTable-1').ready(function () {
//     $("#all").click();
// });
 $("#stock_branch").on("change",function(e){

    let id = $(this).val();
     let name = $("#stock_branch option:selected").text();
     $("#branch_name").html(name);

    $.ajax({

        url:"{{url('show_ajax_stock')}}",
        type:"get",
         data: {id:id},
         beforeSend:function(){


            $("#loader_stock").css("visibility","visible");



         },
         success:function(data){
            console.log(data);

            if(data == ""){
              $("#stock_table").html("<h2 style='width:480px'>This Branch Data is Not Available</h2>")

              setTimeout(function(){
                $("#loader_stock").css("visibility","hidden");
             }, 2000);

            }else{
                $("#stock_table").html(data);

                // $('').attr('id', '');
                setTimeout(function(){
                $("#loader_stock").css("visibility","hidden");
             }, 2000);

            }



         }


    });


 });


   $("#out").on("click",function(e){

    e.preventDefault();

    $.ajax({

url:"{{url('out_stock')}}",
type:"get",
 beforeSend:function(){


    $("#loader_stock").css("visibility","visible");



 },
 success:function(data){
    console.log(data);

    if(data == ""){
      $("#stock_table").html("<h2 style='width:480px'>No Out Of Stock Product is available</h2>")

      setTimeout(function(){
        $("#loader_stock").css("visibility","hidden");
     }, 2000);

    }else{
        $("#stock_table").html(data);
        setTimeout(function(){
        $("#loader_stock").css("visibility","hidden");
     }, 2000);

    }



 }


});


   });

// less then 10 products
   $("#less").on("click",function(e){


e.preventDefault();



$.ajax({

url:"{{url('less_stock')}}",
type:"get",
beforeSend:function(){


$("#loader_stock").css("visibility","visible");



},
success:function(data){
console.log(data);

if(data == ""){
  $("#stock_table").html("<h2 style='width:480px'>No Less Than 10 Product is available</h2>")

  setTimeout(function(){
    $("#loader_stock").css("visibility","hidden");
 }, 2000);

}else{
    $("#stock_table").html(data);
    setTimeout(function(){
    $("#loader_stock").css("visibility","hidden");
 }, 2000);

}



}


});


});


// all products availabale

   $("#all").on("click",function(e){


e.preventDefault();



$.ajax({

url:"{{url('all')}}",
type:"get",
beforeSend:function(){


$("#loader_stock").css("visibility","visible");



},
success:function(data){
console.log(data);

if(data == ""){
  $("#stock_table").html("<h2 style='width:480px'>No Less Than 10 Product is available</h2>")

  setTimeout(function(){
    $("#loader_stock").css("visibility","hidden");
 }, 2000);

}else{
    $("#stock_table").html(data);
    setTimeout(function(){
    $("#loader_stock").css("visibility","hidden");
 }, 2000);

}



}


});


});



});

</script>
@endsection
