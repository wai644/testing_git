@extends('backendtemplate')
@section('content')
<div class="container-fluid">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">SubCategory Edit Form</h1>

	</div>


	
	<form  action="{{route('subcategories.update',$subcategory->id)}}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')
		<div class="form-row">
			<div class="form-group col-md-6">
				<label for="name">Name</label>
				<input type="text" class="form-control" id="name" name="name" value="{{$subcategory->name}}">
			</div>
			<div class="form-group col-md-6">
				<label for="photo">Category Choose</label>
				<select name="category" class="form-control">
		    		@foreach($categories as $row)
			    		<option value="{{$row->id}}" @if($subcategory->category_id == $row->id){{'selected'}} @endif>{{$row->name}}
					   	</option>
		    		@endforeach
		    	</select>
			</div>
		</div>

		<button type="submit" class="btn btn-primary" class="btnsubmit">Create</button>
	</form>

</div>
@endsection
