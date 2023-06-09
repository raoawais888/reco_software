<?php

namespace App\Http\Controllers;

use App\Models\report;
use App\Models\bill;
use App\Models\product;
use App\Models\expense;
use App\Models\purchase;
use App\Models\salary;
use App\Models\branch;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class Reportshop2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //  views all show controller start

    public function index()
    {
        return view('admin.report');
    }
    public function sale_show()
    {
        return view('admin.sale_report');
    }
    public function purchase_show()
    {
        return view('admin.purchase_report');
    }
    public function profit_show()
    {
        return view('admin.profit_report');
    }
    public function sale_report_view()
    {
        $branch = branch::all();
        return view('admin.sale_report_invoice_shop2',compact('branch'));
    }
    public function purchase_report_view()
    {
        return view('admin.purchase_invoice_report');
    }



       //  views all show controller start

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    //  Manlually sale report start

    public function sale_report_store(Request $request)
    {
        // branch name get

        $branch = branch::where(['id'=>$request->branch])->first();
        $branch_name = $branch->name;

        $start = $request->start;
        $end = $request->end;

$dateS = new Carbon($request->start);
$dateE = new Carbon($request->end);
$result = bill::where(['branch_id'=>$request->branch])->whereBetween('created_at', [$dateS->format('Y-m-d')." 00:00:00", $dateE->format('Y-m-d')." 23:59:59"])->get();



if($result->count()>0){

    return view('admin.report_view_invoice',['data'=>$result,'comment'=>'Sales Report Genrate '.$branch_name.'  '.$start.' Between '.$end.'']);

}else{
    return view('admin.report_view_invoice',['data'=>$result,'comment'=>' Today Sales Report ']);
}
    }


