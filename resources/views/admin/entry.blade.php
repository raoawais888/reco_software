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






<main role="main" class="main-content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-12">
            <div class="row">
                <div class="col-md-10">
                    <h2 class=" page-title text-uppercase">List Of Entry Data table</h2>
                </div>
                <div class="col-md-2">



          <button type="button" class="btn btn-primary d-none" data-toggle="modal" data-target="#editModal" data-whatever="@mdo" id="edit_btn_entry"></button>
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
                        <th>Serial Number</th>
                        <th>Date</th>
                        <th>Name</th>
                        <th>category</th>
                        <th>Packing</th>
                        <th>QTY</th>
                        <th>Edit</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php
                        $sr=0;
                        @endphp
                        @foreach ($entry as $data)
                        @php
                            $sr++;

                        @endphp


                      <tr >
                        <td>{{$sr}}</td>
                        <td>{{$data->product_number}}</td>
                        <td>{{$data->date}}</td>
                        <td>{{$data->product->name}}</td>
                        <td>{{$data->category->category}}</td>
                        <!--<td>{{$data->brand->brand}}</td>-->
                        <td>{{$data->unit}}</td>
                        <td>{{$data->qty}}</td>
                        <td><a class="btn btn-success" href="#" id="entry_edit" data-eeid="{{$data->id}}">Edit</a></td>
                        <td><a class="btn btn-danger" href="#" id="entry_remove" data-erid="{{$data->id}}">Remove</a>
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

@endsection
