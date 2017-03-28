<div class='row col-sm-11'>
    <h3>Accessory Search</h3>
    <div>
    <select class='form-control' name='accessoryTypes'>
    	<option value='0'>All types</option>
    	@php
    		use App\ProductType;

    		$accessoryTypes = ProductType::where('type', '!=', 'Card')->get();

    		foreach($accessoryTypes as $aTypes){
    			echo '<option value="' . $aTypes->typeID . '">' . $aTypes->type . '</option>';
    		}
    	@endphp
    </select>
    </div>
</div>