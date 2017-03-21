@extends('layouts.app')

@section('title', 'EadesMTG Products')

@section('content')
    <div class='content container'>
	    <h1>Search</h1>

	    <form class='form-horizontal text-center'>
	    	<div class="row col-sm-12">
		    	<div class="col-sm-6">
		    		<div class='row col-sm-11'>
					    <label class='control-label' for="search">Search: </label> 
					    <input class='form-control' type="text" id='search' name="search" placeholder="Enter your search..." />
					    <br>
					    <label class='control-label' for="searchIn">
					    	<input type="checkbox" id='searchIn' name="searchIn"/> Search in product description
					    </label>
				   	</div>
				    <div class='row col-sm-11'>
					    <select class='form-control' name="type">
					    	<option value="0" default>All Product Types</option>
					    	<option value="1">Accessories Only</option>
					    	<option value="2">Cards Only</option>
					    </select>
				    </div>
			    </div>
			    <div class="col-sm-6">
			    	<div class='row col-sm-11'>
					    accessory search
					    <div>
					    <select class='form-control'>
					    	<option>type</option>
					    </select>
					    </div>
				    </div>
				    <div class='row col-sm-11'>
					    Card search
					    <div>
						    <select class='form-control'>
						   		<option>Color</option>
						    </select>
						    <select class='form-control'>
						   		<option>Edition</option>
						    </select>
					    </div>
				    </div>
			    </div>
		    </div>
		    <div class='row col-sm-12'>
		    	<br>
		    	<input id='searchButton' class='btn btn-color col-sm-11' type="submit" value="Search"/>
		    </div>
	    </form>

	    <div id='results' class='row'>
	    	<div class='row'>
		    	@php 
		            use App\Product;
		        @endphp
		       
		    	@if (session('status'))
		    		<h2 class='col-sm-12'>Results</h2>
				@else
		    		<h2 class='col-sm-12'>All Products</h2>
	        	@endif

	        	@if (session('added'))
					<div class='row alert alert-success col-sm-12'> 
		        		<p>{{ session('added') }} </p>
		        	</div>
	        	@endif

	        	@if (!session('status'))
		            @each('includes.product', Product::all(), 'product')
		        @endif
	        </div>
	            
	    </div>
    </div>
@endsection