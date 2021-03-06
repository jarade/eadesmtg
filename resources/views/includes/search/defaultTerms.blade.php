<div class='row col-sm-12'>
	<div class='row col-sm-12'>
		<div class='col-sm-2 text-left'>
	    	<label class='control-label text-left' for="search">Search: </label> 
	    </div>
	    <div class='col-sm-10'>
	    	<input class='form-control' type="text" id='search' name="search" placeholder="Enter your search..." value="{{ (session('old')) ? session('old')['search'] : '' }}"/>
	    </div>
 	</div>

 	<div class='row col-sm-12'>
 		<br>
 		<div class='col-sm-8 text-left'>
	    	<label class='control-label' for="searchIn">Search in product description: </label>
	    </div>
	    <div class='col-sm-2 pull-right'>
	   		<input class='form-control' type="checkbox" id='searchIn' name="searchIn" value="checked" {{ 
	   			session('old') ? 
	   				( array_key_exists('searchIn', session('old')) ? 
	   					session('old')['searchIn'] 
	   				: '' ) 
	   			: '' 
	   			}}/>
	    </div>
    </div>
</div>

<div class='row col-sm-12'>
	<br>
	<div class='col-sm-2'></div>
	<div class='col-sm-9'> 
	    <select class='form-control' name="type" onchange="showSearchCriteria(this)">
	    	<option value="0" {{ session('old') ? (session('old')['type'] == 0 ? 'selected' : "") : '' }}>All Product Types</option>
	    	<option value="1" {{ session('old') ? (session('old')['type'] == 1 ? 'selected' : "") : '' }}>Accessories Only</option>
	    	<option value="2" {{ session('old') ? (session('old')['type'] == 2 ? 'selected' : "") : '' }}>Cards Only</option>
	    </select>
    </div>
</div>

<script>
	function showSearchCriteria(option){
		// hide all criterias.
		$('#searchAcc').addClass('hidden');
		$('#searchCard').addClass('hidden');

		// Show the relevant Criteria
		switch(parseInt(option.value)){
			default: 	
				break;
			case 1: 
				$('#searchAcc').removeClass('hidden');
				break;
			case 2: 
				$('#searchCard').removeClass('hidden');
				break;
		}
	}
</script>