
<div class='row col-sm-11'>
    <h3>Card Search</h3>
    <div>
    	Note: Only shows types and editions of cards in stock.
	    <select class='form-control' name='cardType'>
	   		<option value='all'>All Types</option>
			@php
	    		use App\CardType;

	    		$cardTypes = CardType::groupBy('cardType')->get(['cardType']);

	    		foreach($cardTypes as $cTypes){
	    			echo '<option value="'. $cTypes->cardType .'">'. $cTypes->cardType .'</option>';
	    		}
	    	@endphp
	    </select>
	    <select class='form-control' name='edition'>
	   		<option value='all'>All Editions</option>
	   		@php
	    		use App\CardEdition;

	    		$cardTypes = CardEdition::groupBy('cardEdition')->get(['cardEdition']);

	    		foreach($cardTypes as $cTypes){
	    			echo '<option value="'. $cTypes->cardEdition .'">'. $cTypes->cardEdition .'</option>';
	    		}
	    	@endphp
	    </select>
    </div>
</div>