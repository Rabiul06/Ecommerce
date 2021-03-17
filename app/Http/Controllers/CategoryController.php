<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
Session_start();
class CategoryController extends Controller
{
    public function index(){
      $this->AdminAuthcheck();
    	return view('admin.add_category');
    }
    public function allcategory(){
    $this->AdminAuthcheck();
    $all_category=DB::table('tbl_category')->get();
    return View('admin.all_category')->with('all_category',$all_category);

    //return view('admin.all_category');
    }
     public function savecategory(Request $request){
      $this->AdminAuthcheck();
     	 $request->validate([
        'category_name' => 'required',
        'category_description' => 'required',
    ]);
     	$data['category_id']=$request->category_id;
     	$data['category_name']=$request->category_name;
     	$data['category_description']=$request->category_description;
     	$data['public_status']=$request->public_status;

     	DB::table('tbl_category')->insert($data);
     	Session::put('messege','Category add successfully !!');
     	return Redirect::to('/add-category');
    }
    public function unactivecategory($category_id){
   DB::table('tbl_category')
   ->where('category_id',$category_id)
   ->update(['public_status'=>0]);
   	Session::put('messege','<p class="alert-danger">Category unactive successfully !!</p>');
   return Redirect::to('/all-category');

    }
    public function activecategory($category_id){
     DB::table('tbl_category')
   ->where('category_id',$category_id)
   ->update(['public_status'=>1]);
   	Session::put('messege','<p class="alert-success">Category active successfully !!</p>');
   return Redirect::to('/all-category');
    }

    public function edit_category($category_id){
      $this->AdminAuthcheck();
       $save_category=DB::table('tbl_category')
       ->where('category_id',$category_id)
       ->first();
       return View('Admin.edit_category')->with('save_category',$save_category);
   
    
    }
    public function update_category(Request $request,$category_id){
    	$data=array();
    	$data['category_name']=$request->category_name;
    	$data['category_description']=$request->category_description;

    	DB::table('tbl_category')
    	->where('category_id',$category_id)
    	->update($data);
       Session::put('messege','<p class="alert-success">Category update successfully !!</p>');
    	return Redirect::to('/all-category');
    }

       public function delete_category($category_id){
    	DB::table('tbl_category')
    	->where('category_id',$category_id)
    	->delete();
       Session::put('messege','<p class="alert-danger">Category delete successfully !!</p>');
       return Redirect::to('/all-category');
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
