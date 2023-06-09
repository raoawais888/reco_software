


@extends('layout.master')

@section('main-content')
    
{{-- edit model start here  --}}


@if(session()->get('success'))

<script>
       Swal.fire(
      'Salary Added',
      '',
      'success'
    )
</script>
@endif
@if(session()->get('update'))

<script>
       Swal.fire(
      'Salary update',
      '',
      'success'
    )
</script>
@endif








<div class="modal fade" id="exampleModal_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Salary</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form  id="update_form_salary" method="POST" >
        @csrf
      <div class="modal-body" id="edit_salary_form">
       
      </div>
    </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="update_salary_btn" class="btn btn-primary">Update Salary</button>
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
        <h5 class="modal-title" id="exampleModalLabel">Add Salary</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="salary_from" method="POST" action="{{url('add_salary')}}">
            @csrf
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Date</label>
            <input type="date()" class="form-control" id="date" name="date">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Employe Name</label>
            <select name="employee_id" id="name" class="form-control">
      
            </select>
          </div>

          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Basic salary</label>
            <input type="number" class="form-control" id="salary_val" name="salary" value="">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Advance</label>
            <input type="number" class="form-control" id="advance" name="advance">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Deduction</label>
            <input type="number" class="form-control" id="deduction" name="deduction">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Branch</label>
            <select name="branch_id" id="name" class="form-control">
       
            </select>
          </div>
          
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        {{-- <button type="button" id="add_salary_btn" class="btn btn-primary">Add Salary</button> --}}
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
                    <h2 class=" page-title  text-uppercase">List Of Stock Detail</h2>
                </div>
                <div class="col-md-2">

                    
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Add Salary</button>
                    
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
                        {{-- <th>Brand</th> --}}
                        <th>Category</th>
                        <th>Qty</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php
                        $sr=0;    
                        @endphp
                        @foreach ($result->unique('category') as $data)
                        @php
                            $sr++; 
                        @endphp
                           
                        
                      <tr>
                        <td>{{$sr}}</td>
                        <td>{{$data->category->category}}</td>
                        {{-- <td>{{$data->brand->brand}}</td> --}}
                        <td>{{$data->qty}}</td>
                        
                       

                        
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

    $("#name").on("change",function(){
      let id = $(this).val();
      $.ajax({
      url:"{{url('salary_select')}}",
      type:"get",
      data:{id:id},
      success:function(data){
       let sel =  $("#salary_val").val(data);
      //  console.log(sel);

      }

      });
    })



    $(document).on("click","#salary_remove",function(e){
     let id = $(this).attr("data-srid");

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
        url:"{{url('salary_remove')}}",
        type:"get",
        data:{id:id},
        success:function(data){
          if(data==1){

            Swal.fire(
      'Salary remove',
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


$(document).on("click","#salary_edit",function(e){
  e.preventDefault();
   let id = $(this).attr("data-seid");
   $.ajax({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url:"{{url('salary_edit')}}",
    type:"POST",
    data:{id:id},
    success:function(data){

      // console.log(data);
      $("#edit_salary_form").html(data);
      $("#update_btn").trigger("click");


    }



   })


})

    $("#update_salary_btn").on("click",function(e){
       $("#update_form_salary").submit();

      
    })


  })
</script>