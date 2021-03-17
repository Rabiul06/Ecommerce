<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
Session_start();
class AdminController extends Controller
{
   public function index(){
   	return view('Admin.admin_login');
   }
    public function show_deshbord(){
    	   	return view('Admin.dashbord');
   }

   public function admin(){
   	return view('Admin.Admin_home');
   }
   public function deshbord(Request $request){
   $admin_email=$request->admin_email;
   $admin_password=md5($request->admin_password);
   $result=DB::table('tbl_admin')
   ->where('admin_email',$admin_email)
   ->where('admin_password',$admin_password)
   ->first();
   if($result){
   	Session::put('admin_name',$result->admin_name);
   	Session::put('admin_id',$result->admin_id);
   	return redirect::to('/dashbord');
   }
   else{
   	Session::put('messege','Email or password envalid');
   	   	return redirect::to('/admin');
   }
   }
}