//  Manlually sale report end




    public function purchase_report_store(Request $request)
    {
        $start = $request->start;
        $end = $request->end;

$dateS = new Carbon($request->start);
$dateE = new Carbon($request->end);
$result = purchase::whereBetween('created_at', [$dateS->format('Y-m-d')." 00:00:00", $dateE->format('Y-m-d')." 23:59:59"])->get();

if($result->count()>0){

    return view('admin.purchase_report_view',['data'=>$result,'comment'=>'Purchase Report Genrate  '.$start.' Between '.$end.'']);

}else{
    return view('admin.purchase_report_view',['data'=>$result,'comment'=>' Today Sales Report']);
}
    }


    public function purchase_report_invoice_store(Request $request)
    {
        $start = $request->start;
        $end = $request->end;

$dateS = new Carbon($request->start);
$dateE = new Carbon($request->end);
$result = purchase::whereBetween('created_at', [$dateS->format('Y-m-d')." 00:00:00", $dateE->format('Y-m-d')." 23:59:59"])->get();

if($result->count()>0){

    return view('admin.purchase_report_view_invoice',['data'=>$result,'comment'=>'Purchase Report Genrate  '.$start.' Between '.$end.'']);

}else{
    return view('admin.purchase_report_view_invoice',['data'=>$result,'comment'=>' Today Sales Report']);
}
    }














    // purchase reports start


    public function purchase_today()
    {
        // day report
        $day = purchase::whereDate('created_at', Carbon::today())->with('branch','product')->get();

        if($day->count() >0){

           return view('admin.purchase_report_view',['data'=>$day,'comment'=>' Today Purchase Report']);

        }else{
            // dd("error");
            return view('admin.purchase_report_view',['data'=>$day,'comment'=>' Today Purchase Report']);
        }
    }
    public function purchase_report_day()
    {
        // day report
        $day = purchase::whereDate('created_at', Carbon::today())->with('branch','product')->get();

        if($day->count() >0){

           return view('admin.purchase_report_view_invoice',['data'=>$day,'comment'=>' Today Purchase Report']);

        }else{
            // dd("error");
            return view('admin.purchase_report_view_invoice',['data'=>$day,'comment'=>' Today Purchase Report']);
        }
    }




    public function purchase_week()
    {

        // weekly report
        $weekly = purchase::where( 'created_at', '>', Carbon::now()->subDays(7))
        ->with('branch','product')->get();
        if($weekly->count() >0){

           return view('admin.purchase_report_view',['data'=>$weekly,'comment'=>'Current Week purchase Report']);

        }else{
            // dd("error");
            return view('admin.purchase_report_view',['data'=>$weekly,'comment'=>'Current Week purchase Report']);
        }
    }

    public function purchase_report_week()
    {

        // weekly report
        $weekly = purchase::where( 'created_at', '>', Carbon::now()->subDays(7))
        ->with('branch','product')->get();
        if($weekly->count() >0){

           return view('admin.purchase_report_view_invoice',['data'=>$weekly,'comment'=>'Current Week purchase Report']);

        }else{
            // dd("error");
            return view('admin.purchase_report_view_invoice',['data'=>$weekly,'comment'=>'Current Week purchase Report']);
        }
    }



    public function purchase_month()
    {

      // Mothly report

      $month = purchase::whereMonth('created_at', date('m'))
      ->whereYear('created_at', date('Y'))
      ->with('branch','product')
      ->get();

        if($month->count() >0){

           return view('admin.purchase_report_view',['data'=>$month,'comment'=>'Current Month purchase Report']);

        }else{
            // dd("error");
            return view('admin.purchase_report_view',['data'=>$month,'comment'=>'Current Month purchase Report']);
        }
    }
    public function purchase_report_month()
    {

      // Mothly report

      $month = purchase::whereMonth('created_at', date('m'))
      ->whereYear('created_at', date('Y'))
      ->with('branch','product')
      ->get();

        if($month->count() >0){

           return view('admin.purchase_report_view_invoice',['data'=>$month,'comment'=>'Current Month purchase Report']);

        }else{
            // dd("error");
            return view('admin.purchase_report_view_invoice',['data'=>$month,'comment'=>'Current Month purchase Report']);
        }
    }


    public function purchase_year()
    {

      // Mothly report

    //   $year = bill::whereYear('created_at', date('y'))->get();
    $year = purchase::whereYear('created_at', '=', date('Y'))
    ->with('branch','product')
    ->get();



        if($year->count() >0){

           return view('admin.purchase_report_view',['data'=>$year,'comment'=>'Current Year Purchase Report']);

        }else{
            // dd("error");
            return view('admin.purchase_report_view',['data'=>$year,'comment'=>'Current Year Purchase Report']);
        }
    }
    public function purchase_report_year()
    {

      // Mothly report

    //   $year = bill::whereYear('created_at', date('y'))->get();
    $year = purchase::whereYear('created_at', '=', date('Y'))
    ->with('branch','product')
    ->get();



        if($year->count() >0){

           return view('admin.purchase_report_view_invoice',['data'=>$year,'comment'=>'Current Year Purchase Report']);

        }else{
            // dd("error");
            return view('admin.purchase_report_view_invoice',['data'=>$year,'comment'=>'Current Year Purchase Report']);
        }
    }







    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\report  $report
     * @return \Illuminate\Http\Response
     */
    public function profit_month()
    {
        $month = bill::whereMonth('created_at', date('m'))
        ->whereYear('created_at', date('Y'))
        ->with('branch','product')
        ->get();

        $month_expense = expense::whereMonth('created_at', date('m'))
        ->whereYear('created_at', date('Y'))
        ->get();

        $salary = salary::whereMonth('created_at', date('m'))
        ->whereYear('created_at', date('Y'))
        ->with('branch', 'employee')
        ->get();






        if($month->count() >0){

            return view('admin.profit_invoice',['data'=>$month,'expense'=>$month_expense,'salary'=>$salary ,'comment'=>'Current Month Profit Report']);

         }else{
             // dd("error");
             return view('admin.profit_invoice',['data'=>'No Data Available' ,'comment'=>'No data available']);
         }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\report  $report
     * @return \Illuminate\Http\Response
     */
    public function profit_year()
    {
        $year = bill::whereYear('created_at', date('Y'))
        ->with('branch','product')
        ->get();



        $year_expense = expense::whereYear('created_at', date('Y'))
        ->get();

        $salary = salary::whereYear('created_at', date('Y'))
        ->with('branch', 'employee')
        ->get();






        if($year->count() >0){

            return view('admin.profit_invoice',['data'=>$year,'expense'=>$year_expense,'salary'=>$salary ,'comment'=>'Current Month Profit Report']);

         }else{
             // dd("error");
             return view('admin.profit_invoice',['data'=>'No Data Available' ,'comment'=>'No data available']);
         }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\report  $report
     * @return \Illuminate\Http\Response
     */
    public function profit_store(Request $request)
    {


        $start = $request->start;
        $end = $request->end;



$dateS = new Carbon($request->start);
$dateE = new Carbon($request->end);
$result = bill::whereBetween('created_at', [$dateS->format('Y-m-d')." 00:00:00", $dateE->format('Y-m-d')." 23:59:59"])
->with('branch','product')
->get();

$expense = expense::whereBetween('created_at', [$dateS->format('Y-m-d')." 00:00:00", $dateE->format('Y-m-d')." 23:59:59"])->get();

$salary = salary::whereBetween('created_at', [$dateS->format('Y-m-d')." 00:00:00", $dateE->format('Y-m-d')." 23:59:59"])
->with('branch', 'employee')
->get();





if($result->count()>0){

    return view('admin.profit_invoice',['data'=>$result, 'expense'=>$expense,'salary'=>$salary ,'comment'=>'Purchase Report Genrate  '.$start.' Between '.$end.'']);

}else{
    return view('admin.profit_invoice',['data'=>$result,'comment'=>' Today Sales Report']);
}
    }



   public function report_genrate_sale(Request $request){

    // Branch Name get globel for all if

           $id = $request->branch;
           $branch = branch::where(['id'=>$id])->first();
           $branch_name = $branch->name;



      if($request->type == "today"){

      $day = bill::whereDate('created_at', Carbon::today())->where(['branch_id'=>$request->branch])->get();

      if($day->count() >0){

         return view('admin.report_view_invoice',['data'=>$day,'comment'=>'Today Sales Report'.$branch_name.'']);

      }else{

          return view('admin.report_view_invoice',['data'=>$day,'comment'=>' Today Sales Report']);
      }

     //    sale Report today end

      }else if($request->type == "week"){


        // weekly report start code
        $weekly = bill::where( 'created_at', '>', Carbon::now()->subDays(7))
        ->where(['branch_id'=> $request->branch])
        ->with('branch','product')
        ->get();

        if($weekly->count() >0){

           return view('admin.report_view_invoice',['data'=>$weekly,'comment'=>'Current Week Sales Report '.$branch_name.'']);

        }else{
            // dd("error");
            return view('admin.report_view_invoice',['data'=>$weekly,'comment'=>'Current Week Sales Report']);
        }

       // weekly report end code

     }else if($request->type == "month"){

      // Mothly report code started

      $month = bill::whereMonth('created_at', date('m'))
      ->whereYear('created_at', date('Y'))
      ->where(['branch_id'=>$request->branch])
      ->with('branch','product')
      ->get();


        if($month->count() >0){

           return view('admin.report_view_invoice',['data'=>$month,'comment'=>'Current Month Sales Report '.$branch_name.'']);

        }else{
            // dd("error");
            return view('admin.report_view_invoice',['data'=>$month,'comment'=>'Current Month Sales Report']);
        }


         // Mothly report code end

    }else if($request->type == "year"){

    // Yearly   report code start


    $year = bill::whereYear('created_at', '=', date('Y'))
    ->where(['branch_id'=>$request->branch])
    ->with('branch','product')
    ->get();



        if($year->count() >0){

           return view('admin.report_view_invoice',['data'=>$year,'comment'=>'Current Year Sales Report '.$branch_name.'']);

        }else{
            // dd("error");
            return view('admin.report_view_invoice',['data'=>$year,'comment'=>'Current Year Sales Report']);
        }


         // Yearly   report code start
   }




}


}


