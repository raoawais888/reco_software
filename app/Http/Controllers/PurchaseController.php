<?php

namespace App\Http\Controllers;

use App\Models\purchase;
use App\Models\entry;
use App\Models\product;
use App\Models\branch;
use App\Models\brand;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use PDF;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        $purchase = purchase::all();

        $brand = brand::all();
        $category = category::all();
        $branch = branch::all();
        $product = product::all();
        return view('admin.purchase',['purchase'=>$purchase,'brand'=>$brand,'category'=>$category,'branch'=>$branch,'product'=>$product]);
        // return view('admin.purchase',['purchase'=>$purchase]);
    }



    public function invoice_genrate($id){

      $result = purchase::where(['purchase_number'=>$id])->get();
      return view('admin.purchase_invoice',['data'=>$result]);

    }

    public function add_purchase_show(){

        $brand = brand::all();
        $category = category::all();
        $branch = branch::all();
        $product = product::all();
        return view('admin.add_purchase',['brand'=>$brand,'category'=>$category,'branch'=>$branch,'product'=>$product]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function paid_purchase(Request $request)
    // {
    // $id = $request->id;
    //   $model= purchase::find($id);
    //   $model->status =1;
    //   $model->save();
    //   return 1;

    // }
    // public function unpaid_purchase(Request $request)
    // {
    //  $id = $request->id;
    //   $model= purchase::find($id);
    //   $model->status =  0;
    //   $model->save();
    //   return 1;

    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add_purchase(Request $request)
    {
      $purchase_number = 0;
     $number = purchase::max('purchase_number');


      if($number){
             $purchase_number = $number+1;

      }else{
        $purchase_number = 1;
       }

        $name = $request->name;
        // dd($name[0]);
           if($name[0] === null){
            // dd("hello");
          return Redirect()->back()->with('error','error');

           }else{

            // dd("else");


        foreach($name as $key => $data){


            $model = new purchase;
            $model->product_id = $data;
            $model->date = $request->date;
            $model->branch_id = $request->branch;

            if($request->discount == null){
              $model->discount = 0;
              // dd("check");

            }else{
              // dd("else");
              $model->discount = $request->discount;
            }


            if(!isset($request->discount_type)){
              $model->discount_type = "No Discount";
            }else{
              $model->discount_type = $request->discount_type;
            }


            $model->client_name = $request->client_name;
            $model->number = $request->number;
            $model->brand_id = $request->brand[$key];
            $model->category_id = $request->category[$key];
            $model->price = $request->price[$key];
            $model->qty = $request->qty[$key];
            $model->unit = $request->unit[$key];
            $model->purchase_number = $purchase_number;
            $model->status = 0;
            $model->save();

        }



      $result = purchase::where(['purchase_number'=>$purchase_number])->with('category','brand','branch','product')->get();

      // dd($result);
      return view('admin.purchase_invoice',['data'=>$result])->with('success','purchase');


           }
    }

    public function update_purchase_status(Request $request){


          $model = purchase::where(['purchase_number'=> $request->purchase])->first();
          $model->status = 1;
          $model->save();
            return 1;

    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function generatePDF($id)
    {
        $result = purchase::where(['purchase_number'=>$id])->get();

        $data = [
            'data' => $result
        ];

        $pdf = PDF::loadView('admin.purchasePDF', $data);
        return $pdf->download($id.'purchase.pdf');



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit_purchase(Request $request)
    {
        $brand = brand::all();
        $category = category::all();
        $branch = branch::all();
        $product = product::all();
        $id = $request->id;
         $result = purchase::where(['purchase_number'=>$id])->with('category','branch','brand','product')->get();
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
                <label for=''>Purchaser Name</label>
                <input type='text' class='form-control' id='client' name='client_name' value='{$result[0]->client_name}' required>
              </div>
        </div>
        <div class='col-md-6'>
            <div class='form-group'>
               <label for=''>Purchaser Number</label>
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
          <label for=''>Select Brand</label>
            <select  id='branch' name='brand[]' class='form-control'>
           ";

               foreach($brand as $bran){

                if($bran->id == $data->brand_id){
                    $output.="<option selected value='{$bran->id}'> {$bran->brand}</option>";

                }else{
                    $output.="<option  value='{$bran->id}'> {$bran->brand}</option>";
                }

               }
           $output.="
            </select>
          </div>
    </div>

    <div class='col-md-6'>
      <div class='form-group'>
        <label for=''>Select Category</label>
        <select id='category'  name='category[]' class='form-control'>
        ";

            foreach($category as $cat){

             if($cat->id == $data->category_id){
                 $output.="<option selected value='{$cat->id}'> {$cat->category}</option>";

             }else{
                $output.="<option  value='{$cat->id}'> {$cat->category}</option>";
             }

            }
        $output.="
         </select>
        </div>
  </div>
        <div class='col-md-6'>
            <div class='form-group'>
                <label for=''>Product  Name</label>
                <select  id='product_data' name='name[]' class='form-control'>
                ";

                    foreach($product as $bran){

                     if($bran -> id == $data->product_id){
                         $output.="<option selected value='{$bran->id}'> {$bran->name}</option>";

                     }else{
                         $output.="<option  value='{$bran->id}'> {$bran->name}</option>";
                     }

                    }
                $output.="
                 </select>
              </div>
        </div>

        <div class='col-md-6'>

          <div class='form-group'>
            <label>Packing</label>
            <select name='unit[]' id='unit' class='form-control'>
            ";

            if($data->unit == "piece"){
                $output.="
                <option selected value='piece'>Piece</option>
                <option value='carton'>carton</option>
                <option value='dozen'>Dozen</option>
                ";
        }else if($data->unit == "carton"){
            $output.="
                <option  value='piece'>Piece</option>
                <option selected value='carton'>carton</option>
                <option value='dozen'>Dozen</option>
                ";
        }else if($data->unit == "dozen"){
            $output.="
            <option  value='piece'>Piece</option>
            <option selected value='carton'>carton</option>
            <option value='dozen'>Dozen</option>
            ";
        }else{
            $output.="
            <option  value='piece'>Piece</option>
            <option  value='carton'>carton</option>
            <option value='dozen'>Dozen</option>
            ";
        }


            $output.="
            </select>
          </div>
        </div>
    </div>



    <div class='row'>


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






";

 }


 $output.="

 <input type='hidden' class='form-control' id='purchase_id' name='purchase_id' placeholder='price' value='{$data->purchase_number}' required>




</div>
<div id='box_edit'></div>
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
<button type='submit' id='add_purchase_btn' class='btn btn-primary'>Update</button>
<img src='loader.gif' alt='' id='loader'>";



         }

         return $output;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update_purchase(Request $request)
    {
                //  dd($request->all());
                $purchase = $request->purchase_id;
                $brand = $request->brand;
                 purchase::where(['purchase_number'=>$purchase])->delete();
             foreach($brand as $key => $data){

              $model = new purchase();
              $model->date = $request->date;
              $model->client_name = $request->client_name;
              $model->number = $request->number;
              $model->purchase_number = $purchase;
              $model->discount_type = $request->discount_type;
              $model->discount = $request->discount;
              $model->branch_id = $request->branch;
              $model->brand_id = $data;
              $model->category_id = $request->category[$key];
              $model->unit = $request->unit[$key];
              $model->product_id = $request->name[$key];
              $model->price = $request->price[$key];
              $model->qty = $request->qty[$key];
              $model->save();
             }


      $result = purchase::where(['purchase_number'=>$purchase])->with('category','brand','branch','product')->get();

      // dd($result);
      return view('admin.purchase_invoice',['data'=>$result])->with('success','purchase');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function remove_purchase(Request $request)
    {
        $id = $request->id;
        purchase::where(['purchase_number'=>$id])->delete();
        return 1;
    }

    public function purchase_category(Request $request){


      $category = $request->category;
     $output="";
      $data = product::where(['category_id'=>$category])->get();


      if(count($data)){

            foreach( $data as $category){


              $output.="<option value='{$category->id}'>{$category->name}</option>";
            }

      }else{
          $output.="<option> No Product Here Related This category</option>";
      }

      return  $output;
  }
}
