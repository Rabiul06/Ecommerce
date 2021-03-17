<?php

use Illuminate\Support\Facades\Route;

//Frontend Route
Route::get('/','HomeController@index');

//show category wise product

Route::get('/product_by_category/{category_id}','HomeController@product_by_category');
Route::get('/product_by_manufacture/{manufacture_id}','HomeController@product_by_manufacture');
Route::get('/view_product/{product_id}','HomeController@product_details_by_id');
Route::post('/add-to-cart','CartController@add_to_cart');
Route::get('/show-cart','CartController@show_cart');

//backend Route
Route::get('/logout','SuperaAminController@logout');
Route::get('/admin','AdminController@index');
Route::get('/dashbord','SuperaAminController@index');
Route::post('/admin_dashbord','AdminController@deshbord');
Auth::routes();

//category route
Route::get('/add-category','CategoryController@index');
Route::get('/all-category','CategoryController@allcategory');
Route::post('/save-category','CategoryController@savecategory');
Route::post('/update-category/{category_id}','CategoryController@update_category');
Route::get('/edit-category/{category_id}','CategoryController@edit_category');
Route::get('/unactiv_category/{category_id}','CategoryController@unactivecategory');
Route::get('/activ_category/{category_id}','CategoryController@activecategory');
Route::get('/delete_category/{category_id}','CategoryController@delete_category');

//manufracture route
Route::get('/add-manufacture','ManufactureController@index');
Route::post('/save_manufacture','ManufactureController@save_manufacture');
Route::get('/all-manufacture','ManufactureController@allmanufacture');
Route::get('/delete-manufacture/{manufacture_id}','ManufactureController@deletemanufacture');
Route::get('/unactiv_manufacture/{manufacture_id}','ManufactureController@unactivemanufacture');
Route::get('/activ_manufacture/{manufacture_id}','ManufactureController@activemanufacture');
Route::get('/edit_manufacture/{manufacture_id}','ManufactureController@editmanufacture');
Route::post('/update-manufacture/{manufacture_id}','ManufactureController@updatemanufacture');

//product route
Route::get('/add-product','ProductController@index');
Route::post('/save/productadd','ProductController@seveproduct')->name('save.product');
Route::get('/all-product','ProductController@allproduct');
Route::get('/unactiv_product/{product_id}','ProductController@unactiv_product');
Route::get('/activ_product/{product_id}','ProductController@activ_product');
Route::get('/delete_product/{product_id}','ProductController@delete_product');
Route::get('/edit_product/{product_id}','ProductController@edit_product');

//slider route
Route::get('/add-slider','SliderController@index');
Route::post('/save_slider','SliderController@save_slider');
Route::get('/all_slider','SliderController@all_slider');
Route::get('/unactiv_slider/{slider_id}','SliderController@unactiv_slider');
Route::get('/activ_slider/{slider_id}','SliderController@active_slider');
Route::get('/delete_slider/{slider_id}','SliderController@delete_slider');
Route::get('/slider','SliderController@slider');



