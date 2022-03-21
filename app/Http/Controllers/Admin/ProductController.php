<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Auth;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('role_or_permission:Product access|Product create|Product edit|Product delete', ['only' => ['index','show']]);
        $this->middleware('role_or_permission:Product create', ['only' => ['create','store']]);
        $this->middleware('role_or_permission:Product edit', ['only' => ['edit','update']]);
        $this->middleware('role_or_permission:Product delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Product= Product::paginate(4);

        return view('product.index',['products'=>$Product]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $data= $request->all();
        // $data['user_id'] = Auth::user()->id;
        // $Product = Product::create($data);

        $name = $request->name;
        $price = $request->price;
        $quantity = $request->quantity;
        $publish = $request->publish;
        $user = Auth::user()->id;

        $image = $request->file('product_image');
        $image_name = time().'.'.$image->extension();
        $image->move(public_path('img'),$image_name);

        $product = new Product();

        $product->name = $name;
        $product->price = $price;
        $product->quantity = $quantity;
        $product->publish = $publish;
        $product->product_image = $image_name;
        $product->user_id = $user;

        $product->save();

        return redirect()->back()->withSuccess('Product created !!!');
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
    public function edit(Product $product)
    {
       return view('product.edit',['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product->update($request->all());

        // $name = $request->name;
        // $price = $request->price;
        // $quantity = $request->quantity;
        // $publish = $request->publish;
        // $user = Auth::user()->id;

        // $image = $request->file('product_image');
        // $image_name = time().'.'.$image->extension();
        // $image->move(public_path('img'),$image_name);

        // $product = new Product();

        // $product->name = $name;
        // $product->price = $price;
        // $product->quantity = $quantity;
        // $product->publish = $publish;
        // $product->product_image = $image_name;
        // $product->user_id = $user;

        // $product->save();

        return redirect()->back()->withSuccess('Product updated !!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->back()->withSuccess('Product deleted !!!');
    }
}
