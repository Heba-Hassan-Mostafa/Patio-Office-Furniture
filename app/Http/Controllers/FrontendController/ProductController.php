<?php

namespace App\Http\Controllers\FrontendController;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
     public function showProduct()
    {
        $products = Product::with('category')
        ->whereHas('category', function ($query) {
            $query->whereStatus(1);
        })->whereStatus(1)->orderBy('order','asc')->paginate(15);


        $categories = Category::whereHas('products')->whereStatus(1)->orderBy('order','asc')->get();

        return view('frontend.products.products' , compact('products','categories'),['title' => 'Products' ]);
    }

     public function productCategory($id)
    {
        $categories = Category::whereHas('products')->whereStatus(1)->orderBy('order','asc')->get();

        $category = Category::Where('id',$id)->whereStatus(1)->first();

        if($category)
        {
           $products= Product::with('category')->whereCategoryId($category->id)
           ->whereStatus(1)
           ->orderBy('order', 'asc')
           ->paginate(15);

           return view('frontend.products.products' , compact('products','categories'));
        }

        return view('frontend.index');
    }


     public function getProduct(Request $request)
    {
        $category = $request->id;
        $data= Product::with('category')->where('category_id',$category)
        ->whereStatus(1)
        ->orderBy('order', 'asc')
         ->paginate(6);

        //  echo "<pre>";

        //  print_r($category);
        return view('frontend.products.pro',[
            'data' => $data,
        ]);
    }
}