@extends('layouts.app')

@section('title', 'EadesMTG')

@section('content')
	<div class="homeWrap">
		<div class="sidebar">
			<img src="{{ asset('img/design/MTG_Logo.png') }}" alt="mtg logo">
			<h1>Browse Products</h1>
			<p>TODO:</p>
			<ul class="list-unstyled">
				<li>Home Page: product type list</li>
				<li>Contact Us Page: connect to email,
					Add contact number
				</li>
				<li>Life Counter Edit Page:</li>
				<li>Life Counter View Page:</li>
				<li>Product Page</li>
				<li>Search Page</li>
				<li>Cart Page</li>
				<li>Checkout Page</li>
			</ul>
		</div>

		<div class="mainContent">
		
			<h1>Welcome to EadesMTG!</h1>
		    
		    <p>Use the search bar below to get started!</p>
		    
		    <div id="search" class="input-group">
	  			<input type="text" name="search" placeholder="Search" class="form-control input-lg">
	  			<span class="input-group-btn">
	    			<button type="button" class="btn btn-default btn-lg"><i class="fa fa-search"></i></button>
	  			</span>
			</div>	   
			<hr>

		    <p>EadesMTG is a site to sell Magic the Gathering (MTG) cards and Accessories in Australia. All prices are in AUD. This store is a hobby by a MTG player for MTG players.</p>
		    
		    <p>Feel Free to contact us using the contact us page if there are any issues or ideas to improve this site. Thank you.</p>
		  
		</div>
	</div>
</div>
@endsection