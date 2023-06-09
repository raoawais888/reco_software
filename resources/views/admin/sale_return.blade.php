@extends('layout.master')

@section('main-content')
    
@if(session()->get('success'))


<script>
  Swal.fire(
      'Bill  Return Updated',
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
          <h5 class="modal-title" id="exampleModalLabel">Edit bill</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method='POST' >
          @csrf
        <div class="modal-body" id="bill_data">
          
        </div>

        </form>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          {{-- <button type="button" id="update_entry_btn" class="btn btn-primary">Update Entry</button> --}}
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
                    <h2 class=" page-title text-uppercase">Llist of Bill Data table</h2>
                </div>
                <div class="col-md-2">

{{--                     
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Add bill</button>
                     --}}
         
                </div>
            </div>
          
          

          <div class="row my-4">
            <!-- Small table -->
            <div class="col-md-12">
              <div class="card shadow">
                <div class="card-body">
                  <button type="button" class="btn btn-primary d-none" data-toggle="modal" data-target="#editModal" data-whatever="@mdo" id="bill_edit_btn">btn</button>
                  <!-- table -->
                  <table class="table datatables" id="dataTable-1">
                    <thead>
                      <tr>
                        <th class="text-center">Sr #</th>
                        <th class="text-center"> Date</th>
                        <th class="text-center"> client Name</th>
                        <th class="text-center">client number</th>
                        <th class="text-center">bill Number</th>
                        <th class="text-center">status</th>
                        <th class="text-center">View</th>
                        <th class="text-center">Edit</th>
                        <th class="text-center">Remove</th>
                      </tr>
                    </thead>
                     <tbody>
                        @php
                        $sr=0;    
                        @endphp
                        @foreach ($sale->unique('bill_number') as $data)
                        @php
                            $sr++; 
                        @endphp
                           
                        
                      <tr>
                        <td>{{$sr}}</td>
                        <td>{{$data->date}}</td>
                        <td>{{$data->client_name}}</td>
                        <td>{{$data->number}}</td>
                        <td>{{$data->bill_number}}</td>
                        
                        @if ($data->status ==1)
                            
                        <td>Paid</td>
                        @else
                        <td>Unpaid</td>
                        @endif

                        <td> <a class="btn btn-success btn-sm" href="{{url('invoice_bill_return',[$data->bill_number])}}" id="bill_view" data-bvid="{{$data->bill_number}}">View</a></td>
                        <td>
                          <a class="btn btn-primary btn-sm" href="#" id="bill_return_edit" data-breid="{{$data->bill_number}}">Edit</a></td>
                        <td>
                          <a class="btn btn-danger btn-sm" href="#" id="bill_return_remove" data-brrid="{{$data->bill_number}}">Remove</a></td>
                        
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
        $('input:checkbox').click(function() {
            $('input:checkbox').not(this).prop('checked', false);
        });



        $(document).on("click","#bill_return_remove",function(e){

e.preventDefault();
let id = $(this).attr("data-brrid");
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
  url:"{{url('remove_bill_return')}}",
  type:"POST",
  data:{id:id},
  success:function(data){
if(data==1){
    Swal.fire(
    'Deleted!',
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

$(document).on("click","#bill_return_edit",function(e){

let id = $(this).attr("data-breid");
// alert(id);

$.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },
  url:"{{url('bill_return_edit')}}",
  type:"POST",
  data:{id:id},
  success:function(data){
  $("#bill_data").html(data);
  $("#bill_edit_btn").trigger("click");
  }

});
});
    });
    </script>
@endsection