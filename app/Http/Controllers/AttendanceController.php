<?php

namespace App\Http\Controllers;

use App\Models\attendance;
use App\Models\employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $attendance  = attendance::all();
       return view('admin.add_attendance',['attendance'=>$attendance]);
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
          $code = $request->code;
          $result= employee::where(['code'=>$code])->first();
          if($result){
              $model = new attendance();
              $model->date = $request->date;
              $model ->code = $request->code;
              
              $model->save();
              return Redirect()->back()->with('success','success');
          }else{
            return Redirect()->back()->with('error','error');
          }

        

            

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\attendance  $attendance
     * @return \Illuminate\Http\Response
     */
     public function show(Request $request)
    {
        $attendance = attendance::all();
        return view('admin.attendance',['attendance'=>$attendance]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function edit(attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(attendance $attendance)
    {
        //
    }
}
