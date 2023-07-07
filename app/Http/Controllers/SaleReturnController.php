<?php

namespace App\Http\Controllers;

use App\Models\saleReturn;
use App\Models\bill;
use App\Models\brand;
use App\Models\product;
use App\Models\category;
use App\Models\branch;
use App\Models\entry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class saleReturnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sale = saleReturn::all();
        return view('admin.saleReturn.sale_return',['sale'=>$sale]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function invoice_bill_return($id)
    {
        $result = saleReturn::where(['bill_number'=>$id])->get();
        return view('admin.bill_invoice',['data'=>$result]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request->all());
        $brand = brand::all();
        $category = category::all();
        $product = product::all();
        $branch = branch::all();
     $output="";

        $check = saleReturn::where(['bill_number'=>$request->bill_number])->first();

        if($check){

            $output.="<h2>Bill Return Already Exists  Please Check in List</h2>";
        }else{
            $result = bill::where(['bill_number'=>$request->bill_number])->with('product')->get();

        if(count($result)){

            $output.="



            <div class='row'>
              <div class='col-md-12'>
                  <div class='form-group'>
                      <label for=''>Select Date</label>
                      <input type='text' class='form-control' id='date' name='date' value='{$result[0]->date}' readonly>
                    </div>
              </div>

          </div>
              <div class='row'>
                  <div class='col-md-6'>
                      <div class='form-group'>
                          <label for=''>Client Name</label>
                          <input type='text' class='form-control' id='client' name='client_name' value='{$result[0]->client_name}' required  readonly>
                          <input type='hidden' class='form-control' id='client' name='bill_number' value='{$result[0]->bill_number}' required>
                        </div>
                  </div>
                  <div class='col-md-6'>
                      <div class='form-group'>
                         <label for=''>Client Number</label>
                          <input type='number' class='form-control' id='number' name='number'required value='{$result[0]->number}'  readonly>
                        </div>
                  </div>
              </div>

          ";

           foreach($result as $data){
          $output.="
          <div id='box'>
              <div class='row'>



                  <div class='col-md-6'>
                  <div class='form-group'>
                  <label for=''>Select Product</label>
                    <select  id='branch' name='name[]' class='form-control'  readonly>
                   ";

                       foreach($product as $p_data){

                        if($p_data->id == $data->product_id){
                            $output.="<option selected value='{$p_data->id}'> {$p_data->name}</option>";

                        }
                       }
                   $output.="
                    </select>
                  </div>
                  </div>





                  <div class='col-md-6'>


              <div class='form-group'>
                <label for=''>Price</label>
                  <input type='number' class='form-control' id='price' name='price[]' placeholder='price' value='{$data->price}' required  readonly>

                </div>
                  </div>

                  <div class='col-md-6'>
                    <div class='form-group'>
                        <label for=''>QTY</label>
                        <input type='number' class='form-control' id='qty' name='qty[]' value='{$data->qty}'  required  readonly>
                      </div>
                </div>
                <hr class='w-100' style='border-top: 2px solid #000';>

              </div>


              <input type='hidden' class='form-control' id='bill_id' name='bill_id[]' placeholder='price' value='{$data->id}' required >

          ";

           }

           $output.="





          </div>
          <div class='row'>
            <div class='col-md-12'>
              <div class='form-group d-flex align-items-center'>
              ";

              if($result[0]->discount_type == "rupees"){
                  $output.="   <input type='checkbox'  name='discount_type' value='percent'> <span class='mx-2'> percent %</span>
                  <input type='checkbox' checked name='discount_type' value='rupees' class='ml-2'> <span class='ml-1'> In Rupees</span>";
              }else{
                  $output.="   <input type='checkbox' checked  name='discount_type' value='percent'> <span class='mx-2'> percent %</span>
                  <input type='checkbox'  name='discount_type' value='rupees' class='ml-2'> <span class='ml-1'> In Rupees</span>";
              }
              $output.="

              </div>
            </div>
          </div>
          <div class='row'>
            <div class='col-md-6'>
                <div class='form-group'>

                    <input type='number' class='form-control' id='discount' name='discount' placeholder='Discount' value='{$result[0]->discount}'  readonly>
                  </div>
            </div>
            <div class='col-md-6'>
                <div class='form-group'>
                <select   name='branch' class='form-control'  readonly>
                  ";

                      foreach($branch as $data){

                       if($data->id == $result[0]->branch_id){
                           $output.="<option selected value='{$data->id}'> {$data->name}</option>";

                       }

                      }
                  $output.="
                   </select>
                  </div>
            </div>
          </div>

          <img src='loader.gif' alt='' id='loader'>";


        }else{
            $output.="<h2>Records Not Found Incorrect Purchase Number</h2>";
        }
    }
        return $output;

    }

    public function store_sale_return(Request $request){


        $name = $request->name;
        foreach($name as $key => $data){
         $product_plus = entry::where(['product_id'=> $data , 'branch_id'=> $request->branch])->first();
         if($product_plus -> count()){
         $db_qty =  $product_plus->qty;
         $updated_qty = $db_qty +  $request->qty[$key];
         $product_plus->qty = $updated_qty;
         $product_plus->update();
          }

            $model = new saleReturn;
            $model->product_id = $data;
            $model->date = $request->date;
            $model->branch_id = $request->branch;
            $model->discount = $request->discount;
            $model->discount_type = $request->discount_type;
            $model->client_name = $request->client_name;
            $model->price = $request->price[$key];
            $model->qty = $request->qty[$key];
            $model->bill_number = $request->bill_number;
            $model->status = 0;
            $model->save();

        }

          bill::where(['bill_number'=>$request->bill_number])->delete();

        $result = saleReturn::where(['bill_number'=>$request->bill_number])->with('category','brand','branch','product')->get();

      return view('admin.bill_invoice',['data'=>$result])->with('success','bill');

    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\saleReturn  $saleReturn
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $bill = bill::all();

        return view('admin.saleReturn.index',['bill'=>$bill]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\saleReturn  $saleReturn
     * @return \Illuminate\Http\Response
     */
    public function bill_return_edit(Request $request)
    {
        $brand = brand::all();
        $category = category::all();
        $branch = branch::all();
        $id = $request->id;
         $result = saleReturn::where(['bill_number'=>$id])->with('category','branch','brand')->get();
         $output="";

         if($result){

            $output.="



  <div class='row'>
    <div class='col-md-12'>
        <div class='form-group'>
            <label for=''>Select Date</label>
            <input type='text' class='form-control' id='date' name='date' value='{$result[0]->date}' readonly>
          </div>
    </div>

</div>
    <div class='row'>
        <div class='col-md-6'>
            <div class='form-group'>
                <label for=''>Client Name</label>
                <input type='text' class='form-control' id='client' name='client_name' value='{$result[0]->client_name}' required>
              </div>
        </div>
        <div class='col-md-6'>
            <div class='form-group'>
               <label for=''>Client Number</label>
                <input type='number' class='form-control' id='number' name='number'required value='{$result[0]->number}'>
              </div>
        </div>
    </div>

";

 foreach($result as $data){
$output.="
<div id='box'>
    <div class='row'>

        <div class='col-md-6'>
            <div class='form-group'>
                <label for=''>Product  Name</label>
                <input type='text' class='form-control' id='name' name='name[]' value='{$data->name}'  required>
              </div>
        </div>




        <div class='col-md-6'>


    <div class='form-group'>
      <label for=''>Price</label>
        <input type='number' class='form-control' id='price' name='price[]' placeholder='price' value='{$data->price}' required>
      </div>
        </div>

        <div class='col-md-6'>
          <div class='form-group'>
              <label for=''>QTY</label>
              <input type='number' class='form-control' id='qty' name='qty[]' value='{$data->qty}'  required>
            </div>
      </div>
      <hr class='w-100' style='border-top: 2px solid #000';>

    </div>


    <input type='hidden' class='form-control' id='bill_id' name='bill_id[]' placeholder='price' value='{$data->id}' required>

";

 }

 $output.="





</div>
<div class='row'>
  <div class='col-md-12'>
    <div class='form-group d-flex align-items-center'>
    ";

     if($result[0]->discount_type == "rupees"){
        $output.="   <input type='checkbox'  name='discount_type' value='percent'> <span class='mx-2'> percent %</span>
        <input type='checkbox' checked name='discount_type' value='rupees' class='ml-2'> <span class='ml-1'> In Rupees</span>";
     }else{
        $output.="   <input type='checkbox' checked  name='discount_type' value='percent'> <span class='mx-2'> percent %</span>
        <input type='checkbox'  name='discount_type' value='rupees' class='ml-2'> <span class='ml-1'> In Rupees</span>";
     }
    $output.="

    </div>
  </div>
</div>
<div class='row'>
  <div class='col-md-6'>
      <div class='form-group'>

          <input type='number' class='form-control' id='discount' name='discount' placeholder='Discount' value='{$result[0]->discount}'>
        </div>
  </div>
  <div class='col-md-6'>
      <div class='form-group'>
      <select   name='branch' class='form-control'>
        ";

            foreach($branch as $data){

             if($data->id == $result[0]->branch_id){
                 $output.="<option selected value='{$data->id}'> {$data->name}</option>";

             }else{
                $output.="<option  value='{$data->id}'> {$data->name}</option>";
             }

            }
        $output.="
         </select>
        </div>
  </div>
</div>
<button type='submit' id='add_bill_btn' class='btn btn-primary'>Update</button>
<img src='loader.gif' alt='' id='loader'>";



         }

         return $output;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\saleReturn  $saleReturn
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {


           dd("ya wala");

          $bill = $request->bill_id;

             foreach($bill as $key => $id){
              $model = saleReturn::find($id);
              $model->date = $request->date;
              $model->client_name = $request->client_name;
              $model->number = $request->number;
              $model->discount_type = $request->discount_type;
              $model->discount = $request->discount;
              $model->branch_id = $request->branch;
              $model->brand_id = $request->brand[$key];
              $model->category_id = $request->category[$key];
              $model->unit = $request->unit[$key];
              $model->name = $request->name[$key];
              $model->price = $request->price[$key];
              $model->qty = $request->qty[$key];
              $model->save();
             }

             return Redirect()->back()->with('success','success');

    }


    public function remove_bill_return(Request $request)
    {
        $id = $request->id;
        saleReturn::where(['bill_number'=>$id])->delete();
        return 1;
    }


}
