<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;

class FrontController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('pages.home');
    }

    public function shop()
    {
        $products = Product::all();

        return view('pages.shop')->with('products', $products);
    }

    public function cart()
    {
        $userID = auth()->user()->id;
        $user = User::where('id' , '=' , $userID )->get()[0];
        $cart = $user->cart;
        $cart_json = json_decode($cart);

        $cart_union = [];
        foreach($cart_json as $product)
        {
            $info = Product::where('id' , '=' , $product->product_id)->get()[0];
            array_push($cart_union, [
                "id" => $info->id,
                "name" => $info->name,
                "image" => $info->image,
                "price" => $info->price,
                "amount" => $product->amount,
            ]);
        }

        return view('pages.cart')->with('products', $cart_union);
    }
    
    public function addToCart($id)
    {
        $userID = auth()->user()->id;
        $user = User::where('id' , '=' , $userID )->get()[0];
        $cart = $user->cart;

        $cart_json = json_decode($cart);
        foreach ($cart_json->products as $product) {
            if($product->product_id == $item) return $cart;
        }
        array_push($cart_json->products, ["product_id" => $item, "amount" => 1]);

        $user->cart = json_encode($cart_json);
        $user->save();
        
        return redirect('/shop');
    }
    
    public function changeAmount($id, $amount)
    {
        $userID = auth()->user()->id;
        $user = User::where('id' , '=' , $userID )->get()[0];
        $cart = $user->cart;

        $cart_json = json_decode($cart);
        $cart_new = [];

        foreach ($cart_json as $product) {
            if($product->product_id == $id) array_push($cart_new, ["product_id" => $id, "amount" => $amount]);
            else array_push($cart_new, $product);
        }

        $user->cart = json_encode($cart_new);
        $user->save();
        
        return 'SUCCESS';
    }
    
    public function removeFromCart($id)
    {
        $userID = auth()->user()->id;
        $user = User::where('id' , '=' , $userID )->get()[0];
        $cart = $user->cart;

        $cart_json = json_decode($cart);
        $cart_new = [];

        foreach ($cart_json as $product) {
            if($product->product_id == $id)
            {} 
            else array_push($cart_new, ["product_id" => $product->product_id, "amount" => $product->amount]);
        }

        $user->cart = json_encode($cart_new);
        $user->save();
        
        return 'SUCCESS';
    }

    private function addItemToCart($cart, $item)
    {

        return ;
    }

}
