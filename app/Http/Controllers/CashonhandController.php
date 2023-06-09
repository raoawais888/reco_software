<?php

namespace App\Http\Controllers;
use App\Models\cashonhand;
use App\Models\expense;
use App\Models\employee;
use Illuminate\Http\Request;

class CashonhandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee = employee::all();
        $cashonhand = cashonhand::all();
        return view('admin.cash',['employee'=>$employee,'cashonhand'=>$cashonhand]);
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
        $result = cashonhand::latest()->first();

           if($result){
            $amount = $result->amount;
            if($amount >0){
            $total_amount = $amount + $request->amount;
            $model = new cashonhand;
            $model->date = $request->date;
            $model->amount = $total_amount;
            $model->save();
            return Redirect()->back()->with('success','success');
            }
           }else{

            $model = new cashonhand;
            $model->date = $request->date;
            $model->amount = $request->amount;
            $model->save();
            return Redirect()->back()->with('success','success');

           }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cashonhand  $cashonhand
     * @return \Illuminate\Http\Response
     */
    public function cashonhand_detail(Request $request)
    {

        $id = $request->id;
         $expense = expense::where(['cash_id'=>$id])->get();

         $output="";
         if($expense){

                  $sr=0;
                  foreach($expense as $data){
                      $sr++;
                          $output.="
                          <tr class='text-center'>
                          <td>{$sr}</td>
                          <td>{$data->date}</td>
                          <td>{$data->employee}</td>
                          <td>{$data->price}</td>
                          <td>{$data->description}</td>
                          </tr>
                          ";

                  }
         }else{
            $output.="<h2>Detail  Information  Not  avialable </h2>";
         }


         return $output;

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cashonhand  $cashonhand
     * @return \Illuminate\Http\Response
     */
    public function cash_edit(Request $request)
    {
       $id = $request->id;

       $result = cashonhand::where(['id'=>$id])->first();



       return view('admin.cash_edit', compact('result'))->render();

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\cashonhand  $cashonhand
     * @return \Illuminate\Http\Response
     */
    public function cash_update(Request $request)
    {
        $date = $request->date;
        $amount = $request->amount;
        $id = $request->id;

        $expense = expense::where(['cash_id'=>$id])->get();

        $add = 0;
        foreach($expense as $key => $data){

           $add += $data->price;

        }

        $store_price = $amount - $add;




         $model =  cashonhand::find($id);
         $model->date = $date;
         $model->amount = $store_price;
         $model->update();
         return 1;
       }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cashonhand  $cashonhand
     * @return \Illuminate\Http\Response
     */
    public function cash_delete(Request $request)
    {
        $id = $request->id;

        expense::where(['cash_id'=>$id])->delete();
        cashonhand::where(['id'=>$id])->delete();
        return 1;
    }
}
