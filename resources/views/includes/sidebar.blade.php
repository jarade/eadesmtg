<div class="sidebar clearfix">
	<a href="http://magic.wizards.com"><img src="{{ asset('img/design/MTG_Logo.png') }}" alt="mtg logo" ></a>
	<h1>Browse Products</h1>
	
	<ul class="list-unstyled">
		
		@php
			use App\ProductType;

			$types = ProductType::all();

			foreach($types as $type){
				echo '<li>';
				echo '<form action="' . url('product/search') . '" method="POST">';
				echo csrf_field();
				echo '<input type="hidden" name="searchType" class="form-control input-lg" value="typeSearch">';
				echo '<input type="hidden" name="search" value="' . $type->typeID . '">';
				echo '<input class="sideNav" type="submit" name="submit" value="' . $type->type . '">';
				echo '</form></li>';
			}
		@endphp
		</form>
	</ul>
</div>