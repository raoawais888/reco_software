@php
use App\Models\entry;
@endphp

@extends('layout.master')

@section('main-content')
    
{{-- edit model start here  --}}

<div class="modal fade" id="exampleModal_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Brand</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="edit_brand_form">
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="update_brand_btn" class="btn btn-primary">Update Brand</button>
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
        <h5 class="modal-title" id="exampleModalLabel">Add Brand</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="brand_from">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Brand Name</label>
            <input type="text" class="form-control" id="brand_name" name="brand">
          </div>
          
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="add_brand_btn" class="btn btn-primary">Add Brand</button>
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
                    <h2 class=" page-title  text-uppercase">List Of Brand Data table</h2>
                </div>
                <div class="col-md-2">

                    
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Add Brand</button>
                    
          <button type="button" class="btn btn-primary d-none" id="update_btn" data-toggle="modal" data-target="#exampleModal_edit" data-whatever="@mdo">update Category</button>
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
                        <th>Brand Name</th>
                        <th>QTY</th>
                        <th>Edit</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php
                        $sr=0;    
                       
                        $qty_sum = 0;
                        @endphp
                        @foreach ($brand as $data)
                        
                        @php
                            $sr++; 
                            
                            
                            
                        @endphp
                           
                        
                      <tr>
                        <td>{{$sr}}</td>
                        <td>{{$data->brand}}</td>
                        <td>{{$data->qty}}</td>
                       
                          <td>  <a class="btn btn-success" href="#" id="brand_edit" data-beid="{{$data->id}}">Edit</a></td>
                          <td>
                          <a class="btn btn-danger" href="#" id="brand_remove" data-brid="{{$data->id}}">Remove</a></td>

                        
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
    $(document).ready(function(e){

        $("#add_brand_btn").on("click",function(e){
      e.preventDefault();
      let brand = $("#brand_name").val();
      
      if(brand==""){

         $("#brand").css("borderColor","red");
         return false;


      }else{
          $.ajax({
            headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url:"{{url('add_brand')}}",
    type:"POST",
    data:{brand:brand},
    beforeSend:function(){

      $("#loader").show();

    },
    complete:function(){

  $("#loader").hide();

    },
    success:function(data){
      
      if(data==1){
        Swal.fire(
      'Brand Added',
      '',
      'success'
    )

          location.reload();
      }else{
        
        Swal.fire(
      'Brand Already Exist',
      '',
      'error'
    )
      }


    }



          });
      }
        




        })


// category Eidt 
$(document).on("click","#brand_edit",function(e){
e.preventDefault();
let id = $(this).attr("data-beid");

$.ajax({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url:"{{url('edit_brand')}}",
    type:"POST",
    data:{id:id},
    success:function(data){
            $("#edit_brand_form").html(data);
            $("#update_btn").trigger("click");
        
    }


     });
});
 


//  UPDATE CATEGORY 


$("#update_brand_btn").on("click",function(e){
e.preventDefault();
$.ajax({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url:"{{url('update_brand')}}",
    type:"get",
    data:$("#update_from").serialize(),
    beforeSend:function(){
 $("#edit_loader").show();
    },
    complete:function(){
      $("#edit_loader").hide();
    },
    success:function(data){
           
      if(data==1){
        Swal.fire(
      'Brand Updated',
      '',
      'success'
    )

          location.reload();
      }
    }


     });
});
 



// category remove 

$(document).on("click","#brand_remove",function(e){
e.preventDefault();
let id = $(this).attr("data-brid");
Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this Brand and also all Product entry Delete belong to this category!",
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
    url:"{{url('remove_brand')}}",
    type:"POST",
    data:{id:id},
    success:function(data){
        if(data==1){

          Swal.fire(
      'Brand Remove',
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


// Category section End

    })
</script>
@endsection