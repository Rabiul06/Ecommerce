<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
Session_start();

class SuperaAminController extends Controller
{
    public function logout(){
    	// Session::put('admin_name',null);
    	// Session::put('admin_id',null);
    	Session::flush();
    	return Redirect::to('/admin');
    }
     public function index(){
     	$this->AdminAuthcheck();
     return view('Admin.dashbord');
   }
   public function AdminAuthcheck(){
   	$admin_check=Session::get('admin_id');
	if($admin_check){
	 return;
   	}else{
   		return Redirect::to('/admin')->send();
   	}
   }
}
