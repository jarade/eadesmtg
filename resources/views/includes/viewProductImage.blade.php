<script>
	var prevImg;
    function bigImg(img){
    	// set prevImg for first time use.
		if(prevImg == undefined){
		    prevImg = $("#firstImg");
		}

		prevImg.toggleClass('unselected');
		$(img).toggleClass('unselected');

        $("#displayImage").attr("src", img.src);
    	prevImg = $(img);
    }
</script>

@php
	use App\ProductImage;
	$firstImage = ProductImage::where('productID', '=', $image->productID)->first();
@endphp

<img id='{{  $firstImage->imageID == $image->imageID ? "firstImg" : "unselected"  }}' class='productSmall {{ $firstImage->imageID == $image->imageID ? "" : "unselected" }}' src="{{ asset('img/products/' . $image->productImage) }}" 
    onmouseenter="bigImg(this)"/>
