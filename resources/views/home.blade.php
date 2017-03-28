@extends('layouts.app')

@section('title', 'EadesMTG')

@section('content')
	<div class="homeWrap">
		@include('includes.sidebar')

		<div class="mainContent">
			<h1>Welcome to EadesMTG!</h1>
		    
		    <form action="{{ url('product/search') }}" method="POST">
		    {{ csrf_field() }}
		    	<legend>Use the search bar below to get started!</legend>
			    <div id="search" class="input-group">		    	
		  			<input type="text" name="search" placeholder="Search" class="form-control input-lg">
		  			<span class="input-group-btn">
		    			<input type="submit" class="btn btn-default btn-lg" value='Search'>
		  			</span>
				</div>	
			</form>
			<hr>

		    <p>EadesMTG is a site to sell Magic the Gathering (MTG) cards and Accessories in Australia. All prices are in AUD. This store is a hobby by a MTG player for MTG players.</p>
		    
		    <p>This is a private site and has no affiliation with Wizards of the Coast.</p>

		    <p>Feel Free to contact us using the contact us page if there are any issues or ideas to improve this site. Thank you.</p>
		</div>
	</div>
</div>
@endsection