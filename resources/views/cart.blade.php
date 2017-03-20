@extends('layouts.app')

@section('title', 'EadesMTG Products')

@section('content')

@php 
	use App\Product;
@endphp

    <div class='content container'>
    	<form>
    		<legend>Shopping Cart</legend>
    		<div class='row col-sm-12 text-center'>
    			<div class='col-sm-2'>
    				
    			</div>
    			<div class='col-sm-5'>
    				<h3>Item Name</h3>
    			</div>
    			<div class='col-sm-3'>
    				<h3>Individual Price</h3>
    			</div>
    			<div class='col-sm-2'>
    				<h3>Quantity</h3>
    			</div>
    		</div>
    	
    	
            @each('includes.cartProduct', Product::all(), 'product')
		
    	</form>
    </div>
@endsection