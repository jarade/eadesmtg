@extends('layouts.app')

@section('title', 'EadesMTG')

@section('content')

<script>
	var expanded = false;

	function showCheckboxes() {
		var checkboxes = document.getElementById("checkboxes");
		if(!($('#types').attr('disabled'))){
			if (!expanded) {
				checkboxes.style.display = "block";
				expanded = true;
			} else {
				checkboxes.style.display = "none";
				expanded = false;
			}
		}
	}

	function setEmpty(){
		$('#cardText').html('');
		$('#input-name').val('');
		$('#input-description').val('');
		$('#input-edition').html('');
		$('#checkboxes').html('');
	}

	function caseCheck(toEdit){
		var exceptions = ['the', 'of', 'to'];

		var splitStr = toEdit.toLowerCase().split(' ');
		for(var i = 0; i < splitStr.length; i++){
			if(i != 0){
				var disallow = false;;
				for(var e = 0; e < exceptions.length; e++){
					if(splitStr[i] == exceptions[e]){
						 disallow = true;
					}
				}

				if(!disallow){
					splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);
				}
			}else{
				splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1); 
			}
		}
		return splitStr.join(' ');;
	}
	function checkCard(){
		event.preventDefault();
		setEmpty();
		if($('#input-card').val() == ''){
			$('#cardText').append('<p>Please do not leave this blank</p>');
		}else{
			var cardName = caseCheck($('#input-card').val());

			$.getJSON('{{ asset("json/AllCards-x.json") }}', function(card){
				if(typeof(card[cardName]) === 'undefined'){
					$('#cardText').html('<p>The card cannot be found. Please check the name and try again.</p>');
				}else{
					$('#input-name').val(card[cardName].name);
					$('#input-description').val(card[cardName].text);
					$('#input-edition').attr('disabled', false);
					$('#types').attr('disabled', false);
					$('#input-type').val('2').change();
					var allTypes = [];

					if(card[cardName].supertypes){
						card[cardName].supertypes.forEach(function(supertype){
							allTypes.push(supertype); 
						});
					}
					if(card[cardName].subtypes){
						card[cardName].subtypes.forEach(function(subtype){
							allTypes.push(subtype);
						});
					}
					card[cardName].types.forEach(function(type){
						allTypes.push(type);
					}); 

					$.getJSON('{{ asset("json/AllSets.json") }}', function(set){
						card[cardName].printings.forEach(function(item){
							var setName = set[item].name;
							$('#input-edition').append('<option value="' + setName + '">' + setName + '</option');
						}); 
					});

					$('#cardtypes').val(JSON.stringify(allTypes));
				}
			});
		}
	}
