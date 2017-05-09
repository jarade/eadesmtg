<div class='cartItem row col-sm-12'>
	<div class='col-xs-5 col-sm-5 text-center'>
		<p>{{ $receipt->productName }}</p>
	</div>
	<div class='col-xs-3 col-sm-3 text-center'>
		<p>$ {{ number_format($receipt->productPrice,2) }}</p>
	</div>
	<div class='col-xs-2 col-sm-2 text-center'>
		<p>{{ $receipt->productQuantity }}</p>
	</div>
	<div class='col-xs-2 col-sm-2 text-center'>
	<p>$ {{ number_format($receipt->productQuantity * $receipt->productPrice, 2) }}</p>
	</div>
</div>