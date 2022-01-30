<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductAdded;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Fetch all products and set the cartCount number - icon in the top right
        $products = Product::all();
        $cartCount = count(ProductAdded::where('user_id' , '=' , auth()->user()->id)->get());

        return view('dashboard.index')->with([
            'products' => $products,
            'cartCount' => $cartCount]);
    }
}
