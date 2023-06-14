<?php

namespace App\Http\Controllers;

use App\Models\bill;
use App\Models\entry;
use App\Models\product;
use App\Models\branch;
use App\Models\brand;
use App\Models\category;
use App\Models\stockActivity;
use App\Models\price;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Redirect;
use PDF;

class BillController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()

  {
    $bill = bill::all();

    $brand = brand::all();
    $category = category::all();
    $branch = branch::all();
    $product = product::all();
    return view('admin.bill.bill', ['bill' => $bill, 'brand' => $brand, 'category' => $category, 'branch' => $branch, 'product' => $product]);
  }



  public function invoice_genrate(Request $request)
  {

    $id = $request->bill;

    $result = bill::where(['bill_number' => $id])->get();
    return view('admin.bill_invoice', ['data' => $result]);
  }

  public function add_bill_show()
  {


    $brand = brand::all();
    $category = category::all();
    $branch = branch::all();
    $product = product::all();
    return view('admin.bill.add_bill', ['product' => $product, 'branch' => $branch]);
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
  public function add_bill(Request $request)
  {

    $branch =  $request->branch;
    $number = bill::max('bill_number');



    $bill_number = 0;

    if ($number) {
      $bill_number = $number + 1;
    } else {
      $bill_number = 1;
    }




    $name = $request->name;
    $updated_qty = 0;
    foreach ($name as $chek_key => $product) {

      if ($product == "") {
        return "error_product";
      }

      // all product check
      $product_get = product::where(['id' => $product])->first();

      $product_miuns = entry::where(['product_id' => $product, 'branch_id' => $branch])->first();
      if ($product_miuns == null) {
        $entry_modal = new entry();
        $entry_modal->product_id = $product;
        $entry_modal->date = $request->date;
        $entry_modal->branch_id = $branch;
        $entry_modal->qty = 0;
        $entry_modal->save();
      }
    }




    foreach ($name as $key => $data) {
      // stock activity code start here

      // all product check


      $check_activity = stockActivity::whereDate('created_at', Carbon::today())
        ->where(['product_id' => $data])
        ->where(['branch_id' => $branch])
        ->get();


      if ($check_activity->isEmpty()) {

        $product_activity_qty = entry::where(['product_id' => $data, 'branch_id' => $branch])->first();
        $stock_qty_active = 0;

        if ($product_activity_qty == null) {

          $stock_qty_active = 0;
        } else {
          $stock_qty_active =   $product_activity_qty->qty;
        }



        $model_stock = new stockActivity();
        $model_stock->p_qty = $stock_qty_active;
        $model_stock->branch_id = $branch;
        $model_stock->product_id = $data;
        $model_stock->save();
      }





      // stock activity code start end

      $product_miuns_qty = entry::where(['product_id' => $data, 'branch_id' => $branch])->first();
      $db_qty =  $product_miuns_qty->qty;
      $updated_qty = $db_qty -  $request->qty[$key];
      $product_miuns_qty->qty = $updated_qty;
      $product_miuns_qty->update();



      $model = new bill;
      $model->product_id = $data;
      $model->date = $request->date;
      $model->branch_id = $request->branch;

      if ($request->discount == null) {
        $model->discount = 0;
      } else {
        $model->discount = $request->discount;
      }


      if (!isset($request->discount_type)) {
        $model->discount_type = "No Discount";
      } else {
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



    $result = bill::where(['bill_number' => $bill_number])->with('category', 'brand', 'branch', 'product')->get();

    // dd($result);
    return view('admin.bill_invoice', ['data' => $result])->with('success', 'bill');
  }


  /**
   * Display the specified resource.
   *
   * @param  \App\Models\bill  $bill
   * @return \Illuminate\Http\Response
   */
  public function generatePDF($id)
  {
    $result = bill::where(['bill_number' => $id])->get();

    $data = [
      'data' => $result
    ];

    $pdf = PDF::loadView('admin.billPDF', $data);
    return $pdf->download($id . 'bill.pdf');
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
    $result = bill::where(['bill_number' => $id])->with('category', 'branch', 'brand', 'product')->get();
    $output = "";



    $loop_count = 1;


    if ($result) {

      $output .= "



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
      $output .= "
<div id='box'> ";
      foreach ($result as $data) {
        $loop_count++;

        $output .= "<div class='row' id='attr_id" . $loop_count . "'>
        <div class='col-md-5'>
            <div class='form-group'>
                <label for=''>Product  Name</label>
                <select id='product_data'   name='productName[]' class='form-control js-example-basic-single'>
        ";
        foreach ($product as $cat) {

          if ($cat->id == $data->product_id) {
            $output .= "<option selected value='{$cat->id}'> {$cat->name}</option>";
          } else {
            $output .= "<option  value='{$cat->id}'> {$cat->name}</option>";
          }
        }
        $output .= "
         </select>
              </div>
        </div>

        <div class='col-md-3'>

          <div class='form-group'>
            <label>Packing</label>
            <select name='unit[]' id='unit' class='form-control'>
            ";

        if ($data->unit == "piece") {
          $output .= "
                <option selected value='piece'>Piece</option>
                <option value='carton'>carton</option>
                <option value='dozen'>Dozen</option>
                ";
        } else if ($data->unit == "carton") {
          $output .= "
                <option  value='piece'>Piece</option>
                <option selected value='carton'>carton</option>
                <option value='dozen'>Dozen</option>
                ";
        } else if ($data->unit == "dozen") {
          $output .= "
            <option  value='piece'>Piece</option>
            <option selected value='carton'>carton</option>
            <option value='dozen'>Dozen</option>
            ";
        } else {
          $output .= "
            <option  value='piece'>Piece</option>
            <option  value='carton'>carton</option>
            <option value='dozen'>Dozen</option>
            ";
        }


        $output .= "
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
    <a class='btn btn-danger text-white remove_btn btn-sm admin-btn-main' id='" . $loop_count . "' ><i class='mdi mdi-minus '></i>  Remove </a></div></div>

    <hr>
    </div>

";
      }


      $output .= "

 <input type='hidden' class='form-control' id='bill_id' name='bill_id' placeholder='price' value='{$data->bill_number}' required>

<div id='box_edit'></div>

</div>

<div class='row'>
  <div class='col-md-12'>
    <div class='form-group d-flex align-items-center'>
    ";

      if ($result[0]->discount_type == "rupees") {
        $output .= "   <input type='checkbox'  name='discount_type' value='percent'> <span class='mx-2'> percent %</span>
        <input type='checkbox' checked name='discount_type' value='rupees' class='ml-2'> <span class='ml-1'> In Rupees</span>";
      } else {
        $output .= "   <input type='checkbox' checked  name='discount_type' value='percent'> <span class='mx-2'> percent %</span>
        <input type='checkbox'  name='discount_type' value='rupees' class='ml-2'> <span class='ml-1'> In Rupees</span>";
      }
      $output .= "

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

      foreach ($branch as $data) {

        if ($data->id == $result[0]->branch_id) {
          $output .= "<option selected value='{$data->id}'> {$data->name}</option>";
        } else {
          $output .= "<option  value='{$data->id}'> {$data->name}</option>";
        }
      }
      $output .= "
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
    $productName = $request->productName;
    $branch = $request->branch;
    $bill = $request->bill_id;
    $sr = 0;

    $old_products = [];
    $new_products = [];
    $products = bill::where('bill_number', $bill)->get('product_id');
    foreach ($products as $product) {
      array_push($old_products, $product->product_id);
    }
    foreach ($productName as $newProduct) {
      array_push($new_products, $newProduct);
    }
    $match_products = array_intersect($old_products, $new_products);
    $db_diff_products = array_diff($old_products, $match_products);
    $new_diff_products = array_diff($new_products, $old_products);

    //Update existing products starts
    if ($match_products) {
      foreach ($match_products as $key => $data) {
        $old_bill =  bill::where('product_id', $data)->first();
        $entry_old = entry::where(['product_id' => $data, 'branch_id' => $old_bill->branch_id])->first();
        $upd_qty = 0;
        if($entry_old->qty > 0){
        if ($old_bill->qty < $request->qty[$key]) {
          $upd_qty = floor($request->qty[$key] - $old_bill->qty);
          $update_qty =  floor($entry_old->qty - $upd_qty);
          $entry_old->qty = $update_qty;
          $entry_old->update();
        }
        if ($old_bill->qty > $request->qty[$key]) {
          $upd_qty = floor($old_bill->qty - $request->qty[$key]);
          $update_qty =  floor($entry_old->qty + $upd_qty);
          $entry_old->qty = $update_qty;
          $entry_old->update();
          //test
        }
      }else{

          if ($old_bill->qty < $request->qty[$key]) {
            $upd_qty = floor($request->qty[$key] - $old_bill->qty);
            $update_qty = floor($entry_old->qty - $upd_qty);
            $entry_old->qty = $update_qty;
            $entry_old->update();
          }
          if ($old_bill->qty > $request->qty[$key]) {
            $upd_qty = floor($old_bill->qty - $request->qty[$key]);
            $update_qty =  floor($entry_old->qty + $upd_qty);
            $entry_old->qty = $update_qty;
            $entry_old->update();
          }
      }
        bill::where('product_id', $data)->update([
          'unit' => $request->unit[$key],
          'price' => $request->price[$key],
          'qty' => $request->qty[$key],
          'discount_type' => $request->discount_type,
          'discount' => $request->discount,
          'branch_id' => $request->branch,
          'client_name' => $request->client_name,
          'number' => $request->number
        ]);
      }
    }
    //Update existing products end

    //Delete products from bill and increase quantity in product table start
    if ($db_diff_products) {
      foreach ($db_diff_products as $key => $product) {
        $bill_data = bill::where('product_id', $product)->first();
        $entry_old = entry::where(['product_id' => $product, 'branch_id' => $bill_data->branch_id])->first();
        $update_qty = floor($bill_data->qty + $entry_old->qty);
        $entry_old->qty = $update_qty;
        $entry_old->update();
        $bill_data->delete();
      }
    }
    //Delete products from bill and increase quantity in product table end

    // main loop for update
    foreach ($new_diff_products as $key =>  $data) {
      $sr++;
      if ($sr == 1) {
        //  validation loop  start
        foreach ($new_diff_products as $check_product) {
          if ($check_product == "") {
            return "error_product";
          }
        }
        //  validation loop end
      }

      // check if product exist
      foreach ($new_diff_products as $check) {
        $product_miuns = entry::where(['product_id' => $check, 'branch_id' => $branch])->first();
        if ($product_miuns == null) {
          $entry_modal = new entry();
          $entry_modal->product_id = $check;
          $entry_modal->date = $request->date;
          $entry_modal->branch_id = $branch;
          $entry_modal->qty = 0;
          $entry_modal->save();
        }
      }

      // quatity minus from entry tables start
      $entry = entry::where(['product_id' => $data, 'branch_id' => $branch])->first();
      $cut_qty = $entry->qty;
      $current_qty = $request->qty[$key];
      $update_current_qty = floor($cut_qty - $current_qty);
      $entry->qty = $update_current_qty;
      $entry->update();
      // quatity minus from entry table end

      // bill entry add
      $model = new bill();
      $model->date = $request->date;
      $model->client_name = $request->client_name;
      $model->number = $request->number;
      $model->bill_number = $bill;
      $model->discount_type = $request->discount_type;
      $model->discount = $request->discount;
      $model->branch_id = $request->branch;
      $model->unit = $request->unit[$key];
      $model->product_id = $data;
      $model->price = $request->price[$key];
      $model->qty = $request->qty[$key];
      $model->save();
    }
    $result = bill::where(['bill_number' => $bill])->with('category', 'brand', 'branch', 'product')->get();
    return view('admin.bill_invoice', ['data' => $result])->with('success', 'bill');
  }
  public function remove_bill(Request $request)
  {
    $id = $request->id;

    $bill = bill::where(['bill_number' => $id])->get();

    foreach ($bill as $key => $data) {
      $p_id = $data->product_id;
      $branch = $data->branch_id;
      $entry = entry::where(['product_id' => $p_id, 'branch_id' => $branch])->first();
      $current_qty = $data->qty;
      $old_qty = $entry->qty;
      $updat_qty = $old_qty + $current_qty;
      $entry->qty = $updat_qty;
      $entry->update();
    }

    bill::where(['bill_number' => $id])->delete();
    return 1;
  }

  public function bill_category(Request $request)
  {


    $category = $request->category;

    $output = "";
    $data = product::where(['category_id' => $category])->get();

    if (count($data)) {

      foreach ($data as $category) {


        $output .= "<option value='{$category->id}'>{$category->name}</option>";
      }
    } else {
      $output .= "<option> No Product Here Related This category</option>";
    }

    return  $output;
  }



  public function price(Request $request)
  {

    $price_id = $request->id;

    $product_price_result = price::where(['product_id' => $price_id])->first();

    if ($product_price_result) {
      $price_product = $product_price_result->price;

      return $price_product;
    } else {
      return 0;
    }
  }
}
