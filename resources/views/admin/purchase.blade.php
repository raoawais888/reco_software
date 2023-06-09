@extends('layout.master')

@section('main-content')
    
@if(session()->get('update'))


<script>
  Swal.fire(
      'Bill Updated',
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
        <div class="modal-body" id="purchase_data">
          
        </div>


        </form>
        
        <div class="col-md-12 text-center mb-2">
                                  
          <button class="btn btn-primary btn-lg" id="add_more_btn_edit">Add More  Field</button>
      </div>
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
                  <button type="button" class="btn btn-primary d-none" data-toggle="modal" data-target="#editModal" data-whatever="@mdo" id="purchase_edit_btn">btn</button>
                  <!-- table -->
                  <table class="table datatables" id="dataTable-1">
                    <thead>
                      <tr>
                        <th class="text-center">Sr #</th>
                        <th class="text-center"> Date</th>
                        <th class="text-center"> Purchaser Name</th>
                        <th class="text-center">Purchaser number</th>
                        <th class="text-center">bill Number</th>
                        {{-- <th class="text-center">Change</th> --}}
                        <th class="text-center">View</th>
                        <th class="text-center">Edit</th>
                        <th class="text-center">Remove</th>
                      </tr>
                    </thead>
                     <tbody>
                        @php
                        $sr=0;    
                        @endphp
                        @foreach ($purchase->unique('purchase_number') as $data)
                        @php
                            $sr++; 
                        @endphp
                           
                        
                      <tr>
                        <td>{{$sr}}</td>
                        <td>{{$data->date}}</td>
                        <td>{{$data->client_name}}</td>
                        <td>{{$data->number}}</td>
                        <td>{{$data->purchase_number}}</td>
                        

                        {{-- <td> <a class="btn btn-success btn-sm text-white"  id="bill_change" data-bcid="{{$data->bill_number}}">Change</a></td>
                        --}}

                        <td> <a class="btn btn-success btn-sm text-white" href="{{url('purchase_bill',[$data->purchase_number])}}" id="bill_view" data-bvid="{{$data->purchase_number}}">View</a></td>
                        <td>
                          <a class="btn btn-primary btn-sm" href="#" id="purchase_edit" data-peid="{{$data->purchase_number}}">Edit</a></td>
                        <td>
                          <a class="btn btn-danger btn-sm" href="#" id="purchase_remove" data-prid="{{$data->purchase_number}}">Remove</a></td>
                        
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

     


    


    var loop_count =1;
   $("#add_more_btn_edit").on("click",function(e){
    //  alert("click");

    let brand = '<?php  echo $brand ?>';
    let category = '<?php  echo $category ?>';
    let product = '<?php  echo $product ?>';
    console.log(brand);
e.preventDefault();

loop_count++;
   var html_data ='<div class="row" id="attr_id'+loop_count+'"> ';
    html_data +='<div class="col-md-6"><div class="form-group">';
      html_data +='<label>Select Brand</label>';
    html_data +='<select class="form-control" name="brand[]">';
     
    $.each(JSON.parse(brand) , function( key, value ){
      html_data +='<option value="'+value.id +'">'+ value.brand +'</option>';
   
});
html_data +='</select>';
html_data+='</div></div>'

    html_data +='<div class="col-md-6"><div class="form-group">';
    html_data +='<label>Select Category</label>';
    html_data +='<select class="form-control" id="category" name="category[]">';
     
    $.each(JSON.parse(category) , function( key, value ){
      html_data +='<option value="'+value.id +'">'+ value.category +'</option>';
    
});
html_data +='</select>';
html_data+='</div></div>'


    html_data +='<div class="col-md-6"><div class="form-group">';
      html_data +='<label>Product Name</label>';
      html_data +='<select id="product_data" class="form-control" name="name[]">';
     
     
       html_data +='<option value="">Select Product</option>';
  
 html_data +='</select>';
  
  html_data+='</div></div>'

   
    html_data +='  <div class="col-md-6"> <div class="form-group">';
    html_data +='  <label>Packing</label>';
    html_data +=' <select name="unit[]" id="unit" class="form-control">';
    html_data +=' <option value="piece">Piece</option>';
    html_data +=' <option value="carton">carton</option>';
    html_data +='   <option value="dozen">Dozen</option>';
    html_data +='    </select>  ';                     
  html_data+='</div></div>'


  html_data+='<div class="col-md-6"><div class="form-group">';
    html_data +='  <label>Price</label>';
  html_data+='<input type="number" class="form-control" id="price" name="price[]" required>  ';
  html_data+='</div></div>';     

  html_data+='<div class="col-md-6"><div class="form-group">';
    html_data +='  <label>QTY</label>';
  html_data+='<input type="number" class="form-control" id="qty" name="qty[]" required>';
  html_data+='</div></div>';  

  
    
              

  html_data+='<div class="col-md-12"><div class="form-group text-center">';
  html_data+='<a class="btn btn-danger text-white remove_btn admin-btn-main" id="'+loop_count+'" ><i class="mdi mdi-minus "></i>  Remove </a>';   
  html_data+='<hr>';   
  html_data+= '</div> </div>';              
                          
                      
                  

   html_data+='</div>';
   

   $("#box_edit").append(html_data);

   });

   $(document).on("click",".remove_btn",function(){

let id = $(this).attr("id");
  $("#attr_id"+id).remove();      


});


     



    });



    $(document).ready(function(e){
      $(document).on("click","#purchase_remove",function(e){

e.preventDefault();
let id = $(this).attr("data-prid");
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
  url:"{{url('remove_purchase')}}",
type:"post",
  data:{id:id},
  success:function(data){
if(data==1){
    Swal.fire(
    'Purchase Remove',
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


    });


    $(document).ready(function(e){
     $(document).on("change","#category",function(e){
        let category = $(this).val();
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



$(document).ready(function(e){


  $(document).on("click","#purchase_edit",function(e){
e.preventDefault();

let id = $(this).attr("data-peid");
// alert(id);
$.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url:"{{url('edit_purchase')}}",
    type:"post",
    data:{id:id},
    success:function(data){
$("#purchase_data").html(data);
$("#purchase_edit_btn").trigger("click");


    }


    });


})

})

    </script>
@endsection