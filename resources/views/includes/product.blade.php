<form class='product col-sm-4 text-center'>
	<a href='product/{{ $product->productID }}'><div class='row'>
		<legend class='col-sm-12'>{{ $product->productName }}</legend>
		</div>
		<div class='row'>
			<img class='productImage' src="{{ asset('img/products/alwaysWatching.jpg') }} "/>
		</div>
	</a>
	<div class='row'>
		<p class='col-sm-6'>Available: {{ $product->productQuantity }}</p>
		<p class='col-sm-6'>$ {{ $product->productPrice }}</p>
	</div>
	<div class='row'>
		<input class='btn btn-color productSubmit' type='submit' name='add' value='Add to Cart' />
	</div>
</form>

<!-- <form class='product col-sm-4 text-center'>
	<div class='row'>
		<legend class='col-sm-12'>Always Watching</legend>
	</div>
	<div class='row'>
		<img class='productImage' src="{{ asset('img/products/alwaysWatching.jpg') }} "/>
	</div>
	<div class='row'>
		<p class='col-sm-6'>Available: 5</p>
		<p class='col-sm-6'>$00.00</p>
	</div>
	<div class='row'>
		<input class='btn btn-color productSubmit' type='submit' name='add' value='Add to Cart' />
	</div>
</form> -->