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
        // Check if each image is valid.
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
        }

        $product = new Product;
        $product->productName = $request->productName;
        $product->productDescription = $request->description;
        $product->productPrice = $request->price;
        $product->productQuantity = $request->quantity; 
        $product->typeID = $request->type;


        if($request->type == 2){ // Card product type
            $editions = new CardEdition;
            $editions->cardEdition = $request->edition;    
            
            $cardTypes = array();
            foreach(json_decode($request->types) as $type){
                $cardType = new CardType;
                $cardType->cardType = $type;
                array_push($cardTypes, $cardType);
            }
        }

        if(!$issue){
            $product->save();

            if($request->type == 2){
                $editions->productID = $product->productID;
                $editions->save();

                foreach($cardTypes as $cardType){
                    $cardType->productID = $product->productID;
                    $cardType->save();
                }
            }

            array_push($message, 'The Product is added successfully.');


            // Insert Images
            foreach($images as $img){
                $productImage = new ProductImage;

                $fileName = $img->getClientOriginalName();
                $img->move($imagePath, $fileName);

                $productImage->productID = $product->productID;
                $productImage->productImage = $fileName;

                $productImage->save();
            }
            
            array_push($message, 'Images have successfully been uploaded.');
        }

        return redirect('product/create')
                ->with('status', $message)
                ->withInput();
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
        $searchTerm = $request->search;

        // Get all the results determined by terms
        if(isset($request->searchIn)){
           $results = Product::where('productName', 'LIKE', '%' . $request->search . '%')
                                ->orwhere('productDescription', 'LIKE', '%' . $request->search . '%');

            $searchTerm = $this->addStringDivider($searchTerm) . 'Product Description Inclusive';
        }else{
            $results = Product::where('productName', 'LIKE', '%' . $request->search . '%');
        }

        // Filter the results by the type
        if(isset($request->type)){
            switch($request->type){
                case 0: break; // Ignore types
                case 1: // Get all non-cards
                    $results = $results->where('typeID', '!=', 2); // 2 : card->typeID
                    $searchTerm = $this->addStringDivider($searchTerm) . 'Accessories Only';

                    if($request->accessoryTypes != 0){
                        $results = $results->where('typeID', '=', $request->accessoryTypes);
                        $searchTerm = $this->addStringDivider($searchTerm);
                        $searchTerm .= ProductType::where('typeID', '=', $request->accessoryTypes)->first()->type;
                    }
                    break;
                case 2: // Cards only
                    $results = $results->where('typeID', '=', $request->type);
                    $searchTerm = $this->addStringDivider($searchTerm) . 'Cards Only';

                    if($request->cardType != 'all'){
                        $searchTerm = $this->addStringDivider($searchTerm) . $request->cardType;

                        $cardTypes = CardType::where('cardType', '=', $request->cardType);
                        
                        $list = array();

                        foreach($cardTypes->get() as $ct){
                            array_push($list, $ct->productID);
                        }
                        $results = $results->whereIn('productID', $list);
                        
                    }

                    if($request->edition != 'all'){
                        $searchTerm = $this->addStringDivider($searchTerm) . $request->edition;

                        $cardEds = CardEdition::where('cardEdition', '=', $request->edition);
                        
                        $edList = array();

                        foreach($cardEds->get() as $ce){
                            array_push($edList, $ce->productID);
                        }
                        $results = $results->whereIn('productID', $edList);
                    }
                    break;
            }
        }

        if($searchTerm == ''){
            $searchTerm = 'No search Criteria Selected. Showing all Results.';
        }

        if($request->path() == 'product/search'){
            return back()
                ->with('search', $results->get())
                ->with('term', 'NOT')
                ->withInput();
        
        }else{
            return view('search', ['search' => $results->get(), 'term' => $searchTerm]);
        }

        //return view('search', ['search' => $results->get(), 'term' => $searchTerm]);
    }

    private function addStringDivider($s){
        if($s != ''){
                $s .= ' | '; 
        }
        return $s;   
    }
}
