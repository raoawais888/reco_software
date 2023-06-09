<?php

namespace App\Http\Controllers;

use App\Models\brand;
use App\Models\entry;
use App\Models\stock;
use App\Models\bill;
use App\Models\price;
use App\Models\purchase;
use App\Models\quatation;
use App\Models\entity;
use App\Models\purchaseReturn;
use App\Models\saleReturn;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brand = brand::all();

        return view('admin.brand',['brand'=>$brand]);
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
    public function add_brand(Request $request)
    {
        $result = brand::where(['brand'=>$request->brand])->first();
        if($result){
           return 0;
        }else{
        $model = new brand;
        $model->brand = $request->brand;
        $model->save();
        return 1;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit_brand(Request $request)
    {
        $id = $request->id;
        $data = brand::where(['id'=>$id])->first();

        $output="<form id='update_from'>
        <div class='form-group'>
          <label for='recipient-name' class='col-form-label'>Brand</label>
          <input type='text' class='form-control' id='eidt_brand' name='edit_brand' value='{$data->brand}'>
          <input type='hidden' class='form-control' id='brand_id' name='brand_id' value='{$data->id}'>
        </div>

      </form>";
      return $output;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update_brand(Request $request)
    {
        $id = $request->brand_id;
        $model =brand::find($id);
        $model->brand = $request->edit_brand;
        $model->save();
        return 1;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function remove_brand(Request $request)
    {
        $id = $request->id;
        bill::where(['brand_id'=>$id])->delete();
        purchase::where(['branch_id'=>$id])->delete();
        stock::where(['to'=>$id])->delete();
        stock::where(['from'=>$id])->delete();
        quatation::where(['branch_id'=>$id])->delete();
        entry::where(['branch_id'=>$id])->delete();
        entity::where(['branch_id'=>$id])->delete();
        purchaseReturn::where(['branch_id'=>$id])->delete();
        saleReturn::where(['branch_id'=>$id])->delete();
        price::where(['brand_id'=>$id])->delete();
        brand::where(['id'=>$id])->delete();
        return 1;
    }
}
