<?php

namespace App\Http\Controllers;

use App\Models\entry;
use App\Models\category;
use App\Models\brand;
use App\Models\price;
use App\Models\product;
use App\Models\branch;
use App\Models\entity;
use Illuminate\Http\Request;

class EntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $product = product::all();
        $branch = branch::all();
        $entry = entity::orderBy('id', 'DESC')->with('category','brand','product','branch')->get();
        // dd($entry);
       return view('admin.entry.index',compact('entry','product','branch'));

    }
    public function check_stock()
    {
           $branch = branch::all();

        $entry = entry::orderBy('id', 'DESC')->with('category','brand','product','branch')->get();
        // dd($entry);
       return view('admin.check_stock',compact('entry','branch'));

    }

    // public function show_add_entry(){
    //     $entry = entity::all();
    //     $product = product::all();
    //     $branch = branch::all();

    //     return view('admin.entry.add_entry',compact('entry','product','branch'));
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function add_entry(Request $request)
    {

        $entry = entry::where(['product_id'=>$request->product_id, 'branch_id'=>$request->branch_id])->first();


             if($entry){

                $old_qty = $entry->qty;
                 $total_qty = floor($old_qty + $request->qty);
                  $entry->qty = $total_qty;
                  $entry->update();


             }else{
                $model = new entry;
                $model->product_id = $request->product_id;
                $model->date = $request->date;
                $model->branch_id = $request->branch_id;
                $model->qty = $request->qty;
                $model->save();

            }





                $entity = new entity();
                $entity->product_id = $request->product_id;
                $entity->date = $request->date;
                $entity->branch_id = $request->branch_id;
                $entity->qty = $request->qty;
                $entity->save();

                //   dd($entity->id);

                $db_entry = entity::where(['id'=> $entity->id])->with('product')->get();

                return $db_entry;

    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function edit_entry(Request $request)
    {
        $category = category::all();
        $brand = brand::all();
        $branch = branch::all();
        $product = product::all();
        $id = $request->id;
        $result = entity::where(['id'=>$id])->first();
        $output="";

        $output.="
        <form id='update_entry_from'>
        <div class='row'>
        <div class='col-md-12'>
            <div class='form-group'>
                <label for='recipient-name' class='col-form-label'>Date</label>

                 <input class='form-control' name='date' value='{$result->date}'>
                 <input type='hidden' class='form-control' name='entry_id' value='{$result->id}'>

              </div>
        </div>


         </div>
        <div class='row'>
        <div class='col-md-6'>
        <div class='form-group'>
        <label for='recipient-name' class='col-form-label'>Product Name</label>
        <select name='product_id' class='form-control'>
      ";
      foreach($product as $data){

        if($data->id == $result->product_id){
            $output.=" <option selected value='{$data->id}'>{$data->name}</option>";
        }else{
            $output.=" <option value='{$data->id}'>{$data->name}</option>";
        }

      }



$output.="
</select>

      </div>
    </div>

    <div class='col-md-6'>
    <div class='form-group'>
        <label for='recipient-name' class='col-form-label'>Qty</label>


        <input class='form-control' name='qty' value='{$result->qty}'>
      </div>


    </div>





<div class='col-md-12'>
        <div class='form-group'>
        <label for='recipient-name' class='col-form-label'>Branch Name</label>
        <select name='branch_id' class='form-control'>
      ";
      foreach($branch as $data){

        if($data->id == $result->branch_id){
            $output.=" <option selected value='{$data->id}'>{$data->name}</option>";
        }else{
            $output.=" <option value='{$data->id}'>{$data->name}</option>";
        }

      }



$output.="
</select>

      </div>
    </div>

    </div>



</form>


        ";


        return $output;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function update_entry(Request $request)
    {




        $id = $request->entry_id;
        $entity_old = entity::where('id',$id)->first();
        $branch = $entity_old->branch_id;
        $product = $entity_old->product_id;
        $qty_old = $entity_old->qty;




       $entry = entry::where(['product_id'=>$product , 'branch_id'=>$branch])->first();

        $entry_qty = $entry->qty;

        $updated_qty = floor($entry_qty  - $qty_old);
        // dd($updated_qty);
        $entry->qty = $updated_qty;
        $entry->update();







            //    update quantity check if user change the product or branch


            $update_entry = entry::where(['product_id'=>$request->product_id, 'branch_id'=>$request->branch_id])->first();
            // dd($update_entry);
                    if($update_entry == null){




                         $branch_new = $request->branch_id;
                         $new_entry = new entry();
                        $new_entry->product_id = $request->product_id;
                        $new_entry->date = $request->date;
                        $new_entry->qty = $request->qty;
                        $new_entry->branch_id = $branch_new ;
                        $new_entry->save();


                    }else{

                       $up_qty = $update_entry->qty;

                        $store_qty = floor($up_qty + $request->qty);


                        $update_entry->qty = $store_qty;

                        $update_entry->update();

                    }



            //    update quantity check if user change the product or branch



            $model = entity::find($id);
            $model->product_id = $request->product_id;
            $model->date = $request->date;
            $model->qty = $request->qty;
            $model->branch_id = $request->branch_id;
            $model->save();
            return 1;



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function remove_entry(Request $request)
    {
        $id = $request->id;

        $entity = entity::where(['id'=>$id])->first();

        $branch_id = $entity->branch_id;
        $product_id = $entity->product_id;
        $qty = $entity->qty;

         $entry = entry::where(['branch_id'=>$branch_id, 'product_id'=>$product_id])->first();

         $update_qty = $entry->qty - $qty;

         $entry->qty = $update_qty;
         $entry->update();

         entity::where(['id'=>$id])->delete();
         return 1;
    }







    public function edit_stock_delete(Request  $request){


        $bid = $request->bid;
        $id = $request->id;

        entry::where(['branch_id'=>$bid , 'id'=>$id])->delete();

        return 1;


    }


}
