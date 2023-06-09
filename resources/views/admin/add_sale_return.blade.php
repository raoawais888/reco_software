@extends('layout.master')
@section('main-content')
<button type="button" class="btn btn-primary d-none" id="show_modal_box" data-toggle="modal" data-target="#exampleModalCenter">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Purchase Return</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id='add_sale_return_from' method="POST">
        @csrf
      <div class="modal-body" id="sale_return_data">
        
      </div>
    </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="sale_return_save" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<main role="main" class="main-content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-12">
          {{-- <h2 class="page-title">Add Entry</h2> --}}

          @if(session()->get('success'))
          <script>
            Swal.fire(
            'Sale  Return Added',
            '',
            'success'
          )
          </script>
          @elseif(session()->get('error'))

          <script>
            Swal.fire(
            'invalid Bill number',
            '',
            'error'
          )
          </script>
          @endif
          <div class="row">
            <div class="col-md-12">
              <div class="card shadow mb-4">
                <div class="card-header">
                  <strong class="card-title">Sale Return</strong>
                </div>
                <div class="card-body">
                  
                    <form method="POST" id="sale_return_form" >
                        @csrf 
                        <div class="row">
                          <div class="col-md-12">
                              <div class="form-group">
                                  <label for="">Date</label>
                                  <input type="text" class="form-control" id="date" name="date" placeholder="" value="" required readonly>
                                </div>
                          </div>
                          <div class="col-md-12">
                              <div class="form-group">
                                  <label for="">Bill No</label>
                                  <input type="text" class="form-control" name="bill_number" placeholder="" value="" required>
                                </div>
                          </div>
                          
                          
                      </div>
                          
                          
              
                     
                        
                        
              
                          
                          <button type="submit"  id="sale_return_btn" class="btn btn-primary">Sale Return </button>
        <img src="loader.gif" alt="" id="loader">
              
                      </div>
                      
                      </form>
               

                </div> <!-- /.card-body -->
              </div> <!-- /.card -->
            </div> <!-- /.col -->
       </div> <!-- end section -->
        </div> <!-- /.col-12 col-lg-10 col-xl-10 -->
      </div> <!-- .row -->
    </div> <!-- .container-fluid -->
   
  </main> <!-- main -->


  <script src="{{asset('js/jquery.min.js')}}"></script>

  <script>
    $(document).ready(function(){

    
$("#sale_return_btn").on("click",function(e){
  e.preventDefault();
  let form = $("#sale_return_form").serialize();
  
$.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url:"{{url('add_sale_return_show')}}",
    type:"POST",
    data:form,
    success:function(data){
    //  console.log(data);
$("#sale_return_data").html(data);
$("#show_modal_box").trigger("click");


    }


    });


})    

$("#purchase_return_save").on("click",function(){
$("#update_purchase_from").submit();
})
$("#sale_return_save").on("click",function(){
$("#add_sale_return_from").submit();
})

// $("#sale_return_save").on("click",function(e){
//   e.preventDefault();
//   $.ajax({
//       headers: {
//         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//     },
//     url:"{{url('store_sale_return')}}",
//     type:"POST",
//     data:$("#add_sale_return_from").serialize(),
//     success:function(data){
     
//       if(data==1){
//         Swal.fire(
//             'Sale Return Added',
//             '',
//             'success'
//           )
//       }
//     }


//     });

// })


})
  </script>

@endsection


