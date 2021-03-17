<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
Session_start();
class ManufactureController extends Controller
{
    public function index(){
      $this->AdminAuthcheck();
    	return view('admin.add_manufacture');
    }
    public function save_manufacture(Request $request){
      $this->AdminAuthcheck();
    	 $request->validate([
        'manufacture_name' => 'required',
        'manufacture_description' => 'required',
    ]);
    	$data['manufacture_id']=$request->manufacture_id;
     	$data['manufacture_name']=$request->manufacture_name;
     	$data['manufacture_description']=$request->manufacture_description;
     	$data['manufacture_status']=$request->manufacture_status;

     	DB::table('manufacture')->insert($data);
     	Session::put('messege','Manufacture add successfully !!');
     	return Redirect::to('/add-manufacture');
    }

   public function allmanufacture(){
    $this->AdminAuthcheck();
   	 $all_manufacture=DB::table('manufacture')->get();
    return View('admin.all_manufacture')->with('all_manufacture',$all_manufacture);
   }
     public function deletemanufacture($manufacture_id){
   	   DB::table('manufacture')
   	  ->where('manufacture_id',$manufacture_id)
   	  ->delete();
        Session::put('messege','<p class="alert-danger">Manufacture delete successfully !!</p>');
       return Redirect::to('/all-manufacture');
   }
    public function unactivemanufacture($manufacture_id){
    DB::table('manufacture')
   ->where('manufacture_id',$manufacture_id)
   ->update(['manufacture_status'=>0]);
   	Session::put('messege','<p class="alert-danger">Manufacture unactive successfully !!</p>');
   return Redirect::to('/all-manufacture');

    }
     public function activemanufacture($manufacture_id){
     DB::table('manufacture')
   ->where('manufacture_id',$manufacture_id)
   ->update(['manufacture_status'=>1]);
   	Session::put('messege','<p class="alert-success">Manufacture active successfully !!</p>');
   return Redirect::to('/all-manufacture');
    }

     public function editmanufacture($manufacture_id){
       $this->AdminAuthcheck();
       $save_manufacture=DB::table('manufacture')
       ->where('manufacture_id',$manufacture_id)
       ->first();
       return View('Admin.edit_manufacture')->with('save_manufacture',$save_manufacture);
}
public function updatemanufacture(Request $request,$manufacture_id){
        $data=array();
    	$data['manufacture_name']=$request->manufacture_name;
    	$data['manufacture_description']=$request->manufacture_description;

    	DB::table('manufacture')
    	->where('manufacture_id',$manufacture_id)
     	->update($data);
        Session::put('messege','<p class="alert-success">Manufacture update successfully !!</p>');
    	return Redirect::to('/all-manufacture');
}
public function AdminAuthcheck(){
  $admin_check=Session::get('admin_id');
  if($admin_check){
  return;
  }else
  {
    return Redirect::to('/admin')->send();
    }
   }
}