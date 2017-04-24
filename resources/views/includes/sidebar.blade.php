<div class="sidebar clearfix">
	<a href="http://magic.wizards.com"><img src="{{ asset('img/design/MTG_Logo.png') }}" alt="mtg logo" ></a>
	<h1>Browse Products</h1>
	
	<ul class="list-unstyled">
		@php
			use App\ProductType;

			$types = ProductType::all();

			foreach($types as $type){
				echo '<li><h3><a href="' . url('product/' . $type->type ) .  '">';
				echo $type->type;
				echo '</a></h3></li>';
			}
		@endphp
	</ul>
</div>