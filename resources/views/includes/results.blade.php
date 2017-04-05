@php 
    use App\Product;
    use App\ProductType;
@endphp

<div id='results' class='row'>
	<div class='row'>
		@if (session('added'))
			<div class='row alert alert-success col-sm-12'> 
        		<p>{{ session('added') }} </p>
        	</div>
    	@endif

		@if(isset($type))
			<h2 class='col-sm-12'>Product: {{ ProductType::where('typeID', '=', $type)->first()->type }}</h2>
			@each('includes.product', Product::where('typeID' , $type)->get(), 'product')
		@else
			@if(session('search'))
				@if(session('term'))
					<h2 class='col-sm-12'>Search Results - {{ session('term') }}</h2>
				
					@each('includes.product', session('search'), 'product')
				@endif
			@else
	        	@if (!session('status'))
	        		<h2 class='col-sm-12'>All Products</h2>
		            @each('includes.product', Product::all(), 'product')
		        @endif
		    @endif
        @endif
    </div>    
</div>