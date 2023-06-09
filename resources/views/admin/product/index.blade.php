@extends('layout.master')

@section('main-content')

{{-- edit model start here  --}}

<div class="modal fade" id="exampleModal_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="edit_product_form">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="update_product_btn" class="btn btn-primary">Update Product</button>
        <img src="loader.gif" alt="" id="edit_loader">
      </div>
    </div>
  </div>
</div>
{{-- edit model end here  --}}


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="product_from">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Product Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
            <div id="name_error"></div>
          </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" id="add_product_btn" class="btn btn-primary">Add Product</button>
        <img src="loader.gif" alt="" id="loader">
      </div>
    </form>
    </div>
  </div>
</div>
<div class="loader">
  <img src="{{asset('img/loader.gif')}}" alt="">
</div>
<main role="main" class="main-content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-12">
            <div class="row">
                <div class="col-md-10">
                    <h2 class=" page-title  text-uppercase">List Of Product Data table</h2>
                </div>
                <div class="col-md-2">


          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Add Product</button>

          <button type="button" class="btn btn-primary d-none" id="update_btn" data-toggle="modal" data-target="#exampleModal_edit" data-whatever="@mdo">update Category</button>
                </div>
            </div>



          <div class="row my-4">
            <!-- Small table -->
            <div class="col-md-12">
              <div class="card shadow">
                <div class="card-body">
                   {{-- table --}}
                  <table class="table  hover multiple-select-row nowra product_table" id="dataTable-1">
                    <thead>
                      <tr>
                        <th>Sr #</th>
                        <th>Product Name</th>
                        <th>Edit</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php
                        $sr=0;
                        @endphp
                        @foreach ($product as $data)
                        @php
                            $sr++;
                        @endphp


                      <tr>
                        <td>{{$sr}}</td>
                        <td>{{$data->name}}</td>
                          <td>  <a class="btn btn-success" href="#" id="product_edit" data-peid="{{$data->id}}">Edit</a></td>
                          <td>
                          <a class="btn btn-danger" href="#" id="product_remove" data-prid="{{$data->id}}">Remove</a></td>


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

@endsection
<script src="{{asset('js/jquery.min.js')}}"></script>
<script>



$(document).ready(function(){

$("#add_product_btn").on("click",function(e){
   e.preventDefault();

    let name = $("#name").val();

     if(name == ""){

        $("#name_error").html("Please Enter the Product").css("color","red");
        return false;

     }

    $.ajax({
       url:"{{url('add_product')}}",
       type:"get",
       data:{name:name},
       beforeSend:function(){

        $('.loader').css("visibility","visible");
       },
       complete:function(){
        setTimeout(() => {
        $('.loader').css("visibility","hidden");
      }, 1000);
      location.reload();
       },
       success:function(data){
        console.log(data);
        const htmlTR = `

        <tr role="row" class="odd">
                <td class="sorting_1">Added</td>
                <td>${data.brand}</td>
                <td>  <a class="btn btn-success" href="#" id="category_edit" data-ceid="${data.id}">Edit</a></td>
                <td>
                <a class="btn btn-danger" href="#" id="category_remove" data-crid="${data.id}">Remove</a></td>
            </tr>
        `;



        $('.close').trigger("click");
        Swal.fire('Product Added','','success')
        $('.product_table').prepend(htmlTR);


      if(data==0){
        Swal.fire('Product Already Exist','','error')
      }

        }



    })







})




$(document).on("click","#product_remove",function(e){
  let id = $(this).attr("data-prid");

  $.ajax({

     url: "{{url('product_remove')}}",
     data:{id:id},
     beforeSend:function(){
      $('.loader').css("visibility","visible");
     }
,
complete:function(){
        setTimeout(() => {
        $('.loader').css("visibility","hidden");
      }, 1000);
       },


  success:function(data){

       if(data == 1){
        Swal.fire(
      'Product Remove',
      '',
      'success'
    )

    $("#product_remove").closest("tr").remove();
       }else{
        Swal.fire(
      'Something Wrong',
      '',
      'error'
    )

       }


  }




})

})


$(document).on("click","#product_edit",function(e){

let id = $(this).attr("data-peid");

$.ajax({

  url : "{{url('edit_product')}}",
  data:{id:id},

  success:function(data){



    $("#edit_product_form").html(data);

  $("#update_btn").trigger("click");
  }

})



})


$("#update_product_btn").on("click",function(e){
  e.preventDefault();

    let name = $("#edit_product").val();
    let category_id = $("#category_id").val();
    let brand_id = $("#brand_id").val();
    let id = $("#product_id ").val();

    $.ajax({

      url : "{{url('update_product')}}",
      data:{id:id, name:name, category_id:category_id, brand_id:brand_id},
      success:function(data){

        if(data == 1){
          Swal.fire(
      'Updated',
      '',
      'success'
    )
    location.reload();
        }
      }



    })


})

})

</script>
