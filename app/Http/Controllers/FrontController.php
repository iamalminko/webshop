<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductAdded;
use App\Models\ProductDropped;
use App\Models\User;
use Auth;

class FrontController extends Controller
{
    function __construct() {
        $this->middleware('auth', array('except' => array('index', 'shop')));
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $productsOnSale = Product::where('discount' , '!=' , 0)->get();
        $orderdProductsOnSale = [];
        $cartCount = 0;

        if(!Auth::guest())
        {
            $droppedProducts = ProductDropped::where('user_id' , '=' , auth()->user()->id)->get();
            foreach ($droppedProducts as $product) {
                array_push($orderdProductsOnSale, Product::where('id' , '=' , $product->product_id)->get()[0]);
            }
            $cartCount = count(ProductAdded::where('user_id' , '=' , auth()->user()->id)->get());
        }
        foreach ($productsOnSale as $product) {
            if(!in_array($product, $orderdProductsOnSale)) array_push($orderdProductsOnSale, $product);
        }

        return view('pages.home')->with([
            'productsOnSale' => $orderdProductsOnSale,
            'cartCount' => $cartCount]);
    }

    public function shop()
    {
        $products = Product::all();
        $cartCount = 0;
        if(!Auth::guest())
        {
            $cartCount = count(ProductAdded::where('user_id' , '=' , auth()->user()->id)->get());
        }
        return view('pages.shop')->with([
            'products' => $products,
            'cartCount' => $cartCount]);
    }

    public function cart()
    {
        $userID = auth()->user()->id;
        $addedProducts = ProductAdded::where('user_id' , '=' , $userID )->get();
        
        $addedProducts_union = [];
        foreach($addedProducts as $product)
        {
            $info = Product::where('id' , '=' , $product->product_id)->get()[0];
            array_push($addedProducts_union, [
                "id" => $info->id,
                "name" => $info->name,
                "image" => $info->image,
                "price" => $info->price,
                "amount" => $product->amount,
            ]);
        }

        $cartCount = 0;
        if(!Auth::guest())
        {
            $cartCount = count(ProductAdded::where('user_id' , '=' , auth()->user()->id)->get());
        }
        return view('pages.cart')->with([
            'products' => $addedProducts_union,
            'cartCount' => $cartCount]);
    }
    
    public function addToCart($id)
    {
        // Check if product already added by this user
        $userID = auth()->user()->id;
        $existingRecords = ProductAdded::where('user_id' , '=' , $userID )->where('product_id' , '=' , $id )->get();

        if(count($existingRecords) == 0)
        {
            $productAdded = new ProductAdded();
            $productAdded->user_id = $userID;
            $productAdded->product_id = $id;
            $productAdded->amount = 1;
            $productAdded->save();
            //return 'SUCCESS';
            return redirect('/shop');
        }
        else if(count($existingRecords) == 1)
        {
            return 'ERROR:PRODUCT ALREADY ADDED';
        }      
        else if(count($existingRecords) > 1)
        {
            return 'ERROR:DATABASE DUPLICATE';
        }
    }
}
