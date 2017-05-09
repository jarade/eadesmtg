@extends('layouts.app')

@section('title', 'EadesMTG Products')

@section('content')

@php 
    use App\ReceiptProduct;
    use App\Receipt;

    // Reset cart variables
    session()->forget('totalPrice');
    session()->forget('cart');

    // Set the flash data incase of refresh
    session()->keep('id');

    $products = ReceiptProduct::where('receiptID', session('id'));
    $receipt = Receipt::where('receiptID', session('id'))->first();

    $timestamp = strtotime($receipt->purchasedDate);

    $date = date('d-m-Y', $timestamp);
    $time = date('h:i:s a P', $timestamp);
@endphp

    <div class='content container'>
        @if (session('status'))
            <div class="alert alert-success">
                <p> {{ session('status') }} </p>
            </div>
        @endif
    	<div>
    		<legend><h1>Thank you for shopping with EadesMTG</h1></legend>
            <p>Date Purchased: {{ $date }}</p> 
            <p>Time Purchased: {{ $time }}</p>
            <p>Total Price: $ {{ number_format($products->sum('productPrice'), 2) }}</p>
            <h2>Products Purchased</h2><hr>
    		<form class='row col-sm-12'>
    			<div class='col-xs-5 col-sm-5 text-center'>
    				<h3>Item Name</h3>
    			</div>
    			<div class='col-xs-3 col-sm-3 text-center'>
    				<h3>Individual Price</h3>
    			</div>
    			<div class='col-xs-2 col-sm-2 text-center'>
    				<h3>Quantity</h3>
    			</div>
                <div class='col-xs-2 col-sm-2 text-center'>
                    <h3>Total Price</h3>
                </div>
            <hr>
    		</form>
            <div class='row'>
                @each('includes.receiptProduct', $products->get(), 'receipt')
            </div>
            <hr>
    	</div>
        <button id="print" class='btn btn-color pull-right' onclick="window.print()">Print Receipt</button>
    </div>
@endsection