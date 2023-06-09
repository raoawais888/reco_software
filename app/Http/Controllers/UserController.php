<?php

namespace App\Http\Controllers;

use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{

    public function index(){

        $user = user::all();
      return view('admin.user',['user'=>$user]);
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function auth( Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        $check = user::where(['email'=>$email,'password'=>$password])->first();
         
        if($check){
            return Redirect('dashboard');
        }else{
            return Redirect('/')->with('error','Incorrect Information');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        return Redirect('/');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add_user(Request $request)
    {
        $check = user::where(['email'=>$request->username])->first();
        if($check){
            return 2;
        }else{
        $model = new user;
        $model->name = $request->name;
        $model->email = $request->username;
        $model->number = $request->number;
        $model->password = $request->password;
        $model->role = $request->role;
        $model->save();
        return 1;
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function edit_user(Request $request)
    {
        $id = $request->id;
        $data = user::where(['id'=>$id])->first();
        $output="
        
        <form id='update_user_from'>
    <div class='row'>
        <div class='col-md-12'>
            <div class='form-group'>
                <label for='recipient-name' class='col-form-label'>Select Role</label>
               <select name='role' id='role' class='form-control'>
                   <option value='0'>User</option>
                   <option value='1'>Admin</option>
               </select>
              </div>
        </div>
    </div>
    
    <div class='row'>
        <div class='col-md-6'>
            <div class='form-group'>
                <label for='recipient-name'   class='col-form-label'>Name</label>
                <input type='text' class='form-control' id='name' name='name' value='{$data->name}'>
              </div>
        </div>

        <div class='col-md-6'>

            
    <div class='form-group'>
        <label for='recipient-name' class='col-form-label'>Phone</label>
        <input type='number' class='form-control' id='number' name='number' value='{$data->number}'>
      </div>
        </div>
    </div>

    <div class='row'>
        <div class='col-md-6'>
            
    <div class='form-group'>
        <label for='recipient-name' class='col-form-label'>Username</label>
        <input type='text' class='form-control' id='username' name='username' value='{$data->email}'>
      </div>
        </div>

        <div class='col-md-6'>
            
    <div class='form-group'>
        <label for='recipient-name' class='col-form-label'>Password</label>
        <input type='password' class='form-control' id='password' name='password' value='{$data->password}'>
        <input type='hidden' class='form-control' id='user_id' name='user_id' value='{$data->id}'>
      </div>
        </div>
    </div>

  
</form>
        ";
        return $output;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(user $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function update_user(Request $request)
    {
        $id = $request->user_id;
       $model = user::find($id);
       $model->name = $request->name;
       $model->email = $request->username;
       $model->number = $request->number;
       $model->role = $request->role;
       $model->password = $request->password;
       $model->save();
       return 1;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function remove_user(Request $request)
    {
        $id = $request->id;
        user::find($id)->delete();
        return 1;
    }
}
