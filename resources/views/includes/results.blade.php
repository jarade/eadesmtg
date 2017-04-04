@php 
    use App\Product;
@endphp

<div id='results' class='row'>
	<div class='row'>
		@if (session('added'))
			<div class='row alert alert-success col-sm-12'> 
        		<p>{{ session('added') }} </p>
        	</div>
    	@endif

		@if(isset($type))
			<h2 class='col-sm-12'>All {{ $type }}</h2>
			@each('includes.product', Product::where('typeID' , $type)->get(), 'product')
		@else
			@if(isset($search))
				{{$search}}
				@if(isset($term))
					<h2 class='col-sm-12'>Search Results - {{ $term }}</h2>
				
					@each('includes.product', $search, 'product')
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