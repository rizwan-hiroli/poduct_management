@extends('layouts.master')





@section('content')
	<h1>Welcome <font color="#7386D5">
		 {{ Auth :: user()-> name }}		
	</font></h1>

@endsection