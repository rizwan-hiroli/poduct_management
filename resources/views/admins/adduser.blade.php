@extends('layouts.master')



@section('content')
<!-- displaying the flash message initialized in laravel finction -->
@if(Session::has('flash_message'))
    <div class="alert alert-success">
        {{ Session::get('flash_message') }}
    </div>
@endif

<h1>Manage Product</h1>
<form method="post" action="/addproduct">

  		      	{{ csrf_field() }}
        @foreach ($products as $product)
            <input type="hidden" name="id" id="id" value="{{$product->id}}"></input>
            <div class="form-group row">
              <label for="text" class="col-sm-2 col-form-label">Product Name</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="prod_name" name="prod_name" value="{{$product -> prod_name }}" placeholder="Product Name">
              </div>
            </div>
            
            <div class="form-group row">
              <label for="text" class="col-sm-2 col-form-label">Product Price</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="price" name="price" value="{{$product -> price}}" placeholder="Price">
              </div>
            </div>


            <div class="form-group row">
              <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Update</button>
              </div>
            </div>

        @endforeach


        <!-- to dsplay error of laravel if any -->
        @if(count($errors))
    			<div class="form-group">
    				<div class="alert alert-danger">
    					<ul>
    						@foreach($errors->all() as $error)
    							<li>	{{ $error }}	</li>
    						@endforeach
    					</ul>
    					
    				</div>
    			</div>
		    @endif

</form>





@endsection