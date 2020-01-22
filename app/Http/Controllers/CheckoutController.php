<?php

namespace App\Http\Controllers;

use Cart;
use App\Order;
use App\Product;
use App\Category;
use App\OrderProduct;
use Illuminate\Http\Request;


class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        {
            if(request()->category){

                $products = Product::with('categories')->whereHas('categories', function($query){
                $query->where('name', request()->category);
                });
                $categories = Category::all();
                $categoryName = optional($categories->where('name', request()->category)->first())->name;

            }else{
                //$products = Product::where('featured', true);
                $products = Product::take(12);
                $categories = Category::all();
                $categoryName = 'Featured';
            }


            if(request()->sort == 'low_high'){
                $products = $products->orderBy('price')->paginate(8);
            }elseif(request()->sort == 'high_low'){
                $products = $products->orderBy('price','desc')->paginate(8);
            }elseif(request()->sort == 'a_z'){
                $products = $products->orderBy('name')->paginate(8);
            }elseif(request()->sort == 'z_a'){
                $products = $products->orderBy('name','desc')->paginate(8);
            }elseif(request()->sort == 'n_o'){
                $products = $products->orderBy('created_at')->paginate(8);
            }elseif(request()->sort == 'o_n'){
                $products = $products->orderBy('created_at','desc')->paginate(8);
            }else{
                $products = $products->paginate(8);
            }

            return view('pages.checkout')->with([

                'products' => $products,
                'categories' => $categories,
                'categoryName' => $categoryName,
                'data' => Cart::content(),
                ]);
            }


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
        $this->validate($request, [
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'city' => 'required',
            'province' => 'required',
            'zip' => 'required|digits:4',
            'phone' => 'required|',
        ]);

        $contents = Cart::content()->map(function($item){
            return $item->qty;
        })->values()->toJson();

        //inserting into orders table


        $order = new Order;
        $order->user_id = auth()->user() ? auth()->user()->id : null;
        $order->billing_email = $request->input('email');
        $order->billing_fname = $request->input('fname');
        $order->billing_lname = $request->input('lname');
        $order->billing_address = $request->input('address');
        $order->billing_city = $request->input('city');
        $order->billing_province = $request->input('province');
        $order->billing_zip = $request->input('zip');
        $order->billing_phone = $request->input('phone');
        $order->billing_subtotal = Cart::subtotal();
        $order->billing_total = Cart::subtotal();

        $order->save();

        //inserting into order product table

        foreach(Cart::content() as $item){

            $product = new OrderProduct;
            $product->order_id = $order->id;
            $product->product_id = $item->id;
            $product->strength = $item->options->strength;
            $product->quantity = $item->qty;
            $product->size = $item->options->size;
            $product->name = $item->name;

            $product->save();
        }

        //SUCCESSFUL ORDER
        Cart::instance('default')->destroy();

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

    public function getNumbers(){
        $newSubtotal = Cart::subtotal();
        $newTotal = $newSubtotal;

        return collect([
            'newSubtotal' => $newSubtotal,
            'newTotal' => $newTotal,
        ]);
    }
}
