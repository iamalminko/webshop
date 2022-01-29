<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductAdded;
use App\Models\ProductDropped;
use App\Http\Resources\ProductAddedResource;
use App\Http\Resources\ProductResource;

class CartController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function cart($id)
    {
        $productsAdded = ProductAddedResource::collection(ProductAdded::with(['user','product'])->get());
        return $productsAdded;
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function products()
    {
        return ProductResource::collection(Product::all());
    }
    
    public function addToCart($userID, $id)
    {
        // Check if product already added by this user
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
    
    public function removeFromCart($id)
    {
        $existingRecords = ProductAdded::where('id' , '=' , $id )->get();
        
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
    
    public function changeAmount($id, $amount)
    {
        $existingRecords = ProductAdded::where('id' , '=' , $id )->get();
        
        if(count($existingRecords) == 0)
        {
            return 'ERROR:ADDED_PRODUCT NOT FOUND';
        }
        else if(count($existingRecords) == 1)
        {
            $productAdded = $existingRecords[0];
            if($productAdded->amount + $amount > 0) $productAdded->amount = $productAdded->amount + $amount;
            $productAdded->save();
            return 'SUCCESS';
        }      
        else if(count($existingRecords) > 1)
        {
            return 'ERROR:DATABASE DUPLICATE';
        }
    }
}
