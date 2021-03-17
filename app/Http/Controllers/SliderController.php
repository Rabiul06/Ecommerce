<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Str;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
Session_start();
class SliderController extends Controller
{
    public function index(){
    	return view('/Admin.add_slider');
    }
    public function save_slider(Request $request){
    	$data=array();  
    	$data['public_status']=$request->public_status;
    	$image=$request->file('slider_image');
    	if($image){
    	$image_name=Str::random(40);
    	$ext=strtolower($image->getClientOriginalExtension());
    	$iamge_full_name=$image_name.'.'.$ext;
    	$upload_path='slider/';
    	$image_url=$upload_path.$iamge_full_name;
    	$success=$image->move($upload_path,$iamge_full_name);
    	if($success){
    	  $data['slider_image']=$image_url;
    	  DB::table('tbl_slider')->insert($data);
    	  Session::put('messege','Slider add successfully done !!');
    	  return Redirect::to('/add-slider');
    	}
    }
}
 public function all_slider(){
	  $all_slider=DB::table('tbl_slider')->get();
    return View('admin.all_slider')->with('all_slider',$all_slider);
}
   public function slider(){
	 $all_slider=DB::table('tbl_slider')->get();
   return View('layout')->with('all_slider',$all_slider);
}



public function unactiv_slider($slider_id){
	 DB::table('tbl_slider')
   ->where('slider_id',$slider_id)
   ->update(['public_status'=>0]);
   	Session::put('messege','<p class="alert-danger">slider unactive successfully !!</p>');
   return Redirect::to('/all_slider');
}
 public function active_slider($slider_id){
    DB::table('tbl_slider')
   ->where('slider_id',$slider_id)
   ->update(['public_status'=>1]);
   	Session::put('messege','<b><p class="alert-success">slider active successfully !!</p></b>');
   return Redirect::to('/all_slider');
    }
     public function delete_slider($slider_id){
    	DB::table('tbl_slider')
    	->where('slider_id',$slider_id)
    	->delete();
       Session::put('messege','<b><p class="alert-danger">slider delete successfully !!</p></b>');
       return Redirect::to('/all_slider');
    }
}