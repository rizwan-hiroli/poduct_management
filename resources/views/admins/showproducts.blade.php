@extends('layouts.master')



@section('content')

<h2>Product Details</h2>


<table class="table table-bordered">
		  <thead>
		    <tr>
		      <th scope="col">Product id</th>
		      <th scope="col">Product Name</th>
		      <th scope="col">Action</th>
		      
		    </tr>
		  </thead>
		  <tbody>
				@foreach($products as $product)
				<tr>
					<td> {{ $product->id }} </td>
					<td> {{ $product->prod_name }} </td>

					<td>	<a href="#">
				          <span class="glyphicon glyphicon-edit"></span>
				        </a>
				        &nbsp; &nbsp;
				        <a href="#">
				          <span class="glyphicon glyphicon-trash"></span>
				        </a>
				    </td>
				</tr>
				
				@endforeach
 		 </tbody>
</table>


@endsection