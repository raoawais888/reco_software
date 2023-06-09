<?php

namespace App\Http\Controllers;

use App\Models\stock;
use App\Models\entry;
use App\Models\product;
use App\Models\branch;
use App\Models\brand;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use PDF;
use SebastianBergmann\LinesOfCode\Counter;

class stockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        $stock = stock::all();

        $brand = brand::all();
        $category = category::all();
        $branch = branch::all();
        $product = entry::all();
        return view('admin.stock',['stock'=>$stock,'brand'=>$brand,'category'=>$category,'branch'=>$branch,'product'=>$product]);

      }

      public function stock_detail_show(){
        return view('admin.stocke_detail');
      }






    public function invoice_genrate($id){

      $result = stock::where(['stock_number'=>$id])->get();
      return view('admin.stock_invoice',['data'=>$result]);

    }



    public function add_stock_show(){

        $brand = brand::all();
        $category = category::all();
        $branch = branch::all();
        $product = product::all();

        $entry = entry::with('product','branch')->get();


        return view('admin.add_stock',['brand'=>$brand,'category'=>$category,'branch'=>$branch,'entry'=>$entry,'product'=>$product]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function paid_stock(Request $request)
    // {
    // $id = $request->id;
    //   $model= stock::find($id);
    //   $model->status =1;
    //   $model->save();
    //   return 1;

    // }
    // public function unpaid_stock(Request $request)
    // {
    //  $id = $request->id;
    //   $model= stock::find($id);
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



    public function add_stock(Request $request)
    {


      // dd($request->all());

      

        $to = $request->to;
        $from = $request->from;

              if($request->from === $request->to){

               return "same";

              }





       $number = stock::max('stock_number');

        $bill_number = 0;

        if($number){
         $bill_number = $number+1;
        }
         else{
          $bill_number = 1;
         }




        $name = $request->name;
        $updated_qty =0;
        foreach($name as $chek_key => $product){

            if($product== ""){

                return "error_product";
            }

              // all product check

                $product_get = product::where(['name'=>$product])->first();

                  $p_id = $product_get->id;


              $product_miuns = entry::where(['product_id'=> $p_id, 'branch_id'=>$from])->first();

             
              if($product_miuns == null){
              $check_product_name = product::find($p_id);

                 $name_product_entry = $check_product_name->name;

                 return response()->json([
                    'entry' => "entry",
                    'data'    =>$name_product_entry,
                  ]);

              }



               $db_qty =  $product_miuns->qty;

              if($db_qty <  $request->qty[$chek_key]){

                 $pro_id = $product_miuns->product_id;

                 $check_product = product::find($pro_id);

                 $name_pro = $check_product->name;


                 return response()->json([
                    'stock' => "stock",
                    'data'    =>$name_pro,
                  ]);

        }



    }





    $old_qty_array = array();
    $count = 0;
    foreach($name as $key => $data){

      $product_get_next = product::where(['name'=>$data])->first();

      $prod_id = $product_get_next->id;

      $product_miuns_pro = entry::where(['product_id'=> $prod_id, 'branch_id'=>$from])->first();

                $old_qty =  $product_miuns_pro->qty;
               $old_qty_array[$count++] = $old_qty;
                $id = $product_miuns_pro->id;
                $updated_qty = $old_qty -  $request->qty[$key];
                $modal = entry::find($id);
                $modal->qty = $updated_qty;
                $modal->save();


                //    stock add from other branch


                $product_add = entry::where(['product_id'=> $prod_id, 'branch_id'=>$to])->first();

                if($product_add == null){

                   $new  = new entry();
                   $new->product_id = $prod_id;
                   $new->date = $request->date;
                 
                   $new->unit = $request->unit[$key];
                   $new->qty = $request->qty[$key];
               
                   $new->branch_id = $to;
                   $new->product_number = 123;
                   $new->save();

                }else{

                   $old_qty_stock = $product_add->qty;
                   $current_add_sock =  $request->qty[$key];
                   $store_qty = $old_qty_stock + $current_add_sock;
                   $product_add->qty = $store_qty;
                   $product_add->save();

                }


                //    stock add from other branch


            $model = new stock;
            $model->product_id = $prod_id;
            $model->date = $request->date;
            $model->from = $request->from;
            $model->to = $request->to;
            $model->qty = $request->qty[$key];
            $model->unit = $request->unit[$key];
            $model->stock_number = $bill_number;
            $model->save();

          }



        $result = stock::where(['stock_number'=>$bill_number])->with('category','brand','branch','entry','product')->get();



        return view('admin.stock_invoice',['data'=>$result, 'old'=> $old_qty_array])->with('success','stock');


    }



    public function generatePDF($id)
    {
        $result = stock::where(['stock_number'=>$id])->get();

        $data = [
            'data' => $result
        ];

        $pdf = PDF::loadView('admin.stockPDF', $data);
        return $pdf->download($id.'stock.pdf');



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function edit_stock(Request $request)
    {


        // dd($request->all());
        $brand = brand::all();
        $category = category::all();
        $product = product::all();
        $branch = branch::all();
        $id = $request->id;

         $result = stock::where(['stock_number'=>$id])->with('category','branch','brand','product')->get();


        //  $from_name = branch::where(['id'=>$from])->first();
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
                <label for=''>stocke From</label>
                <select name='from' class='form-control'>
               ";

               foreach($branch as $data){

                if($data->id == $result[0]->from){
                  $output.="<option selected value='{$data->id}'>{$data->name}</option>";
                }else{
                  $output.="<option value='{$data->id}'>{$data->name}</option>";
                }


               }
               $output.="
               </select>
              </div>
        </div>
        <div class='col-md-6'>
        <div class='form-group'>
        <label for=''>Stocke TO</label>
        <select name='to' class='form-control'>
       ";

       foreach($branch as $data){

        if($data->id == $result[0]->to){
          $output.="<option selected value='{$data->id}'>{$data->name}</option>";
        }else{
          $output.="<option value='{$data->id}'>{$data->name}</option>";
        }


       }
       $output.="
       </select>
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
        <select id='category'   name='category[]' class='form-control'>
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
                <select name='name[]'  id='product_data' class='form-control'>
               ";

               foreach($product as $pro){

                if($pro->id == $data->product_id){
                  $output.="<option selected value='{$pro->id}'>{$pro->name}</option>";
                }else{
                  $output.="<option disabled  value='{$pro->id}'>{$pro->name}</option>";
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




        <div class='col-md-12'>
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

 <input type='hidden' class='form-control' id='stock_id' name='stock_id' placeholder='price' value='{$data->stock_number}' required>




</div>
<div id='box_edit'></div>

</div>
<button type='submit' id='add_stock_btn' class='btn btn-primary'>Update</button>
<img src='loader.gif' alt='' id='loader'>";



         }

         return $output;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\stock  $stock
     * @return \Illuminate\Http\Response
     */


    public function update_stock(Request $request)
    {



            $request->all();
            $stock_id = $request->stock_id;
            $to = $request->to;
            $from = $request->from;
            $name = $request->name;




            if($request->from === $request->to){

               return Redirect()->back()->with('same','same');



              }



              $counter =0;


            //    qty check


            foreach($name as $key => $data){

              $counter++;



            foreach($name as $key =>$check){

                $product_miuns = entry::where(['product_id'=> $check, 'branch_id'=>$from])->first();



                if($product_miuns == null){
                    return redirect()->back()->with('null','null');

                 }



                 $db_qty_old =  $product_miuns->qty;



                 if($db_qty_old <  $request->qty[$key]){

                    $pro_id = $product_miuns->product_id;

                    $check_product = product::find($pro_id);

                    $name_pro = $check_product->name;


                     return Redirect()->back()->with(['stock'=>$name_pro]);


                 }

                }







            //    qty check




               if($counter == 1){

              $stock_data  = stock::where(['stock_number'=>$stock_id])->get();




              // stock add to products back
              foreach($stock_data as $key=>$stock){



                  $product_id_stock = $stock->product_id;

                  $to_id = $stock->to;

                  $qty_stock_old = $stock->qty;
                  $from_id = $stock->from;

                  // add product


                  $entry_data  = entry::where(['product_id'=>$product_id_stock, 'branch_id'=>$to_id])->first();



                  $current_qty = $entry_data->qty;
                  $updated_qty = $current_qty - $qty_stock_old;


                    $entry_data->qty = $updated_qty;
                    $entry_data->update();



                  //   minus product

                  $entry_data_minus  = entry::where(['product_id'=>$product_id_stock, 'branch_id'=>$from_id])->first();


                  $current_qty_minus = $entry_data_minus->qty;




                  $updated_qty_minus = $current_qty_minus + $qty_stock_old;


                    $entry_data_minus->qty = $updated_qty_minus;
                    $entry_data_minus->update();

                      //   minus product





              }
                // stock add to products back

                stock::where(['stock_number'=>$stock_id])->delete();


                    }







            // $stock_data_prev  = stock::where(['stock_number'=>$stock_id])->get();
            // $old_stock_to = $stock_data_prev->to;
            // $old_stock_from = $stock_data_prev->from;


           $new_entry =  entry::where(['product_id'=>$data, 'branch_id'=>$from])->first();


             $new_entry_qty = $new_entry->qty;

             $new_qty = $request->qty[$key];

             $update_new_qty = $new_entry_qty - $new_qty;
             $new_entry->qty = $update_new_qty;
             $new_entry->update();


            $new_entry_add =  entry::where(['product_id'=>$data, 'branch_id'=>$to])->first();

                  if($new_entry_add == null){
                    $new_entry_model = new entry();
                    $new_entry_model->date = $request->date;
                    $new_entry_model->brand_id = $request->brand[$key];
                    $new_entry_model->category_id = $request->category[$key];
                    $new_entry_model->unit = $request->unit[$key];
                    $new_entry_model->product_id = $data;
                    $new_entry_model->branch_id = $to;
                    $new_entry_model->qty = $request->qty[$key];
                    $new_entry_model->save();

                  }else{

                  $new_entry_qty_add = $new_entry_add->qty;
                  $new_entry_qty_add = $request->qty[$key];
                  $update_new_qty_add = $new_entry_qty_add + $new_entry_qty_add;
                  $new_entry_add->qty = $update_new_qty_add;
                  $new_entry_add->update();
                  }









              $model = new stock();
              $model->date = $request->date;
              $model->to = $request->to;
              $model->from = $request->from;
              $model->stock_number = $stock_id;
              $model->brand_id = $request->brand[$key];
              $model->category_id = $request->category[$key];
              $model->unit = $request->unit[$key];
              $model->product_id = $data;

              $model->qty = $request->qty[$key];
              $model->save();
             }




      $result = stock::where(['stock_number'=>$stock_id])->with('category','brand','branch','entry','product')->get();

      // dd($result);
      return view('admin.stock_invoice',['data'=>$result])->with('success','stock');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function remove_stock(Request $request)
    {
        $id = $request->id;
        $stock_data  = stock::where(['stock_number'=>$id])->get();


        // stock add to products back
        foreach($stock_data as $key=>$stock){

          $product_id_stock = $stock->product_id;
          $to_id = $stock->to;
          $qty = $stock->qty;
          $from_id = $stock->from;

          // add product


          $entry_data  = entry::where(['product_id'=>$product_id_stock, 'branch_id'=>$to_id])->first();




          $current_qty = $entry_data->qty;


          $updated_qty = $current_qty - $qty;


            $entry_data->qty = $updated_qty;
            $entry_data->update();



          //   minus product

          $entry_data_minus  = entry::where(['product_id'=>$product_id_stock, 'branch_id'=>$from_id])->first();


          $current_qty_minus = $entry_data_minus->qty;




          $updated_qty_minus = $current_qty_minus + $qty;


            $entry_data_minus->qty = $updated_qty_minus;
            $entry_data_minus->update();


              //   minus product





      }
        // stock add to products back


        stock::where(['stock_number'=>$id])->delete();
        return 1;
    }

    public function stock_category(Request $request){


      $category = $request->category;
     $output="";
      $data = entry::where(['category_id'=>$category])->get();


      if(count($data)){

            foreach( $data as $category){


              $output.="<option value='{$category->id}'>{$category->name}</option>";
            }

      }else{
          $output.="<option> No Product Here Related This category</option>";
      }

      return  $output;
  }





  public function stocke_check(){


    $result = entry::with('brand','category')->get();

    return view ('admin.stock_show',['result'=>$result]);


  }

   public function show_ajax_stock(Request $request){



                $all = $request->id;


      if($all == "all_stock"){

           $entry = entry::with('category','brand','product','branch')->get();
        //    dd($entry);
           return view('admin.stock_branch',compact('entry'))->render();

      }else{
     $entry = entry::where(['branch_id'=>$request->id])->with('category','brand','product','branch')->get();



     if($entry){

        return view('admin.stock_branch',compact('entry'))->render();

     }else{

        return "<h2>No Stock Availabale in this Branch<h2>";



     }

    }



   }


       public function out_stock(){
        $entry = entry::where('qty' , '<' ,1)->with('category','brand','product','branch')->get();




        return view('admin.stock_branch',compact('entry'))->render();


       }
       public function less_stock(){
        $entry = entry::where('qty' , '<' ,11)->with('category','brand','product','branch')->get();



        return view('admin.stock_branch',compact('entry'))->render();


       }




       public function all(){
        $entry = entry::with('category','brand','product','branch')->get();



        return view('admin.stock_branch',compact('entry'))->render();


       }



       public function stock_manage(Request $request){

        $stock = entry::find($request->id);


        $output="<form id='update_from'>
        <div class='form-group'>
          <label for='recipient-name' class='col-form-label'>Category</label>
          <input type='text' class='form-control' id='qty' name='qty' value='{$stock->qty}'>
          <input type='hidden' class='form-control' id='stock_id' name='stock_id' value='{$stock->id}'>
        </div>

      </form>";
      return $output;


       }

       public function update_stock_manage(Request $request){

        $update_stock = entry::find($request->id);
        $update_stock->qty = $request->qty;
        $update_stock->update();
        return 1;
       }


}
