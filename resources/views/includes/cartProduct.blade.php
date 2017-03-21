@php 
    use App\Product;

    $product = Product::find($session['id'])
@endphp

<div class='cartItem row col-sm-12 text-center'>
	<div class='col-sm-2'>
		<input class='btn btn-color' type='submit' value='-'>
	</div>
	<div class='col-sm-5'>
		<p>{{ $product->productName }}</p>
	</div>
	<div class='col-sm-3'>
		<p>${{ $product->productPrice }}</p>
	</div>
	<div class='col-sm-2'>
		<input class='form-control' type='text' value='{{ $session["quantity"] }}'>
	</div>
</div>
