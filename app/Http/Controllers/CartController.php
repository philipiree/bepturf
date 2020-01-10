<?php

namespace App\Http\Controllers;

use Cart;
use App\Product;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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



        return view('pages.cart')->with([

            'products' => $products,
            'categories' => $categories,
            'categoryName' => $categoryName,

            ]);
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

        $duplicates = Cart::search(function ($cartItem, $rowId) use ($request){
            return $cartItem->id === $request->id;
        });

        if($duplicates->isNotEmpty()){
            return redirect()->route('cart.index')->with('success', 'Item is already in your cart!');
        }


        $qty = $request->input('quantity');
        $str = $request->input('strength');
        $size = $request->input('size');
        $id = $request->id;
        $info = Product::find($id);


        $data['qty']=$qty;
        $data['id']=$info->id;
        $data['name']=$info->name;
        $data['price']=$info->price;
        $data['weight']=0;
        $data['options']['image']=$info->display_image;
        $data['options']['size']=$size;
        $data['options']['strength']=$str;


        Cart::add($data);

        // Cart::add($request->id, $request->name, $request->input('quantity'), $request->price , [$request->display_image])
            // ->associate('App\Product');

        // dd(Cart::add($request->id, $request->name, $request->input('quantity'), $request->price, 1, [])
        //     ->associate('App\Product'));

        return redirect()->route('cart.index');
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
         $validator = Validator::make($request->all(),[
             'quantity' => 'required|numeric|1,5'
         ]);

        //  if($validator->fails()){
        //      session()->flash('errors', collect(['Quantity must be between 1-5']));
        //      return response()->json(['success' => false], 400);
        // }

        Cart::update($id, $request->quantity);

        session()->flash('success_message', 'Quantity was updated successfully');
        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::remove($id);

        return back();
    }


}
