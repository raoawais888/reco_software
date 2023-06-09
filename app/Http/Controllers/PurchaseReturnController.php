<?php

namespace App\Http\Controllers;

use App\Models\purchaseReturn;
use App\Models\purchase;
use App\Models\bill;
use App\Models\category;
use App\Models\brand;
use App\Models\branch;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PurchaseReturnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchase = purchaseReturn::orderBy('id', 'DESC')->with('category','branch','brand','product')->get();
        return view('admin.purchase_return',['purchase'=>$purchase]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store_db(Request $request)
    {
        dd($request->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        // dd($request->purchase_number);
        $result = purchase::where(['purchase_number'=>$request->purchase_number])->first();
 
        // dd($result);
               $category = category::all();
        $branch = branch::all();
        $brand = brand::all();
        $product = product::all();
        $output="";
       if($result){
        $output.="
        
    <div class='row'>
        <div class='col-md-6'>
            <div class='form-group'>
                <label for='recipient-name' class='col-form-label'>Date</label>
                
                 <input class='form-control' name='P_date' value='{$result->date}'>
                 <input type='hidden' class='form-control' name='entry_id' value='{$result->id}'>
                 <input type='hidden' class='form-control' id='date' name='date' placeholder='' value='{$request->date}' required readonly>

              </div>
        </div>
        <div class='col-md-6'>
            <div class='form-group'>
                <label for='recipient-name' class='col-form-label'>Brand</label>
                <select name='brand' class='form-control'>
              ";
              foreach($brand as $data){
                
                if($data->id == $result->brand_id){
                    $output.=" <option selected value='{$data->id}'>{$data->brand}</option>";
                }else{
                    $output.=" <option value='{$data->id}'>{$data->brand}</option>";
                }

              }
       
        

        $output.="
        </select>
                
              </div>
        </div>

    </div>
    <div class='row'>
        <div class='col-md-6'>
            <div class='form-group'>
                <label for='recipient-name' class='col-form-label'>Category</label>
                <select id='category' name='category' class='form-control'>
              ";
              foreach($category as $data){
                
                if($data->id == $result->category_id){
                    $output.=" <option selected value='{$data->id}'>{$data->category}</option>";
                }else{
                    $output.=" <option value='{$data->id}'>{$data->category}</option>";
                }

              }
       
        

        $output.="
        </select>
                
              </div>
        </div>


        
        <div class='col-md-6'>
            <div class='form-group'>
                <label for='recipient-name' class='col-form-label'>Product Name</label>
                
                <select  id='product_data' name='product_id' class='form-control'>
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

       
    </div>
  
  
  
    <div class='row'>
    <div class='col-md-6'>
    <div class='form-group'>
        <label for='recipient-name' class='col-form-label'>Unit</label>
        

        <input class='form-control' name='unit' value='{$result->unit}'>
      </div>
</div>
        <div class='col-md-6'>
            <div class='form-group'>
                <label for='recipient-name' class='col-form-label'>Qty</label>
                <input type='text' class='form-control' id='qty' name='qty'  value='{$result->qty}'>
              </div>
        </div>

       
    </div>

    <div class='row'>

    <div class='col-md-6'>
    <div class='form-group'>
        <label for='recipient-name' class='col-form-label'>Price</label>
        <input type='text' class='form-control' id='price' name='price'  value='{$result->price}'>
      </div>
</div>
    <div class='col-md-6'>

            
    <div class='form-group'>
        <label for='recipient-name' class='col-form-label'>Branch</label>
        <select name='branch' class='form-control'>
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

  

        
        
        ";
            }else{
                $output.="<h2>Records Not Found Incorrect Purchase Number</h2>";
            }
        
        return $output;
      
       
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\purchaseReturn  $purchaseReturn
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $bill = bill::all();
        return view('admin.add_purchase_retun',['bill'=>$bill]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\purchaseReturn  $purchaseReturn
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $category = category::all();
        $branch = branch::all();
        $brand = brand::all();
        $product = product::all();
        $id = $request->id;
     
        $result = purchaseReturn::where(['id'=>$id])->first();
      
        $output="";
       
        $output.="
        
    <div class='row'>
        <div class='col-md-6'>
            <div class='form-group'>
                <label for='recipient-name' class='col-form-label'>Date</label>
                
                 <input class='form-control' name='date' value='{$result->date}'>
                 <input type='hidden' class='form-control' name='entry_id' value='{$result->id}'>

              </div>
        </div>
        <div class='col-md-6'>
            <div class='form-group'>
                <label for='recipient-name' class='col-form-label'>Brand</label>
                <select name='brand' class='form-control'>
              ";
              foreach($brand as $data){
                
                if($data->id == $result->brand_id){
                    $output.=" <option selected value='{$data->id}'>{$data->brand}</option>";
                }else{
                    $output.=" <option value='{$data->id}'>{$data->brand}</option>";
                }

              }
       
        

        $output.="
        </select>
                
              </div>
        </div>

    </div>
    <div class='row'>
        <div class='col-md-6'>
            <div class='form-group'>
                <label for='recipient-name' class='col-form-label'>Category</label>
                <select name='category' id='category' class='form-control'>
              ";
              foreach($category as $data){
                
                if($data->id == $result->category_id){
                    $output.=" <option selected value='{$data->id}'>{$data->category}</option>";
                }else{
                    $output.=" <option value='{$data->id}'>{$data->category}</option>";
                }

              }
       
        

        $output.="
        </select>
                
              </div>
        </div>


        
        <div class='col-md-6'>
            <div class='form-group'>
                <label for='recipient-name' class='col-form-label'>Product Name</label>
                
                <select  id='product_data' name='product_id' class='form-control'>
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

       
    </div>
  
  
  
    <div class='row'>
    <div class='col-md-6'>
    <div class='form-group'>
        <label for='recipient-name' class='col-form-label'>Unit</label>
        

        <input class='form-control' name='unit' value='{$result->unit}'>
      </div>
</div>
        <div class='col-md-6'>
            <div class='form-group'>
                <label for='recipient-name' class='col-form-label'>Qty</label>
                <input type='text' class='form-control' id='qty' name='qty'  value='{$result->qty}'>
              </div>
        </div>

       
    </div>

    <div class='row'>

    <div class='col-md-6'>
    <div class='form-group'>
        <label for='recipient-name' class='col-form-label'>Price</label>
        <input type='text' class='form-control' id='price' name='price'  value='{$result->price}'>
      </div>
</div>
    <div class='col-md-6'>

            
    <div class='form-group'>
        <label for='recipient-name' class='col-form-label'>Branch</label>
        <select name='branch' class='form-control'>
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

  

        
        
        ";

        
        return $output;
    }


    public function add_purchase_return_store(Request $request){
         
        // dd($request->all());
        $model = new purchaseReturn();
            $model->product_id = $request->product_id;
            $model->date = $request->date;
            $model->p_date = $request->P_date;
            $model->category_id = $request->category;
            $model->qty = $request->qty;
            $model->unit = $request->unit;
            $model->branch_id = $request->branch;
            $model->brand_id = $request->brand;
            $model->price = $request->price;
            $model->save();
            return 1;
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\purchaseReturn  $purchaseReturn
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, purchaseReturn $purchaseReturn)
    {
        $id = $request->entry_id; 
        $model = purchaseReturn::find($id);
            $model->product_id = $request->product_id;
            $model->date = $request->date;
            $model->category_id = $request->category;
            $model->qty = $request->qty;
            $model->unit = $request->unit;
            $model->price = $request->price;
            $model->branch_id = $request->branch;
            $model->brand_id = $request->brand;
            $model->save();
        return Redirect()->back()->with('success','success');
    }


    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\purchaseReturn  $purchaseReturn
     * @return \Illuminate\Http\Response
     */
    public function remove(Request $request)
    {
        purchaseReturn::where(['id'=>$request->id])->delete();
        return 1;
    }
}
