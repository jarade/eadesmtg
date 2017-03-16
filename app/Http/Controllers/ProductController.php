<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\CardEdition;
use App\CardType;
use App\Product;
use App\ProductImage;

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
        /*$validator = Validator::make($request->all(),[
            'productName' => Rule:unique('products')->where(function($query){
                $query->where('productID', 'cardeditions.productID');
            }),
        ]);*/
/*
        if($validator->fails()){
            return redirect('product/create')
                            ->withErrors($validator)
                            ->withInput();
        }*/
        $target_dir = asset('img/products');
        $target_file = $request->images;
        /*if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }*/
        var_dump($target_file);
        exit();

        $product = new Product;
        $product->productName = $request->productName;
        $product->productDescription = $request->description;
        $product->productPrice = $request->price;
        $product->productQuantity = $request->quantity;
        $product->productType = $request->type;

        $product->save();

        if($request->type == 'Card'){
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
        //
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
}
