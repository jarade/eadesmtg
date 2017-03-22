<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cart');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   /*
        session()->flush();*/
        $name = Product::find($request->productID)->productName;

        if(session()->has('cart.'.$request->productID)){
            session()->pull('cart.'.$request->productID);
            session()->push('cart.'. $request->productID, ['id' => $request->productID , 'quantity' => $request->toBuy, 'name' => $name]);
            return back()->with('added', 'Successfully updated quantity of product.');
        }else{
            $request->session()->push('cart.'. $request->productID, ['id' => $request->productID , 'quantity' => $request->toBuy, 'name' => $name]);
        }
        return back()->with('added', 'The product has been added to the cart.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('product/'.$id);
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
        $product = Product::find($id);

        $productQuantity = (int)$product->productQuantity;
        $toBuyQuantity = (int)$request->toBuy;
        $validQuantity = ($productQuantity >= $toBuyQuantity);

        if($validQuantity){
            if($toBuyQuantity == 0){
                session()->pull('cart.' . $id);  
                return back()->with('status', "Removed item from cart");
            }
            session()->pull('cart.' . $id);
            session()->push('cart.'. $id, ['id' => $id , 'quantity' => $request->toBuy, 'name' => $product->productName]);   
            return back()->with('status', "Updated item");
        }

        return back()->with('status', 'Failed to update, please check the quantity and try again.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        session()->pull('cart.' . $id);
        return back()->with('status', "removed item");
    }
}
