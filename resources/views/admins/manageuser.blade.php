@extends('layouts.master')



@section('content')
<head>
		<!-- <link rel="stylesheet" href="css/font-awesome.min.css"> -->
	

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>




<h1>Manage User</h1>

@if(Session::has('flash_message'))
    <div class="alert alert-success">
        {{ Session::get('flash_message') }}
    </div>
@endif

<table class="table table-bordered">
		  <thead>
		    <tr>
		      
		      <th scope="col">User Name</th>
		      <th scope="col">Status</th>
		      <th scope="col">Action</th>
		      
		    </tr>
		  </thead>
		  <tbody>
				@foreach($users as $user)
				<tr>
					
					<td> {{ $user->name }} </td>
					<td> {{ $user->status }} </td>

					<td>
							
          				<a  href="/manageuser/{{$user->id}}/edit" name="enable" class="btn btn-primary">Edit</a>
							
				    </td>
				</tr>
				
				@endforeach
 		 </tbody>
</table>



@endsection

