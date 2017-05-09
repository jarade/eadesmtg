@php 
    use App\Product;
    use App\ProductType;

	session()->put('pagLimit', 5);
@endphp

<div id='results' class='row'>
	<div class='row'>
    	<h2 class='col-sm-12'>Search Results - {{ session('term') }}</h2>
		
		@each('includes.product', session('results'), 'product')

    </div>

    <div class='row'>
    	{{ session('results')->links() }}
    </div>
</div>