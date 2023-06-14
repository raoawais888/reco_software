@extends('layout.master')

@section('main-content')
    {{--  edit model entry start   --}}

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Entry</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="entry_data">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="update_entry_btn" class="btn btn-primary">Update Entry</button>
                    <img src="loader.gif" alt="" id="edit_loader">
                </div>
            </div>
        </div>
    </div>
    {{--  edit model entry end   --}}

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Product Entry</h5>



                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="entry_from">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Today Date</label>
                                    <input type="text" readonly class="form-control date_select" id="date"
                                        name="date" value="">


                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Product Name</label>
                                    <div id="product_data">
                                        <select name="product_id" id="product_id"  class="form-control p_select" data-placeholder="Select a Product" required>

                                            @foreach ($product as $data )

                                            <option value="{{$data->id}}">{{$data->name}}</option>
                                            @endforeach


                                        </select>
                                    </div>

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
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                        <img src="loader.gif" alt="" id="loader">

                    </form>

                </div>


            <div class="modal-footer" style="background-color: #fff;">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="add_entry_btn" class="btn btn-primary">Add Entry</button>
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
                            <h2 class=" page-title text-uppercase">List Of Entry Data table</h2>
                        </div>
                        <div class="col-md-2">

                            <button type="button" class="btn btn-primary btn_add_entry" data-toggle="modal"
                                data-target="#exampleModal" data-whatever="@mdo">Add Entry</button>

                            <button type="button" class="btn btn-primary d-none" data-toggle="modal"
                                data-target="#editModal" data-whatever="@mdo" id="edit_btn_entry"></button>
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
                                                <th>Date</th>
                                                <th>Name</th>
                                                <th>QTY</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $sr = 0;
                                            @endphp
                                            @foreach ($entry as $data)
                                                @php
                                                    $sr++;

                                                @endphp


                                                <tr>
                                                    <td>{{ $sr }}</td>
                                                    <td>{{ $data->date }}</td>
                                                    <td>{{ $data->product->name }}</td>
                                                    <td>{{ $data->qty }}</td>
                                                    <td><a class="btn btn-success" href="#" id="entry_edit"
                                                            data-eeid="{{ $data->id }}">Edit</a></td>
                                                    <td><a class="btn btn-danger" href="#" id="entry_remove"
                                                            data-erid="{{ $data->id }}">Remove</a>
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
    <script src="{{asset("js/select2.min.js")}}"></script>

  <script>
    $(document).ready(function(){

    setTimeout(() => {
        $('.p_select').select2({});
    }, 1000);

    })








    $("#add_entry_btn").on("click",function(e){
    e.preventDefault();
     let name = $("#product_id").val();
     let qty = $("#qty").val();


         if(name == ""){

             $("#name").css("borderColor","red");
             return false;
         }else if(qty ==""){

            $("#qty").css("borderColor","red");
             return false;

         }else{
            $.ajax({
            headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
      url:"{{url('add_entry')}}",
    type:"POST",
    data: $("#entry_from").serialize(),
    beforeSend:function(){

      $("#loader").show();

    },
    complete:function(){

  $("#loader").hide();

    },
    success:function(data){

        Swal.fire('Entry Added','','success');
        $(".close").trigger("click");
    }


      });
         }





   });


//    remove entry
$(document).on("click","#entry_remove",function(e){

  e.preventDefault();
  let id = $(this).attr("data-erid");




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
    url:"{{url('remove_entry')}}",
    type:"POST",
    data:{id:id},
    success:function(data){
     if(data==1){
        Swal.fire(
      'Deleted!',
      'Your file has been deleted.',
      'success'
    )

    location.reload();

     }


    }


      });

  }
})


});






// entry edit

$(document).on("click","#entry_edit",function(e){

e.preventDefault();
let id = $(this).attr("data-eeid");
tr = $(this).closest("tr");
$.ajax({

  headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url:"{{url('edit_entry')}}",
    type:"POST",
    data:{id:id},
    success:function(data){


       $("#entry_data").html(data);
       $("#edit_btn_entry").trigger("click");

    }

})


});


$("#update_entry_btn").on("click",function(e){

e.preventDefault();
$.ajax({

  headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url:"{{url('update_entry')}}",
    type:"POST",
    data:$("#update_entry_from").serialize(),
    beforeSend:function(){
      $("#edit_loader").show();
    },
    complete:function(){
    $("#edit_loader").hide();

    },
    success:function(data){

      if(data==1){
        Swal.fire('Update!','','success')
        $(".close").trigger("click");
        tr.css("background","#FCE9F1");


      }
    }


});


});

//    remove entry
$(document).on("click","#entry_remove",function(e){

  e.preventDefault();
  let id = $(this).attr("data-erid");
   let element = this;
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
    url:"{{url('remove_entry')}}",
    type:"POST",
    data:{id:id},
    success:function(data){
     if(data==1){
        Swal.fire('Deleted!','Your file has been deleted.','success');
        $(element).closest("tr").hide();



     }


    }


      });

  }
})


});







  </script>

@endsection
