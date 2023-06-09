<?php

namespace App\Http\Controllers;

use App\Models\quatation;
use App\Models\entry;
use App\Models\product;
use App\Models\branch;
use App\Models\brand;
use App\Models\category;
use App\Models\stockActivity;
use App\Models\price;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use PDF;

class QuatationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        $bill =  quatation::all();

        $brand = brand::all();
        $category = category::all();
        $branch = branch::all();
        $product = product::all();
        return view('admin.quotation',['bill'=>$bill,'brand'=>$brand,'category'=>$category,'branch'=>$branch,'product'=>$product]);

    }



    public function invoice_genrate(Request $request){

               $id = $request->bill;

      $result = quatation::where(['bill_number'=>$id])->get();
      return view('admin.quotation_invoice',['data'=>$result]);

    }

    public function add_quotation_show(){


        $brand = brand::all();
        $category = category::all();
        $branch = branch::all();
        $product = product::all();
        return view('admin.add_quotation',['product'=>$product,'branch'=>$branch]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function paid_bill(Request $request)
    // {
    // $id = $request->id;
    //   $model= bill::find($id);
    //   $model->status =1;
    //   $model->save();
    //   return 1;

    // }
    // public function unpaid_bill(Request $request)
    // {
    //  $id = $request->id;
    //   $model= bill::find($id);
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
    public function add_quotation(Request $request)
    {


     

      $branch=  $request->branch;
      $number = quatation::max('bill_number');



        $bill_number = 0;

        if($number){
        $bill_number = $number+1;
        }else{
          $bill_number = 1;
         }




        $name = $request->name;
        $updated_qty =0;
        foreach($name as $chek_key => $product){

            if($product== ""){
             return "error_product";
            }

            


        }




           foreach($name as $key => $data){
  // stock activity code start here


            $model = new quatation;
            $model->product_id = $data;
            $model->date = $request->date;
            $model->branch_id = $request->branch;

            if($request->discount == null){
              $model->discount = 0;
            }else{
              $model->discount = $request->discount;
            }


            if(!isset($request->discount_type)){
              $model->discount_type = "No Discount";
            }else{
              $model->discount_type = $request->discount_type;
            }



            $model->client_name = $request->client_name;
            $model->number = $request->number;
            $model->price = $request->price[$key];
            $model->qty = $request->qty[$key];
            $model->unit = $request->unit[$key];
            $model->bill_number = $bill_number;
            $model->balance = $request->balance;
            $model->status = 0;
            $model->save();

        }



      $result = quatation::where(['bill_number'=>$bill_number])->with('category','brand','branch','product')->get();

      // dd($result);
      return view('admin.quotation_invoice',['data'=>$result])->with('success','bill');


    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function generatePDF($id)
    {
        $result = bill::where(['bill_number'=>$id])->get();

        $data = [
            'data' => $result
        ];

        $pdf = PDF::loadView('admin.billPDF', $data);
        return $pdf->download($id.'bill.pdf');



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function bill_edit(Request $request)
    {


        $branch = branch::all();
        $product = product::all();
        $id = $request->id;
         $result = bill::where(['bill_number'=>$id])->with('category','branch','brand','product')->get();
         $output="";



         $loop_count = 1;


         if($result){

            $output.="



  <div class='row'>
    <div class='col-md-4'>
        <div class='form-group'>
            <label for=''>Select Date</label>
            <input type='text' class='form-control' id='date' name='date' value='{$result[0]->date}' readonly>
          </div>
    </div>

    <div class='col-md-4'>
    <div class='form-group'>
        <label for=''>Client Name</label>
        <input type='text' class='form-control' id='client' name='client_name' value='{$result[0]->client_name}' required>
      </div>
</div>
<div class='col-md-4'>
    <div class='form-group'>
       <label for=''>Client Number</label>
        <input type='number' class='form-control' id='number' name='number'required value='{$result[0]->number}'>
      </div>
</div>
</div>
";
$output.="
<div id='box'> ";
 foreach($result as $data){
    $loop_count++;

    $output.="<div class='row' id='attr_id".$loop_count."'>
        <div class='col-md-5'>
            <div class='form-group'>
                <label for=''>Product  Name</label>
                <select id='product_data'   name='name[]' class='form-control js-example-basic-single'>
        ";
            foreach($product as $cat){

             if($cat->id == $data->product_id){
                 $output.="<option selected value='{$cat->id}'> {$cat->name}</option>";

             }else{
                $output.="<option  value='{$cat->id}'> {$cat->name}</option>";
             }

            }
        $output.="
         </select>
              </div>
        </div>

        <div class='col-md-3'>

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



        <div class='col-md-2'>


    <div class='form-group'>
      <label for=''>Price</label>
        <input type='number' class='form-control' id='price' name='price[]' placeholder='price' value='{$data->price}' required>
      </div>
        </div>

        <div class='col-md-2'>
          <div class='form-group'>
              <label for=''>QTY</label>
              <input type='number' class='form-control' id='qty' name='qty[]' value='{$data->qty}'  required>
            </div>
      </div>
      <hr class='w-100' style='border-top: 2px solid #000';>







    <div class='col-md-12'><div class='form-group text-center'>
    <a class='btn btn-danger text-white remove_btn btn-sm admin-btn-main' id='".$loop_count."' ><i class='mdi mdi-minus '></i>  Remove </a></div></div>

    <hr>
    </div>

";

 }


 $output.="

 <input type='hidden' class='form-control' id='bill_id' name='bill_id' placeholder='price' value='{$data->bill_number}' required>

<div id='box_edit'></div>

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
     * @param  \App\Models\bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function update_bill(Request $request)

    {



        $name = $request->name;
        $branch = $request->branch;
        $bill = $request->bill_id;
        $sr=0;
        $old_bill_number = 0;
        // main loop for update
        foreach($name as $key =>  $data){
            $sr++;

              if($sr == 1){

               foreach($name as $check_product){
                if($check_product== ""){
                    return "error_product";
                   }
               }

            }





            //  validation loop  start


                   // check looop
                   foreach($name as $check){
                    $product_miuns = entry::where(['product_id'=> $check, 'branch_id'=>$branch])->first();
                    if($product_miuns == null){
                        $entry_modal = new entry();
                        $entry_modal->product_id = $check;
                        $entry_modal->date = $request->date;
                        $entry_modal->branch_id = $branch;
                        $entry_modal->qty = 0;
                        $entry_modal->save();
                        }


                     }




                    //  Quantity Check update bill comment code
                    // $db_qty =  $product_miuns->qty;

                    //  if($db_qty <  $request->qty[$id]){
                    //     $pro_id = $product_miuns->product_id;

                    //     $check_product = product::find($pro_id);
                    //     $name_pro = $check_product->name;
                    //      return Redirect()->back()->with(['stock'=>$name_pro]);

                    //  }

                    //  Quantity Check update bill comment code






                //  validation loop  end
               // check looop  enb



                          //  quantity add back from entry table


                      if($sr == 1){

                        $bill_qty = bill::where(['bill_number'=>$bill])->get();
                        $old_bill_number = $bill_qty[0]->bill_number;
                        foreach($bill_qty as $val =>$bill_data){

                            $db_qty_bill = $bill_data->qty;

                            $branch_bill = $bill_data->branch_id;

                            $db_product_id = $bill_data->product_id;


                            $entry_old = entry::where(['product_id'=>$db_product_id, 'branch_id'=>$branch_bill ])->first();
                            $update_qty = $db_qty_bill + $entry_old->qty;
                            $entry_old->qty = $update_qty;
                            $entry_old->update();

                        }



                      bill::where(['bill_number'=>$bill])->delete();


                      }

                          //  quantity add back from entry table end







        // quatity minus from entry tables tart

          $entry = entry::where(['product_id'=>$data, 'branch_id'=>$branch ])->first();
          $cut_qty = $entry->qty;
          $current_qty = $request->qty[$key];

          $update_current_qty = $cut_qty - $current_qty;

          $entry->qty = $update_current_qty;
          $entry->update();

         // quatity minus from entry table end




            // bill entry add


              $model = new bill();
              $model->date = $request->date;
              $model->client_name = $request->client_name;
              $model->number = $request->number;
              $model->bill_number = $old_bill_number;
              $model->discount_type = $request->discount_type;
              $model->discount = $request->discount;
              $model->branch_id = $request->branch;
              $model->unit = $request->unit[$key];
              $model->product_id = $data;
              $model->price = $request->price[$key];
              $model->qty = $request->qty[$key];
              $model->save();
             }





      $result = bill::where(['bill_number'=>$bill])->with('category','brand','branch','product')->get();

    //   dd($result);

      return view('admin.bill_invoice',['data'=>$result])->with('success','bill');


    }




    public function remove_bill(Request $request)
    {
        $id = $request->id;

        $bill = bill::where(['bill_number'=>$id])->get();

        foreach($bill as $key => $data){
            $p_id = $data->product_id;
            $branch = $data->branch_id;
            $entry = entry::where(['product_id'=>$p_id, 'branch_id'=>$branch])->first();
            $current_qty = $data->qty;
            $old_qty = $entry->qty;
            $updat_qty = $old_qty + $current_qty;
            $entry->qty = $updat_qty;
            $entry->update();

        }

         bill::where(['bill_number'=>$id])->delete();
        return 1;
    }

    public function bill_category(Request $request){


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



      public function price(Request $request){

        $price_id = $request->id;

        $product_price_result = price::where(['product_id'=>$price_id])->first();

        if($product_price_result){
        $price_product = $product_price_result->price;

          return $price_product;
        }else{
            return 0;
        }

      }


}
