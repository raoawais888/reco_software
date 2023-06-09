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


class ReportController extends Controller
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
    {    $branch = branch::all();
        return view('admin.profit_report',compact('branch'));
    }


    // purchase Report genrate view  function

    public function sale_report_view()
    {
        $branch = branch::all();
        return view('admin.sale_report_invoice',compact('branch'));
    }



    // purchase Report genrate view  function
    public function purchase_report_view()
    {
        $branch = branch::all();
        return view('admin.purchase_invoice_report',compact('branch'));
    }






/* <===============================================================================================     Purchase Code start here All reported genrated by this section        ==================================================================================================>  */

  public function purchase_report_genrate(Request $request){
    $id = $request->branch;
    $branch = branch::where(['id'=>$id])->first();
    $branch_name = $branch->name;
       if($request->type == "today"){


        //purchase  day  code report start
        $day = purchase::whereDate('created_at', Carbon::today())
        ->where(['branch_id'=>$request->branch])
        ->with('branch','product')
        ->get();


        if($day->count() >0){

           return view('admin.purchase_report_view_invoice',['data'=>$day,'comment'=>' Today Purchase Report '.$branch_name.'']);

        }else{
            // dd("error");
            return view('admin.purchase_report_view_invoice',['data'=>$day,'comment'=>' Today Purchase Report']);
        }

        //purchase  day  code report end

       }else if($request->type == "week"){


        // weekly report code start

        $weekly = purchase::where( 'created_at', '>', Carbon::now()->subDays(7))
        ->where(['branch_id'=>$request->branch])
        ->with('branch','product')->get();

        if($weekly->count() >0){

           return view('admin.purchase_report_view_invoice',['data'=>$weekly,'comment'=>'Current Week purchase Report '.$branch_name.'']);

        }else{

            return view('admin.purchase_report_view_invoice',['data'=>$weekly,'comment'=>'Current Week purchase Report']);
        }


     // weekly report code end


       }else if($request->type == "month"){


         // Mothly report purchase code started

      $month = purchase::whereMonth('created_at', date('m'))
      ->whereYear('created_at', date('Y'))
      ->where(['branch_id'=>$request->branch])
      ->with('branch','product')
      ->get();

        if($month->count() >0){

           return view('admin.purchase_report_view_invoice',['data'=>$month,'comment'=>'Current Month purchase Report '.$branch_name.'']);

        }else{
            // dd("error");
            return view('admin.purchase_report_view_invoice',['data'=>$month,'comment'=>'Current Month purchase Report']);
        }

         // Mothly report purchase code end

       }else if($request->type == "year"){


      // Yearly report Purchase Code started


    $year = purchase::whereYear('created_at', '=', date('Y'))
    ->where(['branch_id'=>$request->branch])
    ->with('branch','product')
    ->get();



        if($year->count() >0){

           return view('admin.purchase_report_view_invoice',['data'=>$year,'comment'=>'Current Year Purchase Report '.$branch_name.'']);

        }else{
            // dd("error");
            return view('admin.purchase_report_view_invoice',['data'=>$year,'comment'=>'Current Year Purchase Report']);
        }

                // Yearly report Purchase end


       }



  }




/* <===============================================================================================     Manually Purchase  Report Code start here All reported genrated by this section        ==================================================================================================>  */

    public function purchase_report_invoice_store(Request $request)
    {
        $branch = branch::where(['id'=>$request->branch])->first();
        $branch_name = $branch->name;

        $start = $request->start;
        $end = $request->end;

$dateS = new Carbon($request->start);
$dateE = new Carbon($request->end);
$result = purchase::where(['branch_id'=>$request->branch])->whereBetween('created_at', [$dateS->format('Y-m-d')." 00:00:00", $dateE->format('Y-m-d')." 23:59:59"])->get();

if($result->count()>0){

    return view('admin.purchase_report_view_invoice',['data'=>$result,'comment'=>'Purchase Report Genrate '. $branch_name.' '.$start.' Between '.$end.'']);

}else{
    return view('admin.purchase_report_view_invoice',['data'=>$result,'comment'=>' Today Sales Report']);
}
    }






/* <===============================================================================================     Today Activity Code start here All reported genrated by this section        ==================================================================================================>  */


public function today_activity(Request $request){
    $branch = branch::all();

    return view("admin.today_activity",compact('branch'));




}

public function today_activity_store(Request $request){

    $branch = $request->branch;
     //purchase  day  code report start
    $purchase = purchase::whereDate('created_at', Carbon::today())
    ->where(['branch_id'=>$branch])
  ->with('branch','product')
  ->get();

     $sale = bill::whereDate('created_at', Carbon::today())
     ->where(['branch_id'=>$branch])
    ->with('branch','product')
    ->get();

    $expense = expense::whereDate('created_at', Carbon::today())
    ->get();



    if($sale->count() >0){

        return view('admin.today_activity_invoice',['data'=>$sale, 'expense_today'=>$expense, 'purchase'=>$purchase,'comment'=>'Current Today Profit Report']);

     }else{

         return view('admin.today_activity_invoice',['data'=>'error' ,'comment'=>'No data available']);
     }

}


/* <===============================================================================================     Profit Code start here All reported genrated by this section        ==================================================================================================>  */

    public function profit_report(Request $request)
    {
        if($request->type == "month"){

            $month = bill::whereMonth('created_at', date('m'))
        ->whereYear('created_at', date('Y'))
        ->with('branch','product')
        ->get();

        // $month_expense = expense::whereMonth('created_at', date('m'))
        // ->whereYear('created_at', date('Y'))
        // ->with('branch','product')
        // ->get();

        $month_profit = purchase::whereMonth('created_at', date('m'))
        ->whereYear('created_at', date('Y'))
        ->with('branch','product')
        ->get();

        // dd($month_profit);


        $salary = salary::whereMonth('created_at', date('m'))
        ->whereYear('created_at', date('Y'))
        ->with('branch', 'employee')
        ->get();
        if($month->count() >0){

            return view('admin.profit_invoice',['data'=>$month,'expense'=>$month_profit,'salary'=>$salary ,'comment'=>'Current Month Profit Report']);

         }else{
             // dd("error");
             return view('admin.profit_invoice',['data'=>'No Data Available' ,'comment'=>'No data available']);
         }

        }else if($request->type == "year"){

            $year = bill::whereYear('created_at', date('Y'))
            ->with('branch','product')
            ->get();



            $year_expense = expense::whereYear('created_at', date('Y'))
            ->with('branch','product')
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


    }




/* <===============================================================================================     Profit Code start here Maunally  reported genrated by this section        ==================================================================================================>  */

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





/* <===============================================================================================     Sales Report Code start here All reported genrated by this section        ==================================================================================================>  */


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



/* <===============================================================================================     Manually Sale Report Code start here All reported genrated by this section        ==================================================================================================>  */

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


}


