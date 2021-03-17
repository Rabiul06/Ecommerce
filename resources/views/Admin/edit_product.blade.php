@extends('admin_layout')
@section('admin_content')
<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="index.html">Home</a>
					<i class="icon-angle-right"></i> 
				</li>
				<li>
					<i class="icon-edit"></i>
					<a href="#">Forms</a>
				</li>
			</ul>
			<p class="alert-success">
				   <?php 
                   $messege=Session::get('messege');
                   if($messege){
                   	echo $messege;
                   	Session::put('messege',null);
                   }
                   	?>
                   	</p>

			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Edit product</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
			<div class="box-content">
				<p class="alert-success">
				<form class="form-horizontal" action="{{route('save.product')}}" method="POST" enctype="multipart/form-data">

					{{csrf_field()}}
				  <fieldset>
				  
					<div class="control-group">
					  <label class="control-label">Product Name</label>
					  <div class="controls">
						<input type="text"  name="product_name" value="{{$edit_product->product_name}} " >
					  </div>
					</div> 
					
					 <div class="control-group">
						<label class="control-label" for="selectError3">Product Category</label>
						<div class="controls">
						  <select id="selectError3" name="category_id">
						  	<option>Select Category</option>			
							 <?php 
                              $all_publish_category=DB::table('tbl_category')
                              ->where('public_status',1)
                              ->get();
                              foreach($all_publish_category as $value){?>
							<option value="{{$value->category_id}}">{{$value->category_name}} </option>
						<?php } ?>
						
						  </select>
						</div>
					 </div>
					 <div class="control-group">
						<label class="control-label" for="selectError3">Manufacture Name</label>
						<div class="controls">
						  <select id="selectError3" name="manufacture_id">
						  	<option>Select manufacture</option>						  	
							 <?php 
                              $all_publish_manufacture=DB::table('manufacture')
                              ->where('manufacture_status',1)
                              ->get();
                              foreach($all_publish_manufacture as $value){?>
							<option value="{{$value->manufacture_id}}">{{$value->manufacture_name}} </option>
						<?php } ?>
							
						  </select>
						</div>
					 </div>
					<!-- <div class="alert-danger">{{$errors->first('category_name')}}</div>   -->
					<div class="control-group hidden-phone">
					  <label class="control-label" for="textarea2">Product Short Description</label>
					  <div class="controls">
						<textarea class="cleditor" name="product_short_description"  rows="3" value="{{$edit_product->product_short_description}} "></textarea>
					  </div>
					</div>
					<div class="control-group hidden-phone">
					  <label class="control-label" for="textarea2">Product long Description</label>
					  <div class="controls">
						<textarea class="cleditor" name="product_long_description"  rows="3" value="{{$edit_product->product_long_description}} "></textarea>
					  </div>
					</div>
					<!-- <div class="alert-danger">{{$errors->first('category_description')}} -->
					
					<div class="control-group">
					  <label class="control-label">Product price</label>
					  <div class="controls">
						<input type="text" value="{{$edit_product->product_price}} "  name="product_price" >
					  </div>
					</div>  
					<div class="control-group hidden-phone">
					  <label class="control-label" for="fileInput">Image</label>
					  <div class="controls">
						<input class="input-file uniform_on" type="file" name="product_image" >
					  </div>
					</div>
					<div class="control-group">
					  <label class="control-label">Product size</label>
					  <div class="controls">
						<input type="text"  name="product_size" value="{{$edit_product->product_size}} " >
					  </div>
					</div> 
					<div class="control-group">
					  <label class="control-label">Product color</label>
					  <div class="controls">
						<input type="text"  name="product_color" value="{{$edit_product->product_color}} " >
					  </div>
					</div> 
					<div class="control-group hidden-phone">
					  <label class="control-label" for="textarea2">Public status</label>
					  <div class="controls">
						<input type="checkbox" name="public_status" value="1">
					  </div>
					</div>
					

					<div class="form-actions">
					  <button type="submit" class="btn btn-primary">Add product</button>
					  <button type="reset" class="btn">Cancel</button>
					</div>
					</div>
					
				  </fieldset>
				</form>   

			</div>
		</div><!--/span-->

	</div><!--/row-->
@endsection