<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Cart;
class CartController extends Controller
{
    public function add_to_cart(Request $request){
    	$qty=$request->qty;
    	$product_id=$request->product_id;
    	$product_info=DB::table('tbl_product')
    	->where('product_id',$product_id)
    	->first();
       $data=array(); 
       $data['qty']=$qty;
       $data['id']=$product_info->product_id;
       $data['name']=$product_info->product_name;
       $data['price']=$product_info->product_price;
       $data['options']['image']=$product_info->product_image;

       Cart::add($data);
       return Redirect::to('/show-cart');

    }
    public function show_cart(){
    	$all_public_category=DB::table('tbl_category')
    	                    ->where('public_status',1)
    	                    ->get();
      return View('pages.add_to_cart')->with('all_public_category',$all_public_category);
    }
}
