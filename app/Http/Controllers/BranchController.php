<?php

namespace App\Http\Controllers;

use App\Models\branch;
use App\Models\bill;
use App\Models\purchase;
use App\Models\stock;
use App\Models\quatation;
use App\Models\employee;
use App\Models\entry;
use App\Models\entity;
use App\Models\purchaseReturn;
use App\Models\salary;
use App\Models\saleReturn;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branch = branch::all();
        return view('admin.branch',['branch'=>$branch]);
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

        $result = branch::where(['name'=>$request->name])->first();
        if($result){
            return 0;
        }else{
            $model = new branch;
            $model->name = $request->name;
            $model->address = $request->address;
            $model->save();
            return 1;
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('admin.add_branch');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function edit_branch(Request $request)
    {
        $id = $request->id;
        $data=branch::where(['id'=>$id])->first();

        $output="<form id='branch_update_from'>
        <div class='form-group'>
          <label for='recipient-name' class='col-form-label'>Branch</label>
          <input type='text' class='form-control' id='Branch' name='branch' value='{$data->name}'>
          <input type='hidden' class='form-control' id='' name='id' value='{$data->id}'>
        </div>
        <div class='form-group'>
          <label for='recipient-name' class='col-form-label'>Address</label>
          <input type='text' class='form-control' id='address' name='address' value='{$data->address}'>

        </div>

      </form>";
      return $output;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function update_branch(Request $request)
    {
        $id = $request->id;
        $model = branch::find($id);
        $model->name = $request->branch;
        $model-> address= $request->address;
        $model->save();
        return 1;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function remove_branch(Request $request)
    {
        $id = $request->id;

        bill::where(['brand_id'=>$id])->delete();
        purchase::where(['branch_id'=>$id])->delete();
        stock::where(['to'=>$id])->delete();
        stock::where(['from'=>$id])->delete();
        quatation::where(['branch_id'=>$id])->delete();
        employee::where(['branch_id'=>$id])->delete();
        entry::where(['branch_id'=>$id])->delete();
        entity::where(['branch_id'=>$id])->delete();
        purchaseReturn::where(['branch_id'=>$id])->delete();
        saleReturn::where(['branch_id'=>$id])->delete();
        salary::where(['branch_id'=>$id])->delete();
        branch::where(['id'=>$id])->delete();
        return 1;
    }
}
