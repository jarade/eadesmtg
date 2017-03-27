@extends('layouts.app')

@section('title', 'EadesMTG')

@section('content')
	<div class="homeWrap">
		<div class="sidebar">
			<img src="{{ asset('img/design/MTG_Logo.png') }}" alt="mtg logo">
			<h1>Browse Products</h1>
			
			<ul class="list-unstyled">
				@php
					use App\ProductType;

					$types = ProductType::all();

					foreach($types as $type){
						echo '<li><h3><a href="' . url('product/' . $type->type ) .  '">';
						echo $type->type;
						echo '</a></h3></li>';
					}
				@endphp
			</ul>
		</div>

		<div class="mainContent">
		
			<h1>Welcome to EadesMTG!</h1>
		    
		    <p>Use the search bar below to get started!</p>
		    <form action="{{ url('product/search') }}" method="POST">
		    {{ csrf_field() }}
			    <div id="search" class="input-group">		    	
		  			<input type="text" name="search" placeholder="Search" class="form-control input-lg">
		  			<span class="input-group-btn">
		    			<input type="submit" class="btn btn-default btn-lg" value='Search'>
		  			</span>
				</div>	
			</form>   
			<hr>

		    <p>EadesMTG is a site to sell Magic the Gathering (MTG) cards and Accessories in Australia. All prices are in AUD. This store is a hobby by a MTG player for MTG players.</p>
		    
		    <p>Feel Free to contact us using the contact us page if there are any issues or ideas to improve this site. Thank you.</p>
		  
		</div>
	</div>
</div>
@endsection