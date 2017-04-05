<div id="searchCard" class='row col-sm-11 {{ old("type") != 2 ? "hidden" : "" }}'>
    <h3>Card Search</h3>
    <div>
    	Note: Only shows types and editions of cards in stock.
	    <select class='form-control' name='cardType'>
	   		<option value='all'>All Types</option>
			@php
	    		use App\CardType;

	    		$cardTypes = CardType::groupBy('cardType')->get(['cardType']);

	    		foreach($cardTypes as $cTypes){
	    			echo '<option value="'. $cTypes->cardType . '"';

	    			if(old('cardType') == $cTypes->cardType){
	    				echo ' selected ';
	    			}

	    			echo '>' . $cTypes->cardType .'</option>';
	    		}
	    	@endphp
	    </select>
	    <select class='form-control' name='edition'>
	   		<option value='all'>All Editions</option>
	   		@php
	    		use App\CardEdition;

	    		$cardTypes = CardEdition::groupBy('cardEdition')->get(['cardEdition']);

	    		foreach($cardTypes as $cTypes){
	    			echo '<option value="' . $cTypes->cardEdition . '"';
	    			if(old('edition') == $cTypes->cardEdition){
	    				echo ' selected ';
	    			}
	    			echo '>';
	    			echo $cTypes->cardEdition .'</option>';
	    		}
	    	@endphp
	    </select>
    </div>
</div>