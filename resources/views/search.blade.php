@extends('layouts.app')

@section('title', 'EadesMTG Products')

@section('content')
    <h1>Search</h1>
    <form>
    	<div class="row">
	    	<div class="col-md-6">
			    <label for="search">Search: </label> 
			    <input type="text" name="search" placeholder="Enter your search..." />
			    <br>
			    <label for="searchIn"><input type="checkbox" name="searchIn"/> Search in product description</label>
			   
			    <br>
			    <select name="type">
			    	<option value="0" default>All</option>
			    	<option value="1">Accessories</option>
			    	<option value="2">Cards</option>
			    </select>
		    </div>
		    <div class="col-md-6">
			    accessory search
			    <div>
			    <select>
			    	<option>type</option>
			    </select>
			    </div>

			    Card search
			    <div>
				    <select>
				   		<option>Color</option>
				    </select>
				    <select>
				   		<option>Edition</option>
				    </select>
			    </div>
		    </div>
		    <div class="pull-right">
		    	<input type="submit" value="Search"/>
		    </div>
		    <div>
		    Results
		    </div>
	    </div>
    </form>
@endsection