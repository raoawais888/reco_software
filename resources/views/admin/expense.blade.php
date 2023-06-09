@extends('layout.master')

@section('main-content')
    


{{--  edit model entry start   --}}

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Expense</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="expense_data">
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" id="update_expense_btn" class="btn btn-primary">Update Expense</button>
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
                    <h2 class=" page-title text-uppercase">List of expense Data table</h2>
                </div>
                <div class="col-md-2">

{{--                     
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Add Expense</button> --}}
                    
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal" data-whatever="@mdo" id="edit_btn"></button>
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
                      <tr>
                        <th class="text-center">Sr #</th>
                        <th class="text-center"> Date</th>
                        <th class="text-center"> Employe Name </th>
                        <th class="text-center">Amount</th>
                        <th class="text-center">Description</th>
                        <th class="text-center">Edit</th>
                        <th class="text-center">Delete</th>
                         
                      </tr>
                    </thead>
                     <tbody>
                        @php
                        $sr=0;    
                        @endphp
                        @foreach ($expense as $data)
                        @php
                            $sr++; 
                        @endphp
                           
                        
                      <tr class="text-cecnter">
                        <td class="text-center">{{$sr}}</td>
                        <td class="text-center">{{$data->date}}</td>
                        <td class="text-center">{{$data->employee}}</td>
                        <td class="text-center">{{$data->price}}.00</td>
                        <td class="text-center">{{$data->description}}</td>
                        <td class="text-center"><a class="btn btn-success" href="#" id="expense_edit" data-exeid="{{$data->id}}">Edit</a></td>
                        <td class="text-center"> <a class="btn btn-danger" href="#" id="expense_remove" data-erid="{{$data->id}}">Remove</a> </td>
                        
                        
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
    <div class="modal fade modal-notif modal-slide" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="defaultModalLabel">Notifications</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="list-group list-group-flush my-n3">
              <div class="list-group-item bg-transparent">
                <div class="row align-items-center">
                  <div class="col-auto">
                    <span class="fe fe-box fe-24"></span>
                  </div>
                  <div class="col">
                    <small><strong>Package has uploaded successfull</strong></small>
                    <div class="my-0 text-muted small">Package is zipped and uploaded</div>
                    <small class="badge badge-pill badge-light text-muted">1m ago</small>
                  </div>
                </div>
              </div>
              <div class="list-group-item bg-transparent">
                <div class="row align-items-center">
                  <div class="col-auto">
                    <span class="fe fe-download fe-24"></span>
                  </div>
                  <div class="col">
                    <small><strong>Widgets are updated successfull</strong></small>
                    <div class="my-0 text-muted small">Just create new layout Index, form, table</div>
                    <small class="badge badge-pill badge-light text-muted">2m ago</small>
                  </div>
                </div>
              </div>
              <div class="list-group-item bg-transparent">
                <div class="row align-items-center">
                  <div class="col-auto">
                    <span class="fe fe-inbox fe-24"></span>
                  </div>
                  <div class="col">
                    <small><strong>Notifications have been sent</strong></small>
                    <div class="my-0 text-muted small">Fusce dapibus, tellus ac cursus commodo</div>
                    <small class="badge badge-pill badge-light text-muted">30m ago</small>
                  </div>
                </div> <!-- / .row -->
              </div>
              <div class="list-group-item bg-transparent">
                <div class="row align-items-center">
                  <div class="col-auto">
                    <span class="fe fe-link fe-24"></span>
                  </div>
                  <div class="col">
                    <small><strong>Link was attached to menu</strong></small>
                    <div class="my-0 text-muted small">New layout has been attached to the menu</div>
                    <small class="badge badge-pill badge-light text-muted">1h ago</small>
                  </div>
                </div>
              </div> <!-- / .row -->
            </div> <!-- / .list-group -->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Clear All</button>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade modal-shortcut modal-slide" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="defaultModalLabel">Shortcuts</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body px-5">
            <div class="row align-items-center">
              <div class="col-6 text-center">
                <div class="squircle bg-success justify-content-center">
                  <i class="fe fe-cpu fe-32 align-self-center text-white"></i>
                </div>
                <p>Control area</p>
              </div>
              <div class="col-6 text-center">
                <div class="squircle bg-primary justify-content-center">
                  <i class="fe fe-activity fe-32 align-self-center text-white"></i>
                </div>
                <p>Activity</p>
              </div>
            </div>
            <div class="row align-items-center">
              <div class="col-6 text-center">
                <div class="squircle bg-primary justify-content-center">
                  <i class="fe fe-droplet fe-32 align-self-center text-white"></i>
                </div>
                <p>Droplet</p>
              </div>
              <div class="col-6 text-center">
                <div class="squircle bg-primary justify-content-center">
                  <i class="fe fe-upload-cloud fe-32 align-self-center text-white"></i>
                </div>
                <p>Upload</p>
              </div>
            </div>
            <div class="row align-items-center">
              <div class="col-6 text-center">
                <div class="squircle bg-primary justify-content-center">
                  <i class="fe fe-users fe-32 align-self-center text-white"></i>
                </div>
                <p>Users</p>
              </div>
              <div class="col-6 text-center">
                <div class="squircle bg-primary justify-content-center">
                  <i class="fe fe-settings fe-32 align-self-center text-white"></i>
                </div>
                <p>Settings</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main> <!-- main -->
</div> <!-- .wrapper -->
<script src="{{asset('js/jquery.min.js')}}"></script>

<script>
  // expense remove 
$(document).on("click","#expense_remove",function(e){
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
    url:"{{url('remove_expense')}}",
    type:"get",
    data:{id:id},
    success:function(data){
if(data==1){
      Swal.fire(
      'Expense Remove',
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


// expesnse edit 
$(document).on("click","#expense_edit",function(e){

e.preventDefault();
  let id = $(this).attr("data-exeid");
  $.ajax({

   headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   },
   url:"{{url('edit_expense')}}",
   type:"post",
   data:{id:id},
   success:function(data){

        $("#expense_data").html(data);
        $("#edit_btn").trigger("click");   

   }
  });

});


// update expense 
$("#update_expense_btn").on("click",function(e){


$.ajax({
  headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url:"{{url('update_expense')}}",
    type:"post",
    data:$("#update_expense_from").serialize(),
    beforeSend:function(){
     $("#edit_loader").show();

    },
    complete:function(){
      $("#edit_loader").hide();
    },
    success:function(data){
          if(data==1){
            Swal.fire(
      'Expense Update',
      '',
      'success'
    )
    location.reload();

          }

    }

});


});


</script>
@endsection