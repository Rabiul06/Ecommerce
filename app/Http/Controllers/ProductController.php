<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Str;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
Session_start();
class ProductController extends Controller
{
    public function index(){
    	$this->AdminAuthcheck();
    	return view('admin.add_product');
    }
    public function allproduct(){
    $this->AdminAuthcheck();
    $all_product=DB::table('tbl_product')
     ->join('tbl_category','tbl_product.category_id', '=','tbl_category.category_id')
    ->join('manufacture','tbl_product.manufacture_id', '=' ,'manufacture.manufacture_id' )
    ->select('tbl_product.*','tbl_category.category_name','manufacture.manufacture_name')
    ->get();
    return View('admin.all_product')->with('all_product',$all_product);
    }
     public function seveproduct(Request $request){
     	$this->AdminAuthcheck();
    	$data=array();
    	$data['product_id']=$request->product_id;
    	$data['product_name']=$request->product_name;
    	$data['category_id']=$request->category_id;
    	$data['manufacture_id']=$request->manufacture_id;
    	$data['product_short_description']=$request->product_short_description;
    	$data['product_long_description']=$request->product_long_description;
    	$data['product_price']=$request->product_price;
    	$data['product_color']=$request->product_color;
    	$data['public_status']=$request->public_status;
    	$data['product_size']=$request->product_size;

    	$image=$request->file('product_image');
    	if($image){
    	$image_name=Str::random(40);
    	$ext=strtolower($image->getClientOriginalExtension());
    	$iamge_full_name=$image_name.'.'.$ext;
    	$upload_path='image/';
    	$image_url=$upload_path.$iamge_full_name;
    	$success=$image->move($upload_path,$iamge_full_name);
    	if($success){
    	  $data['product_image']=$image_url;
    	  DB::table('tbl_product')->insert($data);
    	  Session::put('messege','Product add successfully done !!');
    	  return Redirect::to('/add-product');
    	}
    	}

    	$data['product_image']='';
    	DB::table('tbl_product')->insert($data);
    	Session::put('messege','Product add without image!!');
    	return Redirect::to('/add-product');

    }
    public function unactiv_product($product_id){
    DB::table('tbl_product')
   ->where('product_id',$product_id)
   ->update(['public_status'=>0]);
   	Session::put('messege','<p class="alert-danger">product unactive successfully !!</p>');
   return Redirect::to('/all-product');
    }  
    public function activ_product($product_id){
    DB::table('tbl_product')
   ->where('product_id',$product_id)
   ->update(['public_status'=>1]);
   	Session::put('messege','<b><p class="alert-success">product active successfully !!</p></b>');
   return Redirect::to('/all-product');
    }
    public function delete_product($product_id){
    	DB::table('tbl_product')
    	->where('product_id',$product_id)
    	->delete();
       Session::put('messege','<b><p class="alert-danger">Product delete successfully !!</p></b>');
       return Redirect::to('/all-product');
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
   public function edit_product($product_id){
       $edit_product=DB::table('tbl_product')
       ->where('product_id',$product_id)
       ->first();
       return View('Admin.edit_product')->with('edit_product',$edit_product);
   }
}
