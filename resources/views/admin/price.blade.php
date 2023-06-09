@php

use App\Models\entry;

@endphp

@extends('layout.master')

@section('main-content')

{{-- edit model start here  --}}


@if(session()->get('success'))
 <script>
    Swal.fire(
      'price Updated',
      '',
      'success'
    )
 </script>

@endif
<div class="modal fade" id="exampleModal_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Price</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id='update_price_from' method='POST'>
        @csrf
      <div class="modal-body" id="edit_category_form">

      </div>
    </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="update_price_btn" class="btn btn-primary">Update Price</button>
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
        <h5 class="modal-title" id="exampleModalLabel">Add Price</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="price_from">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Select Brand</label>
             <select name="brand" id="product" class="form-control">
               @foreach ($brand as $item)

               <option value="{{$item->id}}">{{$item->brand}}</option>
               @endforeach
             </select>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Select Category</label>
             <select name="category" id="category" class="form-control">
                <option value="" disabled selected>Select Category</option>
               @foreach ($category as $item)

               <option value="{{$item->id}}">{{$item->category}}</option>
               @endforeach
             </select>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Product</label>

             <select name="product_id" id="product_data" class="form-control">
              <option value="">Select Product </option>
              @foreach ($entry as $item)
              <option value="{{$item->id}}">{{$item-> name}}</option>

              @endforeach

             </select>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Actual Price</label>
            <input type="text" class="form-control"  name="a_price">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Sale Price</label>
            <input type="text" class="form-control" id="price" name="price">
          </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="add_price_btn" class="btn btn-primary">Add Price</button>
        <img src="loader.gif" alt="" id="loader">
      </div>
    </div>
  </div>
</div>

<main role="main" class="main-content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-12">
            <div class="row">
                <div class="col-md-10">
                    <h2 class=" page-title  text-uppercase">List Of Price Data table</h2>
                </div>
                <div class="col-md-2">


          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Add Price</button>

          <button type="button" class="btn btn-primary d-none" id="update_btn" data-toggle="modal" data-target="#exampleModal_edit" data-whatever="@mdo">update price</button>
                </div>
            </div>



          <div class="row my-4">
            <!-- Small table -->
            <div class="col-md-12">
              <div class="card shadow">
                <div class="card-body">
                  <!-- table -->
                  <table class="table  hover multiple-select-row nowrap" id="dataTable-1">
                    <thead>
                      <tr>
                        <th>Sr #</th>
                        <th>product Name</th>
                        <th>Brand</th>
                        <th>Category</th>
                        <th>Actual  price</th>
                        <th>Sale price</th>
                        <th>Edit</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php
                        $sr=0;
                        @endphp
                        @foreach ($price as $data)
                        @php
                            $sr++;

                            // $product_id=$data->product;
                            // $entry = entry::where(['id'=>$product_id])->first();
                        @endphp


                      <tr>
                        <td>{{$sr}}</td>
                        <td>{{$data->product->name}}</td>
                        <td>{{$data->brand->brand}}</td>
                        <td>{{$data->category->category}}</td>
                        <td>{{$data->a_price}}</td>
                        <td>{{$data->price}}</td>
                          <td>  <a class="btn btn-success btn-sm" href="#" id="price_edit" data-peid="{{$data->id}}">Edit</a></td>
                          <td>
                          <a class="btn btn-danger btn-sm" href="#" id="price_remove" data-prid="{{$data->id}}">Remove</a></td>


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

    $("#add_price_btn").on("click",function(e){
      e.preventDefault();
      let price = $("#price").val();
      let product = $("#product").val();

      if(price==""){

         $("#price").css("borderColor","red");
         return false;


      }else{
          $.ajax({
            headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url:"{{url('add_price')}}",
    type:"POST",
    data:$("#price_from").serialize(),
    beforeSend:function(){

      $("#loader").show();

    },
    complete:function(){

  $("#loader").hide();

    },
    success:function(data){

      if(data==1){
        Swal.fire(
      'price Added',
      '',
      'success'
    )

          location.reload();
      }


    }



          });
      }





        })



    $(document).on("click","#price_edit",function(e){
    e.preventDefault();

    let id = $(this).attr("data-peid");
    $.ajax({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url:"{{url('edit_price')}}",
    type:"POST",
    data:{id:id},
    success:function(data){
      console.log(data);
            $("#edit_category_form").html(data);
            $("#update_btn").trigger("click");

    }


     });

    })

$("#update_price_btn").on("click",function(e){

  e.preventDefault();
   $("#update_price_from").submit();
});




$(document).on("click","#price_remove",function(e){
e.preventDefault();
let id = $(this).attr("data-prid");
Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this Category and also all Product entry Delete belong to this category!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.isConfirmed) {
    $.ajax({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url:"{{url('remove_price')}}",
    type:"POST",
    data:{id:id},
    success:function(data){
        if(data==1){

          Swal.fire(
      'price Remove',
      '',
      'success'
    )

          location.reload();
        }
    }


     });

  }
})







});






  });




$(document).ready(function(e){
     $(document).on("change","#category",function(e){
        let category = $(this).val();
        // alert(category)

        $.ajax({
            url:"{{url('price_category')}}",
            type:"get",
            data:{category:category},
            success:function(data){
              console.log(data);
                 $("#product_data").html(data);

            }


        })

     })

  })
</script>
@endsection
