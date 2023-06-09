<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quatation Invoice  </title>
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
    color:#000 !important;
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
    font-size:16px;
    color:#000;
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
    /* position: fixed; */
    /* bottom: 0; */
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
    font-size:16px;
    color:#000;
   text-align: center
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
    font-size:14px;
    color:#000;
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
     font-size:16px;
    color:#000;
}
.right b , .right p{
      font-size:16px;
    color:#000;
}

@media print {
 
  .header_head .btn {
    display: none;
  }
  #save_btn{
      display:none;
  }
  
  body{
      color:#000;
  }
  
  .header h3{
    margin: 0;
    color:#000 !important;
}

.header_head h3{
    margin-top:16px;
}

.left b , .left p{
       font-size:18px !important;
    color:#000;
}
.right b , .right p{
      font-size:18px !important;
    color:#000;
}
.data table tr .light{

     font-size:18px !important;
    color:#000;
}

.data table td {
    text-align: center;
    font-weight: bold;
    /* border-bottom: 1px solid #000; */
    color: #000;
    font-size: 18px !important;
}
.footer{
    font-size: 16px !important;
}

.left p {
    font-size: 18px;
    color: #000;
}


.footer {
    margin-top: 70px;
    background-color: #aec1ec;
    width: 92%;
    margin-left: 5%;
    padding: 5px;
    color: #000000;
    position: fixed;
    bottom: 0;
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


    <div class="header">
        {{-- <img src="{{asset('images/logo.png')}}" style="height: 50px ; width:50px;" alt=""> --}}

          <div class="header_head">

          <div class="space"></div>

        <h3 style="text-transform: uppercase"> RECO LIGHTING <br> Quatation Invoice </h3>
        <a href="#" class="btn btn-primary" id="print">Update And Save</a>
        <a href="{{url('bill')}}" class="btn btn-primary" id="save_btn"> Save</a>
    </div>
         {{-- <p><p>{{$data[0]->branch->name}}</p> --}}
        </p>
    </div>


      <div class="midlle">
          <div class="left">
            <b>Quatation TO</b>
            <p>{{$data[0]->client_name}}</p>
            <b>ADDRESS</b>
            <p>lahore pakistan</p>
            <b>CONTACT #</b>
            <p>{{$data[0]->number}}</p>
          </div>

          <div class="right">
            <b>Branch</b>
            <p>{{$data[0]->branch->name}}</p>
            <b>Quatation No</b>
            <p>{{$data[0]->bill_number}}</p>

            <b> Date</b>
            <p>{{ date('d/m/Y', strtotime($data[0]->date))}}</p>

          </div>

      </div>


      <div class="heading">
          <h3>ITEM LIST</h3>
      </div>

        <div class="data">
            <table>
                <thead>
                    <tr class="dark">
                        <th>Sr#</th>
                        <th>Description</th>
                        <th>Qty</th>
                        <th>Unit Price</th>
                        <th>G.VALUE</th>
                        <th>TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $sum=0;
                        $sr=0;
                    @endphp
                    @foreach ($data as $dat )
                       @php
                       $sr++;
                    $qty = $dat->qty;
                    $price = $dat->price;
                    $total = $qty*$price;
                    $sum+= $total;
                       @endphp


                    <tr>
                        <td class="light">{{$sr}}</td>
                        <td class="light">{{$dat->product->name}}</td>
                        <td class="light">{{$dat->qty}}</td>
                        <td class="light">{{$dat->price}}</td>
                        <td class="light">{{$total}}</td>
                        <td class="light">{{$total}}</td>
                    </tr>

                    @endforeach




                    <tr>

                        <td class=""></td>
                        <td class=""></td>
                        <td class=""></td>
                        <td class=""></td>
                        <td class=""></td>

                    </tr>

                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>

                        <td class="total">Sub-total</td>
                        <td class="total">{{$sum}}</td>

                    </tr>


                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>

                        @php
                        $total_amount = $sum*($data[0]->discount / 100);
                    @endphp
                          @if($data[0]->discount > 0)
                        @if($data[0]->discount_type == "rupees")
                        <td>Discount in RS {{$data[0]->discount}}</td>
                        <td class="total">{{$data[0]->discount}}</td>
                        @else
                        <td class="total">Discount  {{$data[0]->discount}} %</td>
                        <td class="total">{{$total_amount}} </td>
                        @endif

                        @endif
                    </tr>

                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>

                        <td class="total">Balance</td>
                        <td class="total">
                        @if ($data[0]->balance != null)

                              {{$data[0]->balance}}

                              @else
                              0
                        @endif
                    </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>

                        <td class="total">Total</td>

                 @if($data[0]->discount_type == "rupees")

                        <td class="total">{{$sum + $data[0]->balance - $data[0]->discount}}</td>
                        @else

                        <td class="total">{{$sum + $data[0]->balance - $total_amount}}</td>
                        @endif




                    </tr>
                </tbody>
            </table>
        </div>


      <div class="footer" style="text-align: center; font-size:13px">
        <p>مال کی واپسی اورتبدیلی 15 دن کےاندرہوگی۔
            اس کےبعدازکمپنی کی ذمہ داری نہیں ہوگی۔
        نیز روپ لائٹ/سٹل ایل ای ڈی کی واپسی/تبدیلی نہیں ہے۔
        </p>
          {{-- <b style="font-size:13px"">RECO LIGHTING</b> --}}
          <p style="font-size:13px"">{{$data[0]->branch->name}} ,LAHORE PH:04237655344</p>
      </div>

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
