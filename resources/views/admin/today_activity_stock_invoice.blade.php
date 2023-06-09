@php
use App\Models\bill;
use App\Models\entry;
use Carbon\Carbon;
@endphp



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sale Report  </title>
    <style>
.header{
    width: 100%;
      /* background-color: green; */
      /* paddin: auto; */
      text-align: center;
      text-transform: uppercase;
      border-bottom: 2px solid #000;
}

.total{
    font-size:13px;
}
.header img{
    width: 90%;
    height: 70px;
    margin-left: 5% !important;
}
.header h3{
    margin: 0;
}
.midlle{
    /* width: 100%; background-color: green; */
    margin-top: 10px;
    display: flex;
    justify-content: space-between;
}

.left{
    margin-left: 6% !important;
    width: 30%;
    /* background-color: red; */

}
b{
    margin: 0;
    padding: 0;
}
p{
    padding: 0 !important;
    margin: 5px 0px  !important;
}
.heading h3{
    margin-top:0px;
    margin-bottom:0px;
    font-size:13px;
}
.right{

    /* background-color: rgb(228, 162, 138); */
    text-align: right;
    margin-right: 30px;
}
.heading,.text,.note{
    margin-left: 6%;
}
.text{
   margin-top: 10px;

}
.footer{
    margin-top: 70px;
    background-color: #aec1ec;
    width: 92%;
    margin-left: 5%;
    padding: 5px;
    color: #000000;
    position: fixed;
    bottom: 0;
}
.data{
    width: 92%;
    margin-left: 6%;

}
.data table{
    width: 100%;
}
.data table th{
    /* background-color: #3867d6; */
    color: #000000;
    padding:5px;
    border-bottom: 1px solid #000;
    font-size:13px;

}

.data table td{
    text-align: center;
    font-weight: bold;
    /* border-bottom: 1px solid #000; */

}


.dark{
    background-color: #87a6ee;
    /* color: #fff; */

}
.data table tr{
    border-bottom: 1px solid #000;
}
.data table tr .light{
    border-bottom: 1px solid #000;
    font-size: 10px;
}
.data table{
    border-collapse: unset;
    border-spacing: 0;
}
.header_head{
    display: flex;
   align-items: center;


}
.header_head .btn{

 background-color: #3867d6;
 text-decoration: none;
 padding: 10px;
 color: #fff;
 margin: 0px 10px;

 /* margin-left: 200px; */
 /* border-radius: 20px; */
}
.data table{
    border: 2px solid #000000;
}

.space{
    width: 25%;
}
.header_head h3{
    width: 50%;
    margin-top:12px;
}

.left b , .left p{
    font-size:12px;
}
.right b , .right p{
    font-size:12px;
}

@media print {
  /* styling goes here */
  .header_head .btn {
    display: none;
  }
  #save_btn{
      display:none;
  }
}
    </style>


</head>
<body>

    @if(session()->get('bill'))

    <script>
        window.print();
    </script>

    @endif
    @if($data->count()>0)




    <div class="header">
        {{-- <img src="{{asset('images/logo.png')}}" style="height: 50px ; width:50px;" alt=""> --}}

          <div class="header_head">

          <div class="space"></div>

        <h3 style="text-transform: uppercase"> RECO LIGHTING <br>{{$comment}} </h3>
        <a href="#" class="btn btn-primary" id="print">print</a>
        <a href="{{url('sale')}}" class="btn btn-primary" id="save_btn"> Back</a>
    </div>
         {{-- <p><p>{{$data[0]->branch->name}}</p> --}}
        </p>
    </div>


      {{-- <div class="midlle">
          <div class="left">
            <b>Bill TO</b>
            <p>{{$data[0]->client_name}}</p>
            <b>ADDRESS</b>
            <p>lahore pakistan</p>
            <b>CONTACT #</b>
            <p>{{$data[0]->number}}</p>
          </div>

          <div class="right">
            <b>Branch</b>
            <p>{{$data[0]->branch->name}}</p>
            <b>Invoice No</b>
            <p>{{$data[0]->purchase_number}}</p>

            <b> Date</b>
            <p>{{$data[0]->date}}</p>

          </div>

      </div>
 --}}

      <div class="heading">
          <h3>ITEM LIST</h3>
      </div>

        <div class="data">
            <table>
                <thead>
                    <tr class="dark">
                        <th>Sr#</th>
                        <th>Product Name</th>
                        <th>Previous Stock</th>
                        <!--<th>Sale Stock </th>-->
                        <th>Remaining Stock</th>
                    </tr>
                </thead>
                <tbody>
                    @php

                        $sr=0;
                        $sale_qty = 0;

                    @endphp
                    @foreach ($data as $dat )

                       @php
                       $sr++;

                        $bill = bill::whereDate('created_at', Carbon::today())
                       ->where(['branch_id'=>$dat->branch_id])
                       ->where(['product_id'=>$dat->product_id])
                       ->get();


                       $entry = entry::where(['branch_id'=>$dat->branch_id])
                       ->where(['product_id'=>$dat->product_id])
                       ->first();

                          $remaining_qty = $entry->qty;



                          foreach($bill as $data_b){
                            $sale_qty += $data_b->qty;
                          }



                       @endphp



                    <tr>
                        <td class="light">{{$sr}}</td>
                        <td class="light">{{$dat->product->name}}</td>
                        <td class="light">{{$dat->p_qty}}</td>
                        <!--<td class="light"> {{$sale_qty}}  </td>-->
                        <td class="light"> {{$remaining_qty}}  </td>

                    </tr>

                    @endforeach








                </tbody>
            </table>
        </div>


      {{-- <div class="footer" style="text-align: center;">
          <b>RECO LIGHTING</b>
          <p>{{$data[0]->branch->name}} ,LAHORE PH:04237655344</p>
      </div>  --}}

      <script src="{{asset('js/jquery.min.js')}}"></script>

      <script>
          $(document).ready(function(){
          $("#print").on("click",function(e){
            window.print();
          });

           $("#bill_status_update").on("click",function(e){
               e.preventDefault();
            let bill = $(this).attr("data-bill");

            $.ajax({
             url:"{{url('update_bill_status')}}",
             type:"get",
             data:{bill:bill},
             success:function(data){
               if(data==1){
                window.print();
               }

             }


            });

           });


          });
      </script>

</body>
</html>

@else

<script>
    alert("data Not Available");
</script>
@endif
