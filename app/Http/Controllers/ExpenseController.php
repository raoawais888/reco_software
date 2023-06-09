<?php

namespace App\Http\Controllers;
use App\Models\expense;
use App\Models\cashonhand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expense = expense::all();
        return view('admin.expense',['expense'=>$expense]);
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
    public function add_expense(Request $request)
    {
        // $result = expense::where(['date'=>$request->date])->first();
        // if($result){
        //     $new_price = $result->price + $request->price;
        //     $result->price = $new_price;
        //     $result->update();
        // }else{
        $model = new expense;
        $model->employee = $request->employee;
        $model->price = $request->price;
        $model->cash_id = $request->cash_id;
        $model->date = $request->date;
        $model->description = $request->description;
        $model->save();

        // }

        $id = $request->cash_id;

        $cashonhand  = cashonhand::where(['id'=>$id])->first();
        if($cashonhand){
           $cashonhand_amount = $cashonhand->amount;
           $update_amount = $cashonhand_amount - $request->price;

           $update = cashonhand::find($id);
           $update->amount = $update_amount;
           $update->save();

        }

        return Redirect()->back()->with('success','success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit_expense(Request $request)
    {
          $data= expense::where(['id'=>$request->id])->first();
          $output="<form id='update_expense_from'>

          <div class='row'>
            <div class='col-md-12'>
                <div class='form-group'>

                    <input type='text' class='form-control' id='date' name='date' placeholder='Select Date' value='{$data->date}'>

                    <input type='hidden' class='form-control' id='user_id' name='expense_id' placeholder='Select Date' value='{$data->id}'>
                  </div>
            </div>
        </div>




            <div class='row'>
                <div class='col-md-6'>
                    <div class='form-group'>

                        <input type='text' class='form-control' id='name' name='employee' placeholder='Expense Type' value='{$data->employee}'>
                      </div>
                </div>

                <div class='col-md-6'>
                    <div class='form-group'>
                        <input type='text' class='form-control' id='description' name='description' placeholder='Description' value='{$data->description}'>
                      </div>
                </div>
            </div>



            <div class='row'>


                <div class='col-md-12'>


            <div class='form-group'>
                <input type='number' class='form-control' id='price' name='price' placeholder='Amount' value='{$data->price}'>
              </div>
                </div>



            </div>



        </div>
        </form>";

        return $output;



    }
    public function add_expense_show(){
        $cashonhand =cashonhand::all();
        return view('admin.add_expense',['cashonhand'=>$cashonhand]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update_expense(Request $request)
    {

         $id = $request->expense_id;
         $old_amount = expense::where(['id'=>$id])->first();
         $cash_id = $old_amount->cash_id;
         $old_price = $old_amount->price;

         $cash = cashonhand::where(['id'=>$cash_id])->first();

         $cash_price = $cash->amount;
         $update_cash = $old_price + $cash_price;

         $db_cash_store = $update_cash - $request->price;

         $cash->amount = $db_cash_store;
         $cash->update();





        $model = expense::find($id);
        $model -> date = $request->date;
        $model -> employee = $request->employee;
        $model -> price = $request->price;
        $model -> description = $request->description;
        $model->save();
        return 1;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function remove_expense(Request $request)
    {
        $id = $request->id;

        $expense =expense::where(['id'=>$id])->first();
        // dd($expense);

        if($expense){

            $expense_amount = $expense->price;
            $pid = $expense->cash_id;
            $cashonhand = cashonhand::where(['id'=>$pid])->first();
            $old_cashonhand =  $cashonhand->amount;
            $total_amount = $old_cashonhand + $expense_amount;
            $model = cashonhand::find($pid);
            $model-> amount = $total_amount;
            $model->save();


        }

        expense::find($id)->delete();
        return 1;
    }
}
