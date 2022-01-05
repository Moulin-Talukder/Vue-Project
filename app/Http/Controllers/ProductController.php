<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getProducts(){

        $products = Product::all();
        return $products;

    }


    public function store(Request $request)
    {
        $request->validate([
            'Name'=>'required',
            'Slug'=>'required',
            'Price'=>'required',
            'Qty'=>'required'
         ]);
         $product = new Product;
         if($request->has('Image') && !empty($request->Image)) {
             $imageName = time() . '.' . $request->Image->getClientOriginalExtension();
             $request->Image->move(public_path('images/gallery/'), $imageName);
             $path = ('public/images/gallery/'.$imageName);
             $product->Image = $path;
             
             }

             $product->Name = $request->Name;
             $product->Slug = $request->Slug;
             $product->Description = $request->Description;
             $product->Price = $request->Price;
             $product->Qty = $request->Qty;

             
             if($product->save()){
                 return response()->json(['status' =>true, 'message' => 'Product Added Successfully' ]);
             }else{
                return response()->json(['status' =>false, 'message' => 'There is some problem. Please try again' ]);
         }
    } 



    public function delete($id){

        $product = Product::find($id);
        if($product->delete()) {
            return response()->json(['ststus' => true, 'message' => 'Product Deleted Successfully']);
        }else{
            return response()->json(['ststus' => true, 'message' => 'Something went wrong']);
        }
    }


    /**
     * Search for a name
     *
     * @param  str  $name
     * @return \Illuminate\Http\Response
     */
    public function search($name)
    {
        return Product::where('name', 'like' ,'%'.$name.'%')->get();
    }
}




