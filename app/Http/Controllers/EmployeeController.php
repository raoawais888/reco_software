<?php

namespace App\Http\Controllers;

use App\Models\employee;
use App\Models\branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee = employee::with('branch')->get();
        // dd($employee);
    return view('admin.employee',['employee'=>$employee]);
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
        $model= new employee;
        $model->name = $request->name;
        $model->number = $request->number;
        $model->cnic = $request->cnic;
        $model->code = $request->code;
        $model->branch_id = $request->branch;
        $model->salary = $request->salary;
        $model->save();
        return Redirect()->back()->with('success','successs');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $branch =branch::all();
        return view('admin.add_employee',['branch'=>$branch]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function employee_edit(Request $request)
    {
           $id = $request->id;
           $branch = branch::all();
           $data = employee::where(['id'=>$id])->first();
           $output="";
           $output.="

           <div class='row'>
           <div class='col-md-12'>
               <div class='form-group'>
                   <label for=''>Name</label>
                   <input type='text' class='form-control' id='name' name='name' value='{$data->name}' required>
                   <input type='hidden' class='form-control' id='employee_id' name='employee_id' value='{$data->id}' >
                 </div>
           </div>
           <div class='col-md-12'>
               <div class='form-group'>
                   <label for=''>Number</label>
                   <input type='text' class='form-control' id='number' name='number' value='{$data->number}' required>
                 </div>
           </div>
           <div class='col-md-12'>
               <div class='form-group'>
                   <label for=''>CNIC NUMBER</label>
                   <input type='text' class='form-control' id='cnic' name='cnic'  value='{$data->cnic}' required>
                 </div>
           </div>


           <div class='col-md-12'>
               <div class='form-group'>
                   <label for='Invoice No'>Salary</label>
                   <input type='text' class='form-control' id='salary' name='salary' value='{$data->salary}' required>
                 </div>
           </div>


           <div class='col-md-12'>
        <div class='form-group'>
        <label for='recipient-name' class='col-form-label'>Branch Name</label>
        <select name='branch_id' class='form-control'>
      ";
      foreach($branch as $dat){

        if($dat->id == $data->branch_id){
            $output.=" <option selected value='{$dat->id}'>{$dat->name}</option>";
        }else{
            $output.=" <option value='{$dat->id}'>{$dat->name}</option>";
        }

      }



$output.="
</select>

      </div>
    </div>
         </div>





         </div>

           ";



           return $output;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      $id = $request->employee_id;
      $model = employee::find($id);
      $model ->name = $request->name;
      $model ->number = $request->number;
      $model ->cnic = $request->cnic;
      $model ->salary = $request->salary;
      $model ->branch_id = $request->branch_id;
      $model->save();
      return Redirect()->back()->with('update','update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function employee_remove(Request  $request)
    {

        employee::where(['id'=>$request->id])->delete();
        return 1;
    }
}
