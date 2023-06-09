@extends('layout.master')

@section('main-content')
<style>
    #loader_stock{
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        /* background: rgba(255, 255, 255,0.9); */
        z-index: 9999;
        display: flex;
        justify-content: center;
        align-items: center;
        visibility: hidden;
    }
</style>
{{-- edit model start here  --}}


<div class='modal fade bd-example-modal-lg large_model_detail' id="detail_modal" tabindex='-1' role='dialog' aria-labelledby='myLargeModalLabel' aria-hidden='true'>
  <div class='modal-dialog modal-lg'>
    <div class='modal-content p-2'>
        <table>
        <thead>
        <th class="text-center">#sr</th>
        <th class="text-center">Date</th>
        <th class="text-center">Employee Name</th>
        <th class="text-center">Amount</th>
        <th class="text-center">Description</th>
        </thead>

  <tbody id="paiti_detail_content">

</tbody>
</table>

</div>
</div>
</div>


<div class="modal fade" id="exampleModal_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Client</h5>
        <button type="button" class="close_update" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="edit_cash">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="update_cash_btn" class="btn btn-primary">Update client</button>
        <img src="loader.gif" alt="" id="edit_loader">
      </div>
    </div>
  </div>
</div>
{{-- edit model end here  --}}
@if(session()->get('success'))
<script>
   Swal.fire(
'Add Cash On Hand Add!',
'',
'success'
)
</script>

@endif

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Cash On Hand</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form  method="POST" action="{{url('cash')}}">
          @csrf
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Date</label>
            <input type="Date" class="form-control" id="date" name="date">
          </div>

          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Amount</label>
            <input type="text" class="form-control" id="amount" name="amount">
          </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type"submit"  class="btn btn-primary">Add Cash On Hand</button>
        <img src="loader.gif" alt="" id="loader">
      </div>
    </form>
    </div>
  </div>
</div>

<main role="main" class="main-content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-12">
            <div class="row">
                <div class="col-md-10">
                    <h2 class=" page-title  text-uppercase">List Of Paiti Cash Data table</h2>
                </div>
                <div class="col-md-2">


          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Add Cash On Hand</button>

          <button type="button" id="large_btn_detail" class="btn btn-primary d-none" data-toggle="modal" data-target=".large_model_detail">Large modal</button>

          <button type="button" class="btn btn-primary d-none" id="edit_btn_model" data-toggle="modal" data-target="#exampleModal_edit" data-whatever="@mdo">update Advance</button>

          <button type="button" class="btn btn-primary d-none" id="detail_id" data-toggle="modal" data-target="#detail_modal" data-whatever="@mdo">update Advance</button>
                </div>
            </div>

            <div id="loader_stock">
                <img src="{{asset('assets/images/loader.gif')}}" alt="">
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
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Detail</th>
                        <th>Edit</th>
                        <th>Delete</th>


                      </tr>
                    </thead>
                    <tbody>
                        @php
                        $sr=0;
                        @endphp
                        @foreach ($cashonhand as $data)
                        @php
                            $sr++;
                        @endphp


                      <tr>
                        <td>{{$sr}}</td>
                        {{--  <td>{{$data->name}}</td>  --}}
                        <td>{{$data->date}}</td>
                        <td>{{$data->amount}}</td>
                          <td>  <a class="btn btn-warning" href="#" id="paiticash_detail" data-pdid="{{$data->id}}">Detail</a></td>
                          <td>  <a class="btn btn-success"  href="#" id="paiticash_edit" data-eid="{{$data->id}}">Edit</a></td>
                          <td>  <a class="btn btn-danger" href="#" id="paiticash_delete" data-id="{{$data->id}}">Delete</a></td>



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
</div>

<script src="{{asset('js/jquery.min.js')}}"></script>

<script>
    $(document).ready(function(){

        // detail


        $(document).on("click","#paiticash_detail",function(e){

            let id = $(this).attr("data-pdid");
       e.preventDefault();
       $.ajax({

        url:"{{url('cashonhand_detail')}}",
        data:{id:id},
        success:function(data){

        console.log(data);
            $("#paiti_detail_content").html(data);
            $("#detail_id").trigger("click");
        }



})

        })

  $(document).on("click","#paiticash_edit",function(e){

    e.preventDefault();

    let id = $(this).attr("data-eid");

         $.ajax({

             url:"{{url('cash_edit')}}",
             data:{id:id},
             success:function(data){

                console.log(data);
                  $("#edit_cash").html(data);
                  $("#edit_btn_model").trigger("click");
             }



         })

  })


//   update section nstart


   $("#update_cash_btn").on("click",function(e){

    let date = $("#edit_date").val();
    let amount = $("#edit_amount").val();
    let id = $("#u_id").val();
    $.ajax({

   url:"{{url('cash_update')}}",
   data:{date:date , amount:amount , id: id},
   beforeSend:function(){
$("#loader_stock").css("visibility","visible");


},
   complete:function(){
    $("#loader_stock").css("visibility","hidden");
   },
   success:function(data){

    if(data == 1){


        $(".close_update").trigger("click");
        Swal.fire(
      'PaitiCash Updated',
      '',
      'success'
    )
    location.reload();
    }

}



})


   })


//    Delete start
  $(document).on("click", "#paiticash_delete",function(e){

    let id = $(this).attr("data-id");


    Swal.fire({
  title: 'Do you want to Delete This All Expenses Deleted About this field ?',
  showDenyButton: true,
  showCancelButton: true,
  confirmButtonText: `Delete`,
  denyButtonText: `Don't Delete`,
}).then((result) => {
  /* Read more about isConfirmed, isDenied below */
  if (result.isConfirmed) {

    $.ajax({

url:"{{url('cash_delete')}}",
data:{id: id},
beforeSend:function(){
$("#loader_stock").css("visibility","visible");


},
complete:function(){
 $("#loader_stock").css("visibility","hidden");
},
success:function(data){
console.log(data);
 if(data == 1){


     Swal.fire('Deleted!', '', 'success')
     location.reload();
 }

}



})


  } else if (result.isDenied) {
    Swal.fire('Changes are not saved', '', 'info')
  }
})



  })


    });
</script>

@endsection
