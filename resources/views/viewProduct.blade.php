@extends('layouts.app')

@section('title', 'EadesMTG Products')

@section('content')




    <div class='content container'>
        <form class='form-horizontal text-center'>
            <div class='row viewProduct'>
                <div class='col-sm-8'>
                    @php
                        use App\ProductImage;

                        $images = ProductImage::where('productID', '=', $productID)->get();
                        $image = ProductImage::where('productID', '=', $productID)->first()['productImage'];
                    @endphp
                    <div class='row'>
                        <img id='displayImage' class='productBig' src="{{ asset('img/products/' . $image) }}"/>
                    </div>

                    <div class='row'>
                        @each('includes.viewProductImage', $images, 'image')
                    </div>
                </div>
                <div class='col-sm-4'>
                    <div class='row'>
                        <div class='row addC'>
                            <label for='toBuy' class='control-label col-sm-6'>Quantity:</label>
                            <input class='form-control quantityInput col-sm-6' type='number' id='toBuy' name='toBuy' value='1' max='{{ $productQuantity }}' step='1' min='1'>
                        </div>
                        <div class='row addC'>
                            <input class='btn btn-color productSubmit' type='submit' name='add' value='Add to Cart' />
                        </div>
                    </div>
                    <div class='row'>
                        <legend class='col-sm-12 '><h2>{{ $productName }}</h2></legend>
                    </div>
                    <div class='row'>
                        <h4 class='col-sm-6'>Available: {{ $productQuantity }}</h4>
                        <h4 class='col-sm-6'><b>$ {{ $productPrice }}</b></h4>
                    </div><hr>
                    <div class='row'>
                        <p class='col-sm-12 text-center'>{!! $productDescription !!}</p>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection