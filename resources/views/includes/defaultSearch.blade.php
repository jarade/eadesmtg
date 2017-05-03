@php 
    use App\Product;
    use App\ProductType;


	$search = Product::paginate($plim);
	$term = "All Products";
@endphp

<div id='results' class='row'>
	<div class='row'>
    	<h2 class='col-sm-12'>Search Results - {{ $term }}</h2>
		
		@each('includes.product', $search, 'product')

    </div>
    <div class='row'>
	    {!! $search->links() !!}
    </div>
</div>