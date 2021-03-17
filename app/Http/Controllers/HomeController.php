<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
class HomeController extends Controller
{
   public function index(){
   	 $all_publish_product=DB::table('tbl_product')
   ->join('tbl_category','tbl_product.category_id', '=','tbl_category.category_id')
   ->join('manufacture','tbl_product.manufacture_id', '=' ,'manufacture.manufacture_id' )
   ->select('tbl_product.*','tbl_category.category_name','manufacture.manufacture_name')
   ->where('tbl_product.public_status',1)
   // ->limit();
    ->get();
    return View('pages.home_content')->with('all_publish_product',$all_publish_product);
   }
   public function product_by_category($category_id){
   $product_by_categiry=DB::table('tbl_product')
   ->join('tbl_category','tbl_product.category_id', '=','tbl_category.category_id')
   ->select('tbl_product.*','tbl_category.category_name')
   ->where('tbl_category.category_id',$category_id)
   ->where('tbl_product.public_status',1)
   // ->limit();
    ->get();
    return View('Admin.product_by_category')->with('product_by_categiry',$product_by_categiry);
   }
      public function product_by_manufacture($manufacture_id){
   $product_by_manufacture=DB::table('tbl_product')
    ->join('tbl_category','tbl_product.category_id', '=','tbl_category.category_id')
   ->join('manufacture','tbl_product.manufacture_id', '=' ,'manufacture.manufacture_id' )
   ->select('tbl_product.*','tbl_category.category_name','manufacture.manufacture_name')
   ->where('manufacture.manufacture_id',$manufacture_id)
   ->where('tbl_product.public_status',1)
   // ->limit();
    ->get();
    return View('Admin.product_by_manufacture')->with('product_by_manufacture',$product_by_manufacture);
   }
   public function product_details_by_id($product_id){
    $product_by_details=DB::table('tbl_product')
    ->join('tbl_category','tbl_product.category_id', '=','tbl_category.category_id')
   ->join('manufacture','tbl_product.manufacture_id', '=' ,'manufacture.manufacture_id' )
   ->select('tbl_product.*','tbl_category.category_name','manufacture.manufacture_name')
   ->where('tbl_product.product_id',$product_id)
   ->where('tbl_product.public_status',1)
   // ->limit();
    ->first();
    return View('pages.product_details')->with('product_by_details',$product_by_details);
   }
}