</script>
	
	<div class='content container'>
		<h1>Add Product</h1>

		@if (session('status'))
    		<div class="alert alert-success">
			@foreach (session('status') as $msg)
        		<p> {{ $msg }} </p>
    		@endforeach
    		</div>
		@endif

		<form class='form-horizontal'>
			<fieldset>
				@php 
					if($errors->any()){
						foreach ($errors->all() as $message) {
							echo $message;
						}
					}
				@endphp
				<legend class='productLegend'>Use Name for Card Product</legend>
				<div class="form-group required">
					<label class="col-sm-2 control-label" for="input-card">Card Name: </label>
					<div class="col-sm-10">
						<input required type="text" name="cardName" id="input-card" class="form-control" placeholder="Place card name here..." /><br>
						<div id='cardText' class="text-danger"></div>
					</div>
				</div>

				<div class="buttons">
					<div class="pull-right">
						<input class="btn btn-color" type="submit" value="Check Name" onclick='checkCard()'/>
					</div>
				</div>

			</fieldset>
		</form>

		<br>
		<form action='{{ url("product") }}' method='post' class="form-horizontal" files='true' enctype="multipart/form-data">
		 {{ csrf_field() }}
			<fieldset>
				<legend class='productLegend'>Add Product Details</legend>
				<div class="form-group required">
					<label class="col-sm-2 control-label" for="input-name">Product Name: </label>
					<div class="col-sm-10">
						<input required type="text" name="productName" id="input-name" class="form-control" placeholder="Product Name" value="{{ old('productName') }}"/>
					</div>
				</div>

				<div class="form-group required">
					<label class="col-sm-2 control-label" for="input-description">Product Description: </label>
					<div class="col-sm-10">
						<textarea required name="description" rows="10" id="input-description" class="form-control" placeholder="Product Description">{{ old('description') }}</textarea>
						<div class="text-danger"></div>
					</div>
				</div>

				<div class="form-group required">
					<label class="col-sm-2 control-label" for="input-type">Product Type: </label>
					<div class="col-sm-10">
						<select required name="type" id="input-type" class="form-control" >
							<option default value=''>Select Type</option>
							@php
								use App\ProductType;

								$types = ProductType::all();

								foreach($types as $type){
									echo '<option value="' . $type->typeID . '"';
									if(old('type') == $type->typeID){
										echo 'selected';
									}
									echo '>' . $type->type . '</option>';
								}

							@endphp
							
						</select>
					</div>
				</div>
			</fieldset>
			<fieldset>
				<legend class='productLegend'>Add Sales Details</legend>
				<div class="form-group required">
					<label class="col-sm-2 control-label" for="input-price">Product Individual Price: </label>
					<div class="col-sm-10">
						<input required type="number" step='.01' min='0.01' name="price" id="input-price" class="form-control" placeholder="Product Price" />
					</div>
				</div>

				<div class="form-group required">
					<label class="col-sm-2 control-label" for="input-quantity">Product Quantity: </label>
					<div class="col-sm-10">
						<input required type="number" step='1' min='0' name="quantity" id="input-quantity" class="form-control" placeholder="Product Quantity" />
					</div>
				</div>

			</fieldset>

			<fieldset>
				<legend class='productLegend'>Add Card Details (opt)</legend>
				<div class="form-group required">
					<label class="col-sm-2 control-label" for="input-edition">Card Edition: </label>
					<div class="col-sm-10">
						<select name="edition" id="input-edition" class="form-control" disabled>
						</select>

						<input class='hidden' type='text' name='types' id='cardtypes' value=''/>
					</div>
				</div>
			</fieldset>

			<br>

			<fieldset>
				<legend class='productLegend'>Add Images (opt)</legend>
				<div class="form-group required">
					<label class="col-sm-2 control-label" for="input-image">Images: </label>
					<div class="col-sm-10">
						<input type='file' name="images[]" id="input-image" class="form-control" accept='image/*' multiple />
						<div id='imageList'>
							<input type='text' name='imageList' id='imageSources' value='' class='hidden'/>
						</div>
					</div>
				</div>
			</fieldset>

			<div class="buttons">
				<div class="pull-right">
					<input class="btn btn-color" type="submit" value="Submit" />
					
				</div>
			</div>
		</form>
    </div>

    <script>
   	function handleFileSelect(evt) {
	    var files = evt.target.files; // FileList object
		if(files.length > 0){
			$('#imageList').html('');
		}
	    // Loop through the FileList and render image files as thumbnails.
	    for (var i = 0, f; f = files[i]; i++) {

	      // Only process image files.
	      if (!f.type.match('image.*')) {
	        continue;
	      }
	      var allImages = [];
	      var reader = new FileReader();

	      // Closure to capture the file information.
	      reader.onload = (function(theFile) {
	        return function(e) {
	          // Render thumbnail.
	          allImages.push(e.target.result);
	          $('#imageList').append('<img class="thumb" src="' + e.target.result +
	                            '" title="' + escape(theFile.name) + '"/>');
	        };
	      })(f);

	      // Read in the image file as a data URL.
	      reader.readAsDataURL(f);
	    }

	    $('#imageSources').val( $('#imageSources').val() + JSON.stringify(allImages));
	}

  document.getElementById('input-image').addEventListener('change', handleFileSelect, false);
</script>
@endsection