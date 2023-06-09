@php
use App\Models\price;
use App\Models\bill;
use App\Models\salary;
use App\Models\expense;
$salary = salary::all();
$expense = expense::all();
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

  .profit_section{
    justify-content: space-around;

  }
  .profit_section h2{
    font-size: 12px;
  }
  .profit_section table th{
    font-size: 12px;
  }
  h1{
    font-size: 14px;
    margin: 10px 0px;
    padding:0px;
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
    @if($data != "error")




    <div class="header">


          <div class="header_head">

          <div class="space"></div>

        <h3 style="text-transform: uppercase"> RECO LIGHTING <br>{{$comment}} </h3>
        <a href="#" class="btn btn-primary" id="print">print</a>
        <a href="{{url('dashboard')}}" class="btn btn-primary" id="save_btn"> Back</a>
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
          <h1>SALES ENTRIES</h1>
      </div>

        <div class="data">
            <table>
                <thead>
                    <tr class="dark">
                        <th>Sr#</th>

                        <th>Invoice No</th>
                        <th>Branch</th>
                        <th>G.VALUE</th>
                        <th>Discount</th>

                        <th>TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $sum=0;
                        $sr=0;
                        $total_amount = 0;
                        $profit_amount_total=0;
                    @endphp
                    @foreach ($data->unique('bill_number') as $dat )

                       @php

                       $invoice_total=0;

                       $discount_amount=0;
                       $sr++;


                     $select = bill::where(['bill_number'=>$dat->bill_number])->get();
                    foreach($select as $select_data){


                        $profit_amount = $select_data->price;



                       $profit_amount_total += $profit_amount;




                        $qty = $select_data->qty;
                        $price = $select_data->price;
                        $total = $qty*$price;
                        $invoice_total+= $total;


                         }

                         if($dat->discount_type == "percent"){

                         $discount_amount = $invoice_total*($dat->discount / 100);
                         $total_amount = $invoice_total - $discount_amount;

                         }else if($dat->discount_type == "rupees"){
                           $total_amount =   $invoice_total - $dat->discount;
                         }else{

                            $total_amount = $invoice_total - $discount_amount;
                         }

                         $sum+= $total_amount;


                       @endphp



                    <tr>
                        <td class="light">{{$sr}}</td>

                        <td class="light">{{$dat->bill_number}}</td>
                        <td class="light">{{$dat->branch->name}}</td>
                        <td class="light">{{$invoice_total}}</td>

                        @if($dat->discount_type == "rupees")
                        <td class="light"> RS {{$dat->discount}}</td>
                        @else
                        <td class="light">  {{$discount_amount}} %</td>

                        @endif


                        <td class="light">{{$total_amount}}</td>


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


                        <td class="total">Sales total</td>
                        <td class="total">{{$sum}}</td>




                </tbody>
            </table>
        </div>


        <div class="heading">
            <h1>PURCHASE ENTRIES</h1>
        </div>

        <div class="data">
            <table>
                <thead>
                    <tr class="dark">
                        <th>Sr#</th>
                        <th>Description</th>
                        <th>Qty</th>
                        <th>Invoice No</th>
                        <th>Branch</th>
                        <th>Purchase VALUE</th>
                        <th>TOTAL</th>
                    </tr>
                </thead>
                @if($purchase->count()>0)
                <tbody>

                    @php

                        $sr=0;
                        $total_amount = 0;
                        $profit_amount_total=0;
                    @endphp
                    @foreach ($purchase  as $dat )

                       @php
                       $a_sum=0;
                       $invoice_total=0;
                       $discount_amount=0;
                       $sr++;
                        $a_qty = $dat->qty;
                        $a_price = $dat->price;

                        $p_total = $a_qty*$a_price;

                        $a_sum += $p_total;
                        $profit_amount_total+= $a_sum;






                       @endphp



                    <tr>
                        <td class="light">{{$sr}}</td>
                        <td class="light">{{$dat->product->name}}</td>
                        <td class="light">{{$dat->qty}}</td>
                        <td class="light">{{$dat->bill_number}}</td>
                        <td class="light">{{$dat->branch->name}}</td>
                        <td class="light">{{$a_sum}}</td>
                        <td class="light">{{$a_sum}}</td>





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
                        <td></td>



                        <td class="total">Purchase total</td>
                        <td class="total">{{$profit_amount_total}}</td>



                </tbody>

                @else

                <tbody>
                     <tr> <td colspan="7"><h2> No Purchase Data Available  </h2> </td> </tr>

                     @php
                         $profit_amount_total = 0;
                     @endphp
                    </tbody>
                @endif

            </table>
        </div>



        <div class="heading">
            <h1>EXPENSE ENTRIES</h1>
        </div>

        <div class="data">
            <table>
                <thead>
                    <tr class="dark">
                        <th>Sr#</th>
                        <th>Date</th>
                        <th>Description</th>
                        <th>Employe Name</th>
                        <th>Amount</th>
                        <th>TOTAL</th>
                    </tr>
                </thead>
                @if($expense_today->count()>0)

                <tbody>
                    @php

                        $sr=0;
                        $total_expense = 0;
                    @endphp
                    @forelse ($expense_today as $ex )


                    @php
                    $sr++;
                    $total_expense+= $ex->price;
                    @endphp

                    <tr>

                        <td class="light">{{$sr}}</td>
                        <td class="light">{{$ex->date}}</td>
                        <td class="light">{{$ex->description}}</td>
                        <td class="light">{{$ex->employee}}</td>
                        <td class="light">{{$ex->price}}</td>
                        <td class="light">{{$ex->price}}</td>


                    </tr>

                    @empty

                    <h2>Data Not Available</h2>

                    @endforelse




                    <tr>



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



                        <td class="total">Expense total</td>
                        <td class="total">{{$total_expense}}</td>


                          @dd($total_expense);

                </tbody>

                @else

                   <tbody> <tr> <td colspan="6"> <h2>Expense Entries Not Available</h2> </td> </tr></tbody>

                   @php
                       $total_expense = 0;
                   @endphp

                @endif

            </table>
        </div>




        <div class="heading">
            <h1>NET PROFIT</h1>
        </div>



        <div class="profit_section" style="width: 92%; display:flex; margin-left:6%;">


        <div class="data" style="width: 50%; margin-left:0%;">
            <div class="profit">

                <h2>Credit</h2>

            </div>
            <table>
                <thead>
                    <tr class="dark">
                        <th>Total Purchases</th>
                        <th>Total Expenses</th>
                        <th>Total Debits</th>
                    </tr>
                </thead>
                <tbody>

                    @php
                        $total_debit = $profit_amount_total + $total_expense;
                    @endphp

                        <td>{{$profit_amount_total}}</td>
                        <td>{{$total_expense}}</td>
                        <td>{{$total_debit}}</td>



                    </tr>










                </tbody>
            </table>
        </div>


        <div class="data" style="width:15%;margin-left:2%;">
            <div class="profit">

                <h2>Debits</h2>

            </div>
            <table>
                <thead>
                    <tr class="dark">
                        <th>Total Sales</th>

                    </tr>
                </thead>
                <tbody>


                    <tr>

                        <td >{{$sum}}</td>



                    </tr>









                </tbody>
            </table>
        </div>

        <div class="data" style="width:15%;margin-left:2%;">
            <div class="profit">

                <h2>Total Profit</h2>

            </div>
            <table>
                <thead>
                    <tr class="dark">
                        <th>Total Profit</th>

                    </tr>
                </thead>
                <tbody>

               @php
                   $total_profit_net = $sum - $total_debit;
               @endphp
                    <tr>

                        <td >{{$total_profit_net}}</td>



                    </tr>









                </tbody>
            </table>
        </div>


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

@else

<script>
    alert("data Not Available");
</script>
@endif
