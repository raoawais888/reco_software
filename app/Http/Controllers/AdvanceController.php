<?php

namespace App\Http\Controllers;

use App\Models\advance;
use App\Models\employee;
use App\Models\salary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AdvanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    $employee = employee::all(); 
    $salary = salary::all(); 
    $advance = advance::all(); 
    return view('admin.advance',['employee'=>$employee,'salary'=>$salary,'advance'=>$advance]);
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
        $model = new advance;
        $model->month = $request->month;
        $model->employee_id = $request->employee_id;
        $model->amount = $request->amount;
        $model->save();
        return Redirect()->back()->with('success','success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\advance  $advance
     * @return \Illuminate\Http\Response
     */
    public function show(advance $advance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\advance  $advance
     * @return \Illuminate\Http\Response
     */
    public function edit(advance $advance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\advance  $advance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, advance $advance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\advance  $advance
     * @return \Illuminate\Http\Response
     */
    public function destroy(advance $advance)
    {
        //
    }
}
