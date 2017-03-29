@extends('layouts.app')

@section('title', 'EadesMTG Products')

@section('content')

    <script>

        function bigImg(img){
            console.log(img.className);
        }

        function smallImg(img){
            console.log(img.className);
        }

    </script>

@php
    use App\ProductImage;

    $image = ProductImage::where('productID', '=', $productID)->first()['productImage'];
@endphp

    <div class='content container'>
        <form class='form-horizontal text-center'>
            <div class='row'>
                <div class='col-sm-8'>
                    <div class='row text-center'>
                         <img class='productBig' src="{{ asset('img/products/' . $image) }} " />
                    </div>
                    <div class='row'>
                        <img class='productSmall' src="{{ asset('img/products/alwaysWatching.jpg') }} " onmouseenter="bigImg(this)" onmouseleave='smallImg(this)' />
                        <img class='productSmall' src="{{ asset('img/products/alwaysWatching.jpg') }} " onmouseenter="bigImg(this)" onmouseleave='smallImg(this)' />
                    </div>
                </div>
                <div class='col-sm-4'>
                    <div class='row'>
                        <legend class='col-sm-12 '>{{ $productName }}</legend>
                    </div>
                    <div class='row'>
                        <p class='col-sm-6'>Available: {{ $productQuantity }}</p>
                        <p class='col-sm-6'>$ {{ $productPrice }}</p>
                    </div>
                    <div class='row'>
                        <p class='col-sm-12 text-center'>{{ $productDescription }}</p>
                    </div>
                    <div class='row'>
                        <input class='btn btn-color productSubmit' type='submit' name='add' value='Add to Cart' />
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection