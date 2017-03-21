<form action="{{ url('cart') }}" method='post' class='product col-sm-4 text-center'>
	{{ csrf_field() }}
	<a href='{{url("product/$product->productID")}}'>
		<div class='row'>
			<legend class='col-sm-12'>
				{{ $product->productName }}
			</legend>
		</div>
		<div class='row'>
			<img class='productImage' src="{{ asset('img/products/alwaysWatching.jpg') }} "/>
		</div>
	</a>
	<br>
	<div class='row'>
		<p class='col-sm-6'>Available: {{ $product->productQuantity }}</p>
		<p class='col-sm-6'>$ {{ $product->productPrice }}</p>
	</div>
	<div class='row'>
		<label for='toBuy' class='control-label col-sm-6'>Quantity:</label>
		<input class='form-control quantityInput col-sm-6' type='number' id='toBuy' name='toBuy' value='1' max='{{ $product->productQuantity }}' step='1' min='1'>
	</div>
	<br>
	<div class='row'>
		<input type='text' id='productID' name='productID' value="{{ $product->productID }}" class='form-control hidden'/>
		<input class='btn btn-color productSubmit' type='submit' name='add' value='Add to Cart' />
	</div>
</form>