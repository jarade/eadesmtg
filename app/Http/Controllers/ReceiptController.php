<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Receipt;
use App\ReceiptProduct;
use App\Product;

class ReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('receipt');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
    //     try{
        	// Decode the Item List
        	$products = htmlspecialchars_decode($request->items);
        	$arr = json_decode($products);

        	// Create a new receipt
        	$receipt = new Receipt;
        	$receipt->save();

        	// Create a receipt product entry foreach item in list
        	foreach($arr as $key => $value){
                $receiptProduct = new ReceiptProduct;

                $receiptProduct->receiptID = $receipt->receiptID;
                $receiptProduct->productName = $value[0]->name;
                $receiptProduct->productPrice = Product::where('productID', '=', $value[0]->id)->pluck('productPrice')->first();

                $receiptProduct->productQuantity = $value[0]->quantity;

                $receiptProduct->save();
            }
        
            $postage = new ReceiptProduct;

            $postage->receiptID = $receipt->receiptID;
            $postage->productName = "Postage";
            $postage->productPrice = $request->postage;
            $postage->productQuantity = 1;
            $postage->save();
            
            session()->flash('id', $receipt->receiptID);
            return json_encode(array(1,1,1));
       /* }catch(Exception $e){
            return json_encode(array('message' => $e->getMessage());
        }*/
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
    }
}
