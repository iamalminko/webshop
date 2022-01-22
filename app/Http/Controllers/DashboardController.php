<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

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
        $products = Product::all();

        return view('dashboard.index')->with('products', $products);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function setDiscount(Request $request, $id)
    {
        $products = Product::all();

        //var_dump($request->input('discount'));
        //var_dump($id);
        $product = Product::where('id' , '=' , $id )->get()[0];
        $product->discount = $request->input('discount');
        $product->save();

        return redirect('/dashboard');
    }
}
