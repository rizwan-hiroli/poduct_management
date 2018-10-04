@extends('layouts.master')

@section('content')
<!-- displaying the flash message initialized in laravel finction -->
@if(Session::has('flash_message'))
    <div class="alert alert-success">
        {{ Session::get('flash_message') }}
    </div>
@endif

<h1>Manage User</h1>

<form method="post" action="">

  		      	{{ csrf_field() }}
        @foreach ($users as $user)
                
            <input type="hidden" name="id" id="id" value="{{$user->id}}"></input>
            <div class="form-group row">
              <label for="text" class="col-sm-2 col-form-label">Name</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name" value="{{$user -> name }} " placeholder="Name">
              </div>
            </div>
            
            <div class="form-group row">
              <label for="text" class="col-sm-2 col-form-label">Status</label>
              <div class="col-sm-10">
                <input type="number" min="0" max="1" class="form-control" id="status" name="status" value="{{$user -> status }}" placeholder="Status">
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