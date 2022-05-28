<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Product;

class ShoppingCartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart=session()->get('cart.id', 'default');
        $products = [];
        $amounts=session()->get('cart.amounts', 'default');

        if ($cart > 0) {
            foreach ($cart as $cart => $id) {
                $products[] = Product::where('id', $id)->first();
            }
        }

        return view('shop.cart', compact('products', 'amounts'));
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
    /*
    public function storeInicial(Request $request)
    {

        $products = session()->get('cart');

        // Hace que no se puedan repetir productos
        if ($products > 0) {
            if (($key = array_search($request->id, $products)) !== false) {
                // dd($products);
                return back();
            }
        }
        $request->session()->push('cart', intval($request->id));
        // $request->session()->push('cart.amount', 1);
        // dd($request->session()->all());
        return back();
    }
    */

    public function store(Request $request)
    {

        $products = session()->get('cart.id');
        $amounts = session()->get('cart.amounts');

        // Hace que no se puedan repetir productos
        if ($products > 0) {
            if (($key = array_search($request->id, $products)) !== false) {
                $savedAmounts = $amounts;
                $savedAmounts[$key] = $savedAmounts[$key] + 1;
                $request->session()->forget('cart.amounts');
                foreach ($savedAmounts as $key => $value) {
                    $request->session()->push('cart.amounts', $value);
                }


                // dd($request->session()->all());
                return back();
            }
        }
        $request->session()->push('cart.id', intval($request->id));
        $request->session()->push('cart.amounts', 1);
        // dd($request->session()->all());
        return back();
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        /*
        $cart=session()->get('cart', $product->id);
        dd($cart);

        return $cart;
        */
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
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $products = session()->get('cart.id');
        $amounts = session()->get('cart.amounts');

        // esto mira dentro del array de productos si hay alguno con la id del producto a eliminar
        if (($key = array_search($id, $products)) !== false) {
            unset($products[$key]);
            unset($amounts[$key]);
        }

        $request->session()->put('cart.id', $products);
        $request->session()->put('cart.amounts', $amounts);
        // dd($request->session()->all());

        return back();
    }

    public function removeAll(Request $request)
    {
        $request->session()->forget('cart.id');
        $request->session()->forget('cart.amounts');

        return view('shop');
    }

}
