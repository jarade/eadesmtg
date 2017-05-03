@php 
    use App\Product;
  
    $ses = collect($session[0]);
    $product = Product::find($ses->get('id'));
   	
	session()->put('totalPrice', session('totalPrice') + 
		($product->productPrice * $ses->get("quantity")));
@endphp

<div class='cartItem row col-sm-12'>
	
	<div class='col-sm-2 text-center'>
		<form method='post' action='{{ url("cart/" . $ses->get("id")) }}'>
		{{ csrf_field() }}
		{{ method_field('DELETE') }}
			<input class='btn btn-color' type='submit' value='-'>
		</form>
	</div>
	<div class='col-sm-5 text-center'>
		<p>{{ $product->productName }}</p>
	</div>
	<div class='col-sm-3 text-center'>
		<p>$ {{ $product->productPrice }}</p>
	</div>
	<div class='col-sm-2 text-center'>
		<form method='post' action='{{ url("cart/" . $ses->get("id")) }}'>
		{{ csrf_field() }}
		{{ method_field('PUT') }}
			<p>Max: {{ $product->productQuantity }}</p>
			<input required class='form-control cartQuantity' type='number' min='0' step='1' max="{{ $product->productQuantity }}" name='toBuy' value='{{ $ses->get("quantity") }}'>
			<input class='btn btn-color updateCart' type='submit' value='Update'>
		</form>
	</div>
</div>