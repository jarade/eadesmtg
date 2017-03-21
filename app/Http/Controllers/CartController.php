<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    {   
        if(session()->has('products.cart')){
            $collection = collect(session()->get('products.cart'));

            if(!($collection->contains('id', $request->productID))){
                $request->session()->push('products.cart', ['id' => $request->productID , 'quantity' => $request->toBuy]);
            }else{

                foreach(session()->get('products.cart') as $item){
                    if($item['id'] == $request->productID){
                       /* $cart = session()->pull('products.cart');
                        array_forget($cart, 'id.' . $item['id']);

                        session()->push('products.cart', $cart);*/
                        return back()->with('added', 'Sccessfully updated quantity of product.');
                    }
                }

                /*$request->session()->push('products.cart', ['id' => $request->productID , 'quantity' => $request->toBuy]);
                return back()->with('added', 'Successfully updated quantity of product.');*/
            }
        }else{
            $request->session()->push('products.cart', ['id' => $request->productID , 'quantity' => $request->toBuy]);
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
