
@extends('layout.master')

<style>
    @media print{


          #employee_edit , #employe_remove  , #print ,#dataTable-1_info , #dataTable-1_paginate ,#dataTable-1_length ,#dataTable-1_filter ,
          #delete_th , #edit_th{
            display: none;
          }

    }
</style>
@section('main-content')

@if(session()->get('update'))

 <script>
      Swal.fire(
      'employee  Updated',
      '',
      'success'
    )
 </script>

@endif

{{-- edit model start here  --}}

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit  Employee</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" id="employee_update_form">
        @csrf
      <div class="modal-body" id="employee_data">

      </div>
    </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="update_employee" class="btn btn-primary">Update Employee</button>
        <img src="loader.gif" alt="" id="edit_loader">
      </div>
    </div>
  </div>
</div>
{{-- edit model end here  --}}


<main role="main" class="main-content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-12">
            <div class="row">
                <div class="col-md-12 d-flex justify-content-between">
                    <h2 class=" page-title  text-uppercase">List Of Employee Name</h2>
                    <button class="btn btn-primary" id="print" >Print</button>
                </div>
                <div class="col-md-2">

          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo" id="edit_btn_employee" style="display: none;">Add Category</button>
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
                        <th>Name</th>
                        <th>Number</th>
                        <th>cnic</th>
                        <th>Salary</th>
                        <th>Branch</th>
                        <th id="edit_th">Edit</th>
                        <th id="delete_th">Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php
                        $sr=0;
                        @endphp
                        @foreach ($employee as $data)
                        @php
                            $sr++;
                        @endphp


                      <tr>
                        <td>{{$sr}}</td>
                        <td>{{$data->name}}</td>
                        <td>{{$data->number}}</td>
                        <td>{{$data->cnic}}</td>
                        <td>{{$data-> salary}}</td>
                        <td>{{$data-> branch->name}}</td>
                          <td>  <a class="btn btn-success" href="#" id="employee_edit" data-emeid="{{$data->id}}">Edit</a></td>
                          <td>
                          <a class="btn btn-danger" href="#" id="employe_remove" data-emrid="{{$data->id}}">Remove</a></td>


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
<script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="//cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="//cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
<script>
  $(document).ready(function(){
    $("#print").on("click",function(){
    // alert("click");
    window.print();
});

  $(document).on("click","#employe_remove",function(e){
    let id = $(this).attr("data-emrid");
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

         url:"{{url('employee_remove')}}",
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
  })


$(document).on("click","#employee_edit",function(e){

let id = $(this).attr("data-emeid");

$.ajax({

   url:"{{url('employee_edit')}}",
   data:{id:id},
   success:function(data){

    $("#employee_data").html(data);
    $("#edit_btn_employee").trigger("click");

   }


});

})


$("#update_employee").on("click",function(){

  $("#employee_update_form").submit();

})


  });




  $('#dataTable-1').DataTable( {
    dom: 'Bfrtip',
    buttons: [
        'colvis',
        'excel',
        'print'
    ]
} );


</script>
