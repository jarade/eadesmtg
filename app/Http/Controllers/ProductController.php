<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\CardEdition;
use App\CardType;
use App\Product;
use App\ProductImage;
use App\ProductType;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view("search");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('addProduct');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message = array();

        if(count($request->images) > 0){
            $imagePath = public_path() . '\img\products\\';
            $issue = false;
            $images = array();

            foreach($request->file('images') as $uploadedImage){
                $fileName = $uploadedImage->getClientOriginalName();
                
                if (File::exists($imagePath . $fileName)){ 
                    $issue = true;
                    array_push($message, 'The image ' . $fileName . ' is already located in the products folder. Please check the folder and use a different name.');
                }else{
                    array_push($images, $uploadedImage);
                }
            }

            if($issue){
                return redirect('product/create')
                    ->with('status', $message);  
            }else{
                foreach($images as $img){
                    $fileName = $img->getClientOriginalName();
                    $img->move($imagePath, $fileName);
                }
            }
            array_push($message, 'Images have successfully been uploaded.');
            return redirect('product')
                ->with('status', $message);
            /*
            
            if (File::exists($imagePath . $fileName)){   
                return redirect('product/create')
                    ->with('status', 'duplicate');  
            }

            $request->file('images')[0]->move($imagePath, $fileName);
*/
            //var_dump($request->file('images')[0]->getRealPath());
            
        }

        $product = new Product;
        $product->productName = $request->productName;
        $product->productDescription = $request->description;
        $product->productPrice = $request->price;
        $product->productQuantity = $request->quantity; 
        $product->productType = $request->type;

        $product->save();

        if($request->type == 1){ // Card product type
            $editions = new CardEdition;
            $editions->cardEdition = $request->edition;
            $editions->productID = $product->productID;
            $editions->save();

            foreach(json_decode($request->types) as $type){
                $cardType = new CardType;
                $cardType->productID = $product->productID;
                $cardType->Type = $type;
                $cardType->save();
            }
        }
        //redirect('product/create')
          // /          ->with('status', 'Inserted');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if($id == 'search'){
            return view('search', ['search' => "search"]);
        }
        // If $id is a type then show relevant products.
        foreach(ProductType::all() as $type){
            if($type->type == $id){
                return view('search', ['type' => $type->typeID]);
            }
        }

        return view('viewProduct', Product::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Show the results of a search.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $results = Product::where('productName', 'LIKE', '%' . $request->search . '%')->get();

        return view('search', ['search' => $results, 'term' => $request->search]);
    }
}
