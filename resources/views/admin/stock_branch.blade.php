
<div class="card-body">
<table class="table datatables" id="dataTable-1">
    <thead>
      <tr class="bg-primary text-white">
        <th>Sr #</th>
        <th>Name</th>
        <th>Packing</th>
        <th>QTY</th>
        <th>Branch</th>
        <th>Edit</th>
      </tr>
    </thead>
    <tbody >
        @php
            $sr=0;
        @endphp
     @foreach ($entry as $data )

     @php
     $sr++;
 @endphp

     <tr>
        <td>{{$sr}}</td>
        <td>{{$data->product->name}}</td>
        <td>{{$data->unit}}</td>
        <td id="qty_val"> {{$data->qty}}</td>
        <td>{{$data->branch->name}}</td>
        <td><a data-id="{{$data->id}}" id="stock_edit" class="text-white btn btn-primary btn-sm {{$data->id}}">Edit</a></td>
     </tr>

     @endforeach

    </tbody>
</table>
</div>



<script>
  $('#dataTable-1').DataTable(
  {
    buttons: [
    'copy', 'excel', 'pdf'
],


  });
</script>
