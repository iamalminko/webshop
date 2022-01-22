<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

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
        return view('pages.cart');
    }
    
    public function addToCart($id)
    {
        $products = Product::all();

        return view('pages.shop')->with('products', $products);
    }

}
