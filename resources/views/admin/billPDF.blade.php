<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sale Invoice </title>
    <style>
.header{
    width: 100%;
      /* background-color: green; */
      paddin: auto;
      text-align: center;
      text-transform: uppercase;
      border-bottom: 2px solid #000;
}

.header img{
    width: 90%;
    height: 70px;
    margin-left: 5% !important;
}
.midlle{
    /* width: 100%; background-color: green; */
    margin-top: 30px;
    display: flex;
    justify-content: space-between;
}

.left{
    margin-left: 6% !important;
    width: 49%;
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
    margin-top: 150px;
    background-color: #3867d6;
    width: 90%;
    margin-left: 5%;
    padding: 5px;

    color: #fff;
}
.data{
    width: 90%;
    margin-left: 6%;
    
}
.data table{
    width: 100%;
}
.data table th{
    background-color: #3867d6;
    color: #fff;
    padding:5px;
}

.data table td{
    text-align: center;
    font-weight: bold;
}

.light{
    background-color: #e3edf5;
    padding: 5px;
}
.dark{
    background-color: #3867d6;
    color: #fff;

}

    </style>
</head>
<body>

    <div class="header" style="margin-bottom: 20px;">
        {{-- <img src="{{asset('images/logo.png')}}" style="height: 50px ; width:50px;" alt=""> --}}

         <h2>RECO LIGHTING</h2>
         <p>SHOP 14, MADINA MARKET SHAH ALAM CHOWK,LAHORE PH:04237655346
        </p>
    </div>
   

      <div class="midlle">
          <div class="left">
            <b>Bill TO</b>
            <p>User Agent</p>
            <b>ADDRESS</b>
            <p>lahore pakistan</p>
            <b>CONTACT #</b>
            <p>09004040</p>
          </div>
          <div class="right">

            <b>Invoice</b>
            <p>{{$data[0]->bill_number}}</p>

            <b> Date</b>
            <p>{{$data[0]->date}}</p>

            
            <b>SALEMAN</b>
            <p>user Agent</p>
            <b>MODE:</b>
            <p>CASH</p>
          </div>
          
      </div>


      <div class="heading">
          <h3>ITEM LIST</h3>
      </div>
     
        <div class="data">
            <table>
                <thead>
                    <tr>
                        <th>Sr#</th>
                        <th>Description</th>
                        <th>UOM</th>
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
                        <td class="light">{{$dat->description}}</td>
                        <td class="light">PCS</td>
                        <td class="light">{{$dat->qty}}</td>
                        <td class="light">{{$dat->price}}</td>
                        <td class="light">{{$total}}</td>
                        <td class="light">{{$total}}</td>
                        
                        
                    </tr>

                    @endforeach




                    <tr>
                      
                        <td class="dark"></td>
                        <td class="dark"></td>
                        <td class="dark"></td>
                        <td class="dark"></td>
                        <td class="dark"></td>
                        <td class="dark"></td>
                        
                    </tr>
                    
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Sub-total</td>
                        <td class="dark">{{$sum}}</td>
                        
                    </tr>

                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Discount</td>
                        <td class="dark">{{$data[0]->discount}}</td>
                        
                    </tr>

                    
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Total</td>
                        <td class="dark">{{$sum - $data[0]->discount}}</td>
                    


                    </tr>
                </tbody>
            </table>
        </div>

   
      <div class="footer">
          <b>RECO LIGHTING (2020-01-06)</b>
          <p>SHOP 14, MADINA MARKET SHAH ALAM CHOWK,LAHORE PH:04237655346</p>
      </div> 

</body>
</html>