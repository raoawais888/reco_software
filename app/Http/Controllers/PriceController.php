<?php

namespace App\Http\Controllers;

use App\Models\price;
use App\Models\category;
use App\Models\brand;
use App\Models\product;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $price = price::with('category','brand','product')->get();
        // dd($price);
        $entry = product::all();
        $brand = brand::all();
        $category = category::all();
        
        // dd($entry);
        return view('admin.price',['price'=>$price,'entry'=>$entry,'brand'=>$brand , 'category'=>$category]);
    }

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
    public function store(Request $request)
    {

        // dd($request->all());
        $model = new price;
        $model->price = $request->price;
        $model->a_price = $request->a_price;
        $model->product_id = $request->product_id;
        $model->brand_id = $request->brand;
        $model->category_id = $request->category;
     
        $model->save();
        return 1;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\price  $price
     * @return \Illuminate\Http\Response
     */
    public function show(price $price)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\price  $price
     * @return \Illuminate\Http\Response
     */
    public function edit_price(Request $request)
    {
        $entry = product::all();
        $brand = brand::all();
        $category = category::all();
        $id = $request->id;
        $result = price::where(['id'=>$id])->first();
          $output="";

          if($result){

               $output.="
               
  <div class='form-group'>
    <label for='recipient-name' class='col-form-label'>Select Brand</label>
     <select name='brand' id='product' class='form-control'>
     ";
       foreach ($brand as $data){
         if($data->id == $result->brand_id){

            $output.="<option selected value='{$data->id}'>{$data->brand}</option>";
         }else{
            $output.="<option value='{$data->id}'>{$data->brand}</option>";
         }   

        
   
       }
       $output.="
     </select>
  </div>
  <div class='form-group'>
    <label for='recipient-name' class='col-form-label'>Select Category</label>
    <select name='category' id='product' class='form-control'>
    ";
      foreach ($category as $data){
        if($data->id == $result->category_id){

           $output.="<option selected value='{$data->id}'>{$data->category}</option>";
        }else{
           $output.="<option value='{$data->id}'>{$data->category}</option>";
        }   

       
  
      }
      $output.="
    </select>
  <div class='form-group'>
    <label for='recipient-name' class='col-form-label'>Product</label>
    <select name='product_id' id='product' class='form-control'>
    ";
      foreach ($entry as $data){
        if($data->id == $result->product_id){

           $output.="<option selected value='{$data->id}'>{$data->name}</option>";
        }else{
           $output.="<option value='{$data->id}'>{$data->name}</option>";
        }   

       
  
      }
      $output.="
    </select>
  </div>
  <div class='form-group'>
    <label for='recipient-name' class='col-form-label'>Actual Price</label>
    <input type='text' class='form-control'  name='a_price' value='{$result->a_price}'>
    <input type='hidden' class='form-control'  name='price_id' value='{$result->id}'>
  </div>
  <div class='form-group'>
    <label for='recipient-name' class='col-form-label'>Sale Price</label>
    <input type='text' class='form-control' id='price' name='price' value='{$result->price}'>
  </div>
  

               
               ";



          }
    
        
      return $output;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\price  $price
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->price_id;
        $model = price::find($id);
        $model->price = $request->price;
        $model->a_price = $request->a_price;
        $model->product_id = $request->product_id;
        $model->brand_id = $request->brand;
        $model->category_id = $request->category;
     
        $model->save();
        return Redirect()->back()->with('success','success');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\price  $price
     * @return \Illuminate\Http\Response
     */
    public function remove_price(Request $request)
    {
        $id = $request->id;
        price::where(['id'=>$id])->delete();
        return 1;
    }
    // public function remove_purchase(Request $request)
    // {
    //     $id = $request->id;
    //     purchase::where(['id'=>$id])->delete();
    //     return 1;
    // }
    public function price_category(Request $request){
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
