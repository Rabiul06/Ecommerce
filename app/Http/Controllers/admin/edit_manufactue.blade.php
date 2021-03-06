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

			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Manufactue Edit</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
			<div class="box-content">

				<p class="alert-success">
				<form class="form-horizontal" action="{{url('/update-category/'.$save_category->category_id)}}" method="post">
				
					{{csrf_field()}}
				  <fieldset>
					<div class="control-group">
					  <label class="control-label">Manufacture Name</label>
					  <div class="controls">
						<input type="text"  name="manufacture_name" value="{{$save_manufacture->manufacture_name}}"> 
					  </div>
					</div>  
			
					<div class="alert-danger"></div>       
					<div class="control-group hidden-phone">
					  <label class="control-label" for="textarea2">Category Description</label>
					  <div class="controls">
						<textarea class="cleditor" name="manufacture_description"  rows="3" >{{$save_manufacture->manufacture_description}} </textarea>
					  </div>
					</div>
					<div class="alert-danger"></div>
					<div class="control-group hidden-phone">
					  <label class="control-label" for="textarea2">Public status</label>
					  <div class="controls">
						<input type="checkbox" name="manufacture_status" value="1">
					  </div>
					</div>

					<div class="form-actions">
					  <button type="submit" class="btn btn-primary">Update category</button>
					  <button type="reset" class="btn">Cancel</button>
					</div>
				  </fieldset>
				</form>   

			</div>
		</div><!--/span-->

	</div><!--/row-->
@endsection