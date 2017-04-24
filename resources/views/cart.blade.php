@extends('layouts.app')

@section('title', 'EadesMTG Products')

@section('content')

@php 
	use App\Product;
@endphp
    
    <div class='content container'>
        @if (session('status'))
            <div class="alert alert-success">
                <p> {{ session('status') }} </p>
            </div>
        @endif
    	<div>
    		<legend><h1>Shopping Cart</h1></legend>
    		<form class='row col-sm-12'>
    			<div class='col-sm-2 text-center'>
    				<h3>Remove Item</h3>
    			</div>
    			<div class='col-sm-5 text-center'>
    				<h3>Item Name</h3>
    			</div>
    			<div class='col-sm-3 text-center'>
    				<h3>Individual Price</h3>
    			</div>
    			<div class='col-sm-2 text-center'>
    				<h3>Quantity</h3>
    			</div>
            <hr>
    		</form>
            <div class='row'>
                @php
                    $arr = array_reverse(array_sort(session()->get('cart'), function($arrayValue){
                        return array_sort($arrayValue, function($itemValue){
                            return $itemValue['name'];
                        });
                    }));
                @endphp

                @each('includes.cartProduct', $arr, 'session')

            </div>
            <hr>
            <div class='row col-sm-12'>
                <a href="{{ url('cart/checkout') }}">
                    <input class='btn btn-color' type="button" value="Checkout">
                </a>
            </div>
    	</div>
    </div>
@endsection