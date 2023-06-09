<?php

namespace App\Http\Controllers;

use App\Models\accounttype;
use Illuminate\Http\Request;

class AccounttypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $account_type= accounttype::all();
        return view('admin.view_account_type',['account_type'=>$account_type]);

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
        $model = new accounttype;
        $model->name = $request->name;
        $model->save();
        return 1;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\accounttype  $accounttype
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('admin.account_type');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\accounttype  $accounttype
     * @return \Illuminate\Http\Response
     */
    public function edit_account_type(Request $request)
    {
        $id = $request->id;
        $data=accounttype::where(['id'=>$id])->first();

        $output="<form id='account_type_update_from'>
        <div class='form-group'>
          <label for='recipient-name' class='col-form-label'>Branch</label>
          <input type='text' class='form-control' id='Branch' name='branch' value='{$data->name}'>
          <input type='hidden' class='form-control' id='' name='id' value='{$data->id}'>
        </div>
        
      </form>";
      return $output;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\accounttype  $accounttype
     * @return \Illuminate\Http\Response
     */
    public function account_type_update(Request $request)
    {
        $id = $request->id;
        $model = accounttype::find($id);
        $model->name = $request->branch;
        $model->save();
        return 1;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\accounttype  $accounttype
     * @return \Illuminate\Http\Response
     */
    public function remove_account_type(Request $request)
    {
        $id = $request->id;
        accounttype::where(['id'=>$id])->delete();
        return 1;
    }
}
