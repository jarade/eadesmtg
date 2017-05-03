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

    	@if(session('search'))
			@if(session('term'))
				<h2 class='col-sm-12'>Search Results - {{ session('term') }}</h2>
			
				@each('includes.product', session('search'), 'product')
			@endif
		@endif
    </div>
    <div class='row'>
	    @if(session('search'))
	    	{!! session('search')->links() !!}
	    @endif
    </div>
</div>