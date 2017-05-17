@php 
    use App\Product;
    use App\ProductType;

    // This could be different if a Paginator class was created.
    $result = Product::where('productID', 0);

    foreach(session('results') as $som){
        $result = $result->orWhere('productID', '=', $som->productID);
    }

    session()->put('pagLimit', 3); // to be removed
    $pag = $result->paginate(session('pagLimit'));
@endphp

<div id='results' class='row'>
    <div class='row'>
        <h2 class='col-sm-12'> Search Results - {{ session('terms') }} <legend>{{ 
            ($pag->total() > 1) ? '(' . $pag->total() . ') - Results Found' 
            : (($pag->total() == 1) ? '1 Result Found' : 'No Results Found')
            }}</legend></h2>
       

        @each('includes.product', $pag, 'product')

    </div>

    <div class='row text-center'>
        {{ $pag->render() }}
    </div>


</div>