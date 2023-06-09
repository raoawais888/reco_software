<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\category;
use App\Models\brand;
use App\Models\stock;
use App\Models\saleReturn;
use App\Models\purchaseReturn;
use App\Models\purchase;
use App\Models\bill;
use App\Models\price;
use App\Models\entity;
use App\Models\entry;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $product = product::all();
        $category = category::all();
        $brand = brand::all();
        return view('admin.product',['product'=>$product,'category'=>$category,'brand'=>$brand]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          $check = product::where(['name'=>$request->name])->first();
          if($check){
              return 2;
          }else{
              $model = new product();
              $model->name = $request->name;
              $model->category_id = $request->category_id;
              $model->brand_id = $request->brand_id;
              $model->save();
              return 1;
          }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit_product(Request $request)
    {
        $id = $request->id;
        $brand = brand::all();
        $category = category::all();
        $data = product::where(['id'=>$id])->first();

        $output="<form id='update_from'>";
        $output .="<div class='form-group'>";
        $output .="<label for='recipient-name' class='col-form-label'>Select Brand</label>";
        $output .="<select class='form-control' id='brand_id'>";

                     foreach($brand as $item ){
                        if($item->id ==  $data->brand_id){

                           $output.="<option selected value='{$item->id}' >{$item->brand}</option>";

                        }else{
                            $output.="<option value='{$item->id}' >{$item->brand}</option>";
                        }


                     }


                     $output .="</select>
                     </div>";
        $output .="<div class='form-group'>";
        $output .="<label for='recipient-name' class='col-form-label'>Select Category</label>";
        $output .="<select class='form-control' id='category_id'>";

                     foreach($category as $item ){
                        if($item->id ==  $data->category_id){

                           $output.="<option selected value='{$item->id}' >{$item->category}</option>";

                        }else{
                            $output.="<option value='{$item->id}' >{$item->category}</option>";
                        }


                     }


                     $output .="</select>
                     </div>";

        $output .="



        <div class='form-group'>
          <label for='recipient-name' class='col-form-label'>Product Name</label>
          <input type='text' class='form-control' id='edit_product' name='edit_product' value='{$data->name}'>
          <input type='hidden' class='form-control' id='product_id' name='product_id' value='{$data->id}'>
        </div>

      </form>";
      return $output;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update_product(Request $request)
    {

        $id = $request->id;
        $model =product::find($id);
        $model->name = $request->name;
        $model->category_id = $request->category_id;
        $model->brand_id = $request->brand_id;
        $model->save();
        return 1;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function product_remove(Request $request)
    {


        $id = $request->id;
       product::find($request->id)->delete();
       stock::where(['product_id'=>$id])->delete();
       saleReturn::where(['product_id'=>$id])->delete();
       purchaseReturn::where(['product_id'=>$id])->delete();
       purchase::where(['product_id'=>$id])->delete();
       bill::where(['product_id'=>$id])->delete();
       price::where(['product_id'=>$id])->delete();
       entry::where(['product_id'=>$id])->delete();
       entity::where(['product_id'=>$id])->delete();
       return 1;


    }
}
