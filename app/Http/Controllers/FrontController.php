<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductAdded;
use App\Models\ProductDropped;
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
        return view('pages.cart')->with('products', $addedProducts_union);
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
            return 'SUCCESS';
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
    
    public function changeAmount($id, $amount)
    {
        $userID = auth()->user()->id;
        $existingRecords = ProductAdded::where('user_id' , '=' , $userID )->where('product_id' , '=' , $id )->get();
        
        if(count($existingRecords) == 0)
        {
            return 'ERROR:ADDED_PRODUCT NOT FOUND';
        }
        else if(count($existingRecords) == 1)
        {
            $productAdded = $existingRecords[0];
            $productAdded->amount = $amount;
            $productAdded->save();
            return 'SUCCESS';
        }      
        else if(count($existingRecords) > 1)
        {
            return 'ERROR:DATABASE DUPLICATE';
        }
    }
    
    public function removeFromCart($id)
    {
        $userID = auth()->user()->id;
        $existingRecords = ProductAdded::where('user_id' , '=' , $userID )->where('product_id' , '=' , $id )->get();
        
        if(count($existingRecords) == 0)
        {
            return 'ERROR:ADDED_PRODUCT NOT FOUND';
        }
        else if(count($existingRecords) == 1)
        {
            $droppedProduct = new ProductDropped();
            $droppedProduct->user_id = $existingRecords[0]->user_id;
            $droppedProduct->product_id = $existingRecords[0]->product_id;
            $droppedProduct->amount = $existingRecords[0]->amount;
            $droppedProduct->price = Product::where('id' , '=' , $existingRecords[0]->product_id)->get()[0]->price;
            $droppedProduct->save();
            
            $existingRecords[0]->delete();
            return 'SUCCESS';
        }      
        else if(count($existingRecords) > 1)
        {
            $droppedProduct = new ProductDropped();
            $droppedProduct->user_id = $existingRecords[0]->user_id;
            $droppedProduct->product_id = $existingRecords[0]->product_id;
            $droppedProduct->amount = $existingRecords[0]->amount;
            $droppedProduct->price = Product::where('id' , '=' , $existingRecords[0]->product_id)->get()[0]->price;
            $droppedProduct->save();

            foreach ($existingRecords as $record)
            {
                $record->delete();
            }
            return 'ERROR:DATABASE DUPLICATE (ALL ERRENEOUS RECORDS DELETED)';
        }
    }
}
