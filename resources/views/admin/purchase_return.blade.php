@extends('layout.master')

@section('main-content')
    
@if(session()->get('success'))
<script>
      Swal.fire(
    'purchase  Return  Update',
    '',
    'success'
  )
</script>

@endif



{{--  edit model entry start   --}}

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Purchase</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form  method="POST" id="purchase_return_update_form">
          @csrf
        <div class="modal-body" id="purchase_return_data">
          
        </div>
      </form>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" id="update_purchase_return_btn" class="btn btn-primary">Update Return purchas</button>
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
                    <h2 class=" page-title text-uppercase">List Of Purchase Return  Data table</h2>
                </div>
                <div class="col-md-2">

                    
                    
          <button type="button" class="btn btn-primary d-none" data-toggle="modal" data-target="#editModal" data-whatever="@mdo" id="purchase_return_btn"></button>
                </div>
            </div>
          
          

          <div class="row my-4">
            <!-- Small table -->
            <div class="col-md-12">
              <div class="card shadow">
                <div class="card-body">
                  <!-- table -->
                  <table class="table datatables" id="dataTable-1">
                    <thead>
                      <tr class="bg-primary">
                        <th>Sr #</th>
                        <th>Brand</th>
                        <th>category</th>
                        <th>Name</th>
                        <th>Unit</th>
                        <th>Price</th>
                        <th>Branch</th>
                        <th>qty</th>
                        <th>Edit</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php
                        $sr=0;    
                        @endphp
                        @foreach ($purchase as $data)
                        @php
                            $sr++; 
                           
                        @endphp
                           
                        
                      <tr >
                        <td>{{$data->id}}</td>
                        <td>{{$data->brand->brand}}</td>
                        <td>{{$data->category->category}}</td>
                        <td>{{$data->product->name}}</td>
                        <td>{{$data->unit}}</td>
                        <td>{{$data->price}}</td>
                        <td>{{$data->branch->name}}</td>
                        <td>{{$data->qty}}</td>
                        <td><a class="btn btn-success btn-sm" href="#" id="purchase_return_edit" data-preid="{{$data->id}}">Edit</a></td>
                        <td><a class="btn btn-danger btn-sm" href="#" id="purchase_return_remove" data-prrid="{{$data->id}}">Remove</a>
                        </td>
                        
                            
                                 
                           
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

  $(document).on("click","#purchase_return_remove",function(e){

e.preventDefault();
let id = $(this).attr("data-prrid");
// alert(id);

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
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },
  url:"{{url('remove_purchase_return')}}",
type:"post",
  data:{id:id},
  success:function(data){
    // alert(data);
if(data==1){
    Swal.fire(
    'Purchase  Return Remove',
    '',
    'success'
  )
  location.reload();

}
  }


  });
}
})




})


$(document).on("click","#purchase_return_edit",function(e){
e.preventDefault();

let id = $(this).attr("data-preid");


$.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },
  url:"{{url('edit_purchase_return')}}",
  type:"post",
  data:{id:id},
  success:function(data){
    // alert(data);
// console.log(data);
$("#purchase_return_data").html(data);
$("#purchase_return_btn").trigger("click");


  }


  });


})


// purchase update 




$("#update_purchase_return_btn").on("click",function(){


$("#purchase_return_update_form").submit();

});

$(document).ready(function(e){
     $(document).on("change","#category",function(e){
        let category = $(this).val();
        let element = $(this);
        let p_id = $(this).closest('.row').find('#product_data');
        
        console.log(p_id);
        
        

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


