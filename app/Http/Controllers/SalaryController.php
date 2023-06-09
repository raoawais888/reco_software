<?php

namespace App\Http\Controllers;

use App\Models\salary;
use App\Models\employee;
use App\Models\branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     $employe=employee::all();
     $branch=branch::all();
     $salary = salary::orderBy('id', 'DESC')->with('employee','branch')->get();
    return view('admin.salary',['salary'=>$salary,'employee'=>$employe,'branch'=>$branch]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function salary_select( Request $request)
    {

        $result =employee::where(['id'=>$request->id])->first();
        $salary = $result->salary;
        return $salary;
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add_salary(Request $request)
    {

        $ded = $request->advance + $request->deduction;
        $total = $request->salary -$ded;
    
    $model= new salary;
    $model ->month = $request->date;
    $model ->employee_id = $request->employee_id;
    $model ->advance = $request->advance;
    $model ->deduction = $request->deduction;
    $model ->salary = $request->salary;
    $model ->branch_id = $request->branch_id;
    $model ->total = $total;
    $model->save();
     return Redirect()->back()->with('success','success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function show(salary $salary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function salary_edit(Request $request)
    {
        $id = $request->id;
          $employee = employee::all();
         $data = salary::where(['id'=>$id])->first();
         $output ="";
         if($data){
             $output.="
             
             
<div class='form-group'>
  <label for='recipient-name' class='col-form-label'>Date</label>
  <input type='text' readonly class='form-control'  name='date' value='{$data->month}'>
  <input type='hidden'  class='form-control'  name='salary_id' value='{$data->id}'>
</div>
<div class='form-group'>
  <label for='recipient-name' class='col-form-label'>Employe Name</label>
  <select name='employee_id' id='name' class='form-control'>";
foreach($employee as $dat){
    if($dat->id == $data->employee_id  ){
         $output.=" <option selected value='{$dat->id}'>{$dat->name}</option>";

    }else{
        $output.=" <option value='{$dat->id}'>{$dat->name}</option>";
    }
    


}
$output.="
  </select>
</div>

<div class='form-group'>
  <label for='recipient-name' class='col-form-label'>Basic salary</label>
  <input type='number' class='form-control' id='salary_val' name='salary' value='{$data->salary}'>
</div>
<div class='form-group'>
  <label for='recipient-name' class='col-form-label'>Advance</label>
  <input type='number' class='form-control' id='advance' name='advance' value='{$data->advance}'>
</div>
<div class='form-group'>
  <label for='recipient-name' class='col-form-label'>Deduction</label>
  <input type='number' class='form-control' id='deduction' name='deduction' value='{$data->deduction}'>
</div>
 

             ";        


            

         }


  return $output;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function update_salary(Request $request)
    {
        $id = $request->salary_id;
         $model = salary::find($id);

         $ded = $request->advance + $request->deduction;
         $total = $request->salary -$ded;
     
   
     $model ->month = $request->date;
     $model ->employee_id = $request->employee_id;
     $model ->advance = $request->advance;
     $model ->deduction = $request->deduction;
     $model ->salary = $request->salary;
     $model ->total = $total;
     $model->save();
     return Redirect()->back()->with('update','update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function salary_remove(Request $request)
    {
        salary::where(['id'=>$request->id])->delete();
        return 1;
    }
}
