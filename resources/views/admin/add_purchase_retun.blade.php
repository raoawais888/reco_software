@extends('layout.master')
@section('main-content')
    

<!-- Button trigger modal -->
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
          <span id="modal_close" aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id='update_purchase_from' method="POST">
        @csrf
      <div class="modal-body" id="purchase_return_data">
        
      </div>
    </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="purchase_return_save" class="btn btn-primary">Save changes</button>
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
            'purchase  Return Added',
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
                  <strong class="card-title">Purchase Return</strong>
                </div>
                <div class="card-body">
                  
                    <form  id="purchase_return_form">
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
                                  <label for="">Purchase No</label>
                                  <input type="text" class="form-control" name="purchase_number" placeholder="" value="" required>
                                </div>
                          </div>
                          
                          
                      </div>
                          
                          
              
                     
                        
                        
              
                          
                          <button type="submit" id="purchases_return_btn"  class="btn btn-primary">Purchase Return </button>
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

    
$("#purchases_return_btn").on("click",function(e){
  e.preventDefault();
  let form = $("#purchase_return_form").serialize();
  
$.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url:"{{url('add_purchase_return_show')}}",
    type:"POST",
    data:form,
    success:function(data){
     console.log(data);
$("#purchase_return_data").html(data);
$("#show_modal_box").trigger("click");


    }


    });


})    

$("#purchase_return_save").on("click",function(){




$.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url:"{{url('add_purchase_return_store')}}",
    type:"POST",
    data:$("#update_purchase_from").serialize(),
    success:function(data){
     if(data==1){
      Swal.fire(
      'Purchase Return  Added',
      '',
      'success'
    )
    $("#modal_close").trigger("click");
     }


    }


    });
})



})


$(document).ready(function(e){
     $(document).on("change","#category",function(e){
        let category = $(this).val();
        // alert(category);
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