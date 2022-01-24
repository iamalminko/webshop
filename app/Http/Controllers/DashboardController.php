<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
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
        $user = User::where('id', '=' , auth()->user()->id)->get()[0];
        if($user->level == 1)
        {
            $product = Product::where('id' , '=' , $id )->get()[0];
            $product->discount = $request->input('discount');
            $product->save();
            //return 'SUCCESS';
            return redirect('/dashboard');
        }
    
        return 'ERROR:ACCESS DENIED';
    }
}
