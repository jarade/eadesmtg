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
    public $paginationLimit = 6;

    private function getPaginationLimit(){
        return $this->paginationLimit;
    }

    private function setPaginationLimit($newValue){
        $this->paginationLimit = $newValue;
        session()->put('paglimit', $this->paginationLimit);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        session()->put('paglimit', $this->getPaginationLimit());

        if(!session()->exists('results')){
            session()->flash('results', Product::all());
        }

        if(!session()->exists('terms')){
            session()->flash('terms', "All Products");
        }

        return view("search");
    }

    /**
     * Show the results of a search.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */
    public function search(Request $request)
    {
        if($request->searchType == "homeSearch"){
            $searchTerm = $request->search;
            $result = Product::where('productName', 'LIKE', '%' . $request->search . '%');

            $something = array('searchTerm' => $searchTerm, 'results' => $result);

            $results = $something['results'];
            session()->flash('terms', $searchTerm);
            session()->flash('results', $results->get());

            $_GET['page'] = 1;
            return redirect('product');
        }else{
            if($request->searchType == 'typeSearch'){
                $searchTerm = ProductType::where('typeID', '=', $request->search)->pluck('type')->first();
                $result = Product::where('typeID', '=', $request->search);

                $something = array('searchTerm' => $searchTerm, 'results' => $result);

                $results = $something['results'];
                session()->flash('terms', $searchTerm);
                session()->flash('results', $results->get());

                $_GET['page'] = 1;
                return redirect('product');
            }else{
                // Filter by search criteria (in description if necessary)
                $something = $this->checkName($request->search, $request->searchIn);

                // Filter the results by the type
                $something = $this->checkType($something['searchTerm'], $something['results'], $request->type, $request->accessoryTypes, $request->cardType, $request->edition);

                $searchTerm = $something['searchTerm'];

                if($searchTerm == ''){
                    $searchTerm = 'No search Criteria Selected. Showing all Results.';
                }
            }
        }

        $results = $something['results'];
        session()->flash('terms', $searchTerm);
        session()->flash('results', $results->get());

        $_GET['page'] = 1;
        return redirect('product')
                ->withInput();
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
        if(session('loggedin')){
            // Check if each image is valid.
            

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

            session()->put('pagLimit', 3);

        }else{
            array_push($message, 'You don\'t have permission to this content. Please make sure you have javascript enabled and log in as an admin.');
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
        // If id sends to search page.
        if($id == 'search'){
            return $this->index();
        }

        // If $id is a type then show relevant products.
        foreach(ProductType::all() as $type){
            if($type->type == $id){/*
                return view('search', ['type' => $type->typeID]);*/

                session()->flash('results', Product::where('typeID' , $type->typeID));

                return redirect('product')
                    ->with('search', Product::where('typeID' , $type->typeID)
                        ->paginate($this->getPaginationLimit()))
                    ->with('term', "Type: " . $type->type);
            }
        }

        // If id is a product then view product
        $product = Product::find($id);

        if(isset($product)){
            return view('viewProduct', $product);
        }

        // If id is not found then handle
        abort(404); 
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

 

    /***
    **  checkname(string, string) - Get the results and searchTerm of the search criteria provided.
    **  Pre: $search - the search criteria | $searchIn - if the product description needs to be checked
    **  Post: array; searchTerm - the terms applied to the filter | results - the results provided by the filter
    ***/
    private function checkName($search, $searchIn){
        $searchTerm = $search;

        // Get all the results determined by terms
        if(isset($searchIn)){
            // sql: WHERE (productName LIKE %search% OR productDescription LIKE %search%)
            $results = Product::where(function($query) use($search){
                $query->where('productName', 'LIKE', '%' . $search . '%');
                $query->orwhere('productDescription', 'LIKE', '%' . $search . '%');
            });

            $searchTerm = $this->addStringDivider($searchTerm) . 'Product Description Inclusive';
        }else{
            $results = Product::where('productName', 'LIKE', '%' . $search . '%');
        }

        return array('searchTerm' => $searchTerm, 'results' => $results);
    }

    /***
    **  checkType(string, eloquent, int, int, int, string) - Get the results and searchTerm of the filters.
    **  Pre:    $searchTerm - the terms applied to the filter | $results - the results provided by the filter
    **          | $type - the typeID of the product | $accType - the typeID of the accessory | $cardType - the cardTypeID of the product | $cardEd - the card edition 
    **  Post: array; searchTerm - the terms applied to the filter | results - the results provided by the filter
    ***/
    private function checkType($searchTerm, $results, $type, $accType, $cardType, $cardEd){
        $something = array('searchTerm' => $searchTerm, 'results' => $results);

        // Check what types need to be filtered.
        if(isset($type)){
            switch($type){
                case 0: break; // Ignore types
                case 1: // Get all non-cards
                    $something = $this->checkAccType($searchTerm, $results, $accType);
                    break;
                case 2: // Cards only
                    $something = $this->checkCardType($searchTerm, $results, $type, $cardType, $cardEd);
                    break;
            }
        }

        return array('searchTerm' => $something['searchTerm'], 'results' => $something['results']);
    }

    /***
    **  checkAccType(string, eloquent, id) - Get the results and searchTerm of the filters.
    **  Pre:    $searchTerm - the terms applied to the filter | $results - the results provided by the filter
    **          $accType - the typeID of the accessory 
    **  Post: array; searchTerm - the terms applied to the filter | results - the results provided by the filter
    ***/
    private function checkAccType($searchTerm, $results, $accType){
        $results = $results->where('typeID', '!=', 2); // 2 : card->typeID
        $searchTerm = $this->addStringDivider($searchTerm) . 'Accessories Only';

        if($accType != 0){
            $results = $results->where('typeID', '=', $accType);
            $searchTerm = $this->addStringDivider($searchTerm);
            $searchTerm .= ProductType::where('typeID', '=', $accType)->first()->type;
        }

        return array('searchTerm' => $searchTerm, 'results' => $results);
    }

    /***
    **  checkType(string, eloquent, int, int, string) - Get the results and searchTerm of the filters.
    **  Pre:    $searchTerm - the terms applied to the filter | $results - the results provided by the filter
    **          | $type - the typeID of the product | $cardType - the cardTypeID of the product | 
    **          $cardEd - the card edition 
    **  Post: array; searchTerm - the terms applied to the filter | results - the results provided by the filter
    ***/
    private function checkCardType($searchTerm, $results, $type, $cardType, $cardEd){
        $results = $results->where('typeID', '=', $type);
        $searchTerm = $this->addStringDivider($searchTerm) . 'Cards Only';

        if($cardType != 'all'){
            $searchTerm = $this->addStringDivider($searchTerm) . $cardType;

            $cardTypes = CardType::where('cardType', '=', $cardType);
            
            $list = array();

            foreach($cardTypes->get() as $ct){
                array_push($list, $ct->productID);
            }
            $results = $results->whereIn('productID', $list);
            
        }

        if($cardEd != 'all'){
            $searchTerm = $this->addStringDivider($searchTerm) . $cardEd;

            $cardEds = CardEdition::where('cardEdition', '=', $cardEd);
            
            $edList = array();

            foreach($cardEds->get() as $ce){
                array_push($edList, $ce->productID);
            }
            $results = $results->whereIn('productID', $edList);
        }

        return array('searchTerm' => $searchTerm, 'results' => $results);
    }
    /***
    **  addStringDivider(string) - Add a divider to a string.
    **  Pre: $s - string to be altered
    **  Post: $s - string after adding ' | ' 
    ***/
    private function addStringDivider($s){
        if($s != ''){
                $s .= ' | '; 
        }
        return $s;   
    }
}
