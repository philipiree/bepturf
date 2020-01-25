<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use RealRashid\SweetAlert\Facades\Alert;
//use DB;
class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$product = DB::select('select * from products );
        //$products = Product::all();
        //$products = Product::orderBy('created_at','desc')->get();
        $products = Product::orderBy('created_at','desc')->paginate(10);
        return view('admin.productsview')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        //$select = Category::pluck('name', 'id');

        return view('admin.createproduct')->with('category', $categories);


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'name' => 'required|unique:products',
            'maker' => 'required',
            'flavor' => 'required',
            'description' => 'required',
            'price' => 'required',
            'size' => 'required',
            'strength' => 'required',
            'quantity' => 'required',
            'display_image' => 'image|nullable|max:1999'
        ]);

        //handling file upload

        if($request->hasFile('display_image')){
            //get file name with extension
            $filenameWithExt = $request->file('display_image')->getClientOriginalName();
            //get just file name
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //get just extension
            $extension = $request->file('display_image')->getClientOriginalExtension();
            //Create a file name to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //Upload image

            $path = $request->file('display_image')->storeAs('public/display_images', $fileNameToStore);
        }else{
            $fileNameToStore = 'noimage.jpg';
        }



        $product = new Product;
        $product->name = $request->input('name');
        $product->maker = $request->input('maker');
        $product->flavor = $request->input('flavor');
        $product->description = $request->input('description');
         //$product->category_id = $request->input('category_id');
        $product->price = $request->input('price');
        $product->size = $request->input('size');
        $product->strength = $request->input('strength');
        $product->quantity = $request->input('quantity');
        $product->display_image = $fileNameToStore;

        $tag_ids = $request->input('category_id');



        //$post->tag()->sync([$tag_id]);

        $product->save();

        $product->categories()->sync([$tag_ids]);



        return redirect('/listedproducts')->with('success', 'Product Created');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $products = Product::find($id);


        return view('admin.productshow')->with('product', $products);
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
        $products = Product::find($id);
        $categories = Category::all();
        $select = array();

        foreach ($categories as $category) {
           $select[$category->id] = $category->name;
        }
        return view('admin.editproduct')->with('product', $products)->withCategories($select);
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
        $this->validate($request, [
            'name' => 'required',
            'maker' => 'required',
            'flavor' => 'required',
            'description' => 'required',
            'price' => 'required',
            'size' => 'required',
            'strength' => 'required',
            'quantity' => 'required'
        ]);

         if($request->hasFile('display_image')){
            //get file name with extension
            $filenameWithExt = $request->file('display_image')->getClientOriginalName();
            //get just file name
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //get just extension
            $extension = $request->file('display_image')->getClientOriginalExtension();
            //Create a file name to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //Upload image

            $path = $request->file('display_image')->storeAs('public/display_images', $fileNameToStore);
        }
        $product = Product::find($id);
        $product->name = $request->input('name');
        $product->maker = $request->input('name');
        $product->flavor = $request->input('flavor');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->size = $request->input('size');
        $product->strength = $request->input('strength');
        $product->quantity = $request->input('quantity');

        if($request->hasFile('display_image')){
            $product->display_image = $fileNameToStore;
        }

        $tag_ids = $request->input('category_id');

        //$post->tag()->sync([$tag_id]);

        $product->categories()->sync([$tag_ids]);
        $product->save();




        return redirect('/listedproducts')->with('update', 'Product Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect('/listedproducts')->with('error','Successfully Deleted');
    }



    public function viewer()
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


        return view('pages.collections')->with([

            'products' => $products,
            'categories' => $categories,
            'categoryName' => $categoryName,

            ]);
    }

    public function display($id)
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

        $products = Product::find($id);
        $mightAlsoLike = Product::where('id', '!=', $id)->inRandomOrder()->take(4)->get();

        return view('pages.display')->with([
            'product' => $products,
            'categories' => $categories,
            'mightAlsoLike' => $mightAlsoLike,

        ]);
    }
}
