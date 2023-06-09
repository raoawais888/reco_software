@extends('layout.master')

@section('main-content')

{{-- edit model start here  --}}

<div class="modal fade" id="exampleModal_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="edit_category_form">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="update_category_btn" class="btn btn-primary">Update category</button>
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
        <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="category_from">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Category</label>
            <input type="text" class="form-control" id="category_name" name="category">
          </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="add_category_btn" class="btn btn-primary">Add category</button>
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
                    <h2 class=" page-title  text-uppercase">List Of Category Data table</h2>
                </div>
                <div class="col-md-2">


          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Add Category</button>

          <button type="button" class="btn btn-primary d-none" id="update_btn" data-toggle="modal" data-target="#exampleModal_edit" data-whatever="@mdo">update Category</button>
                </div>
            </div>



          <div class="row my-4">
            <!-- Small table -->
            <div class="col-md-12">
              <div class="card shadow">
                <div class="card-body">
                  <!-- table -->
                  <table class="table  hover multiple-select-row nowrap category_table" id="dataTable-1">
                    <thead>
                      <tr>
                        <th>Sr #</th>
                        <th>Category Name</th>
                        <th>Edit</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php
                        $sr=0;
                        @endphp
                        @foreach ($category as $data)
                        @php
                            $sr++;
                        @endphp


                      <tr>
                        <td>{{$sr}}</td>
                        <td>{{$data->category}}</td>
                          <td>  <a class="btn btn-success" href="#" id="category_edit" data-ceid="{{$data->id}}">Edit</a></td>
                          <td>
                          <a class="btn btn-danger" href="#" id="category_remove" data-crid="{{$data->id}}">Remove</a></td>


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


  </main>
  <!-- main -->
</div>
 <!-- .wrapper -->


 {{-- javascrpt code start  --}}
 <script src="{{asset('js/jquery.min.js')}}"></script>

 <script>
      $(document).ready(function(){
        $("#add_category_btn").on("click",function(e){
      e.preventDefault();
       let category = $("#category_name").val();

       if(category==""){

         $("#category").css("borderColor","red");
         return false;


      }else{
          $.ajax({
            headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
     url:"{{url('add_category')}}",
     type:"POST",
    data:{category:category},
     beforeSend:function(){

      $("#loader").show();

    },
    complete:function(){

  $("#loader").hide();

    },
    success:function(data){

        const htmlTR = `

               <tr role="row" class="odd">
                        <td class="sorting_1">Added</td>
                        <td>${data.category}</td>
                          <td>  <a class="btn btn-success" href="#" id="category_edit" data-ceid="${data.id}">Edit</a></td>
                          <td>
                          <a class="btn btn-danger" href="#" id="category_remove" data-crid="${data.id}">Remove</a></td>
                      </tr>
        `;



        $('.close').trigger("click");
        Swal.fire('Category Added','','success')
        $('.category_table').prepend(htmlTR);



       if(data==0){
        Swal.fire('Category Already Exits','','error')
       }


    }



          });
      }





        })


// category Eidt
$(document).on("click","#category_edit",function(e){
e.preventDefault();
let id = $(this).attr("data-ceid");

$.ajax({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url:"{{url('edit_category')}}",
    type:"POST",
    data:{id:id},
    success:function(data){
            $("#edit_category_form").html(data);
            $("#update_btn").trigger("click");

    }


     });
});



//  UPDATE CATEGORY


$("#update_category_btn").on("click",function(e){
e.preventDefault();
$.ajax({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url:"{{url('update_category')}}",
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
      'Category Updated',
      '',
      'success'
    )

          location.reload();
      }
    }


     });
});




// category remove

$(document).on("click","#category_remove",function(e){
e.preventDefault();
let id = $(this).attr("data-crid");
let element = this;
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
    url:"{{url('remove_category')}}",
    type:"POST",
    data:{id:id},
    success:function(data){
        if(data==1){
          Swal.fire('Category Remove','','success')
          $(element).closest("tr").slideUp(500);
        }
    }


     });

  }
})







});



});

 </script>
 {{-- javascrpt code end  --}}


@endsection
