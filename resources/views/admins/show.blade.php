
@extends('layouts.master')



@section('content')
<h1>ADD USAGE</h1>
<!-- 
@if(session('success'))
    <div class="alert alert-success">
        {{'Data has inserted successfully'}}
    </div>
@endif -->
<!-- 
@if(Session::has('flash_message'))
    <div class="alert alert-success">
        {{ Session::get('flash_message') }}
    </div>
@endif -->

<div id="error" background="green">
	

</div>

<form action="" method="POST" id="save" role="form">
	<table class="table table-bordered">
		  <thead>
		    <tr>
		      
		      <th scope="col">Name</th>
		      <th scope="col">Price (Rs.)</th>
		      <th scope="col">Quantity</th>
		      
		    </tr>
		  </thead>
		  <tbody>
		  	@foreach ($product as $product)
		  	@foreach ($users as $user)
		    <tr>
		      
		      		<input type="hidden" name="user_id" class="form-control" value="{{ $user -> id }}">
		      
		      
		      <td>{{ $user -> name }}</td>
		      
		      <td>{{ $product->price }} </td>
		      <td>
		      		<div class="input-group mb-3">
					  <!-- data_id use to get another identification of same field we do mapping of name and quantity in ajax -->
					  <input type="number" name="quantity" class="form-control " data_id = "{{ $user->id }}" placeholder="Quantity" aria-label="Username" aria-describedby="basic-addon1" value="" min ="1" >
					  <div id = "errorquantity"></div>
					</div>
			  </td>
		    </tr>
		    @endforeach
		    @endforeach
		  </tbody>
	</table>


	<div class="form-group row">
          <div class="col-sm-10">
            <!-- <button type="button" class="btn btn-primary" id="savedata">Save Data</button> -->
            <button type="submit" class="btn btn-primary modal-login-btn">Save Data</button>
          </div>
     </div>
</form>









<!-- add hidden field with value of csrf token -->
<input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">

<script type="text/javascript">
		





		$("#save").submit(function(event) {

					event.preventDefault();
					//declaring array of name addproduct
					//var quantity="input[name='quantity']";
					var addproduct = [];
					//making the key value pair for quantity and user id 
					$("input[name='quantity']").each(function() {
						
						
					   	//getting data id and putting it in another variable
					   	var x = $(this).attr("data_id");
					   	// making each pair and adding it to to addproduct array
					   	addproduct.push([x, $(this).val()]);
					});
			var $nonempty = $('input[type=number]').filter(function() {
		    		return this.value != ''
		  		});

			if ($nonempty.length == 0) {
			      //$(this).parents('p').addClass('warning');
			      document.getElementById("error").innerHTML = "All fields cannot be empty";
			      $("#error").removeClass("alert alert-success");
			      $("#error").addClass("alert alert-warning");
			}	
			else{

				// setting up ajax call on submit
				$.ajax({
					//sending the intended data to controller via ajax
		           data: {'addproduct':addproduct,'_token' : $('#_token').val(),'quantity':$("input[name='quantity']").val()},
		           type: 'post',
		           url: '/save',

		           success: function(data) {
		           		var dt = $.parseJSON(data); //getting data from
		           		// document.getElementById("error").innerHTML = "Data has inserted successfully";
		           		if(dt.result == "success"){
							document.getElementById("error").innerHTML = "Record added successfully";
							$("#error").removeClass("alert alert-warning");
							$("#error").addClass("alert alert-success");
		           			
		           		}
		           		else{
		           			var x = dt.errors;
		           			for (key in x) {
		           				//getting error and display in a text defined by id in div
								$('#error'+key).text(x[key]);
							}
		           		}
		           	 // restting form if value is sent and success has returned 
		             $('#save')[0].reset();   
		           },

		           error: function(data) {
			           	
		           }
		       });
			}

		});




</script>




@endsection