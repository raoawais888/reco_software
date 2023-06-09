<?php

namespace App\Http\Controllers;

use App\Models\stockActivity;
use App\Models\branch;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StockActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $branch = branch::all();
       return view('admin.today_activity_stock',compact('branch'));
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

         $id = $request->branch;
         $branch = branch::where(['id'=>$id])->first();
         $branch_name = $branch->name;
         $branch_data = stockActivity::whereDate('created_at', Carbon::today())
         ->where(['branch_id'=>$id])
         ->with('branch','product')
         ->get();

          


         if($branch_data->count() >0){

            return view('admin.today_activity_stock_invoice',['data'=>$branch_data,'comment'=>'Current Stock Report '.$branch_name.'']);

         }else{

             return view('admin.today_activity_stock_invoice',['data'=>$branch_data,'comment'=>'Current Stock Report']);
         }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\stockActivity  $stockActivity
     * @return \Illuminate\Http\Response
     */
    public function show(stockActivity $stockActivity)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\stockActivity  $stockActivity
     * @return \Illuminate\Http\Response
     */
    public function edit(stockActivity $stockActivity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\stockActivity  $stockActivity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, stockActivity $stockActivity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\stockActivity  $stockActivity
     * @return \Illuminate\Http\Response
     */
    public function destroy(stockActivity $stockActivity)
    {
        //
    }
}
