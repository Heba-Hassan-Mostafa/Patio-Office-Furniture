<?php

namespace App\Http\Controllers\FrontendController;

use App\Http\Controllers\Controller;
use App\Models\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishListController extends Controller
{
    public function addWishList($id)
   {
       $user_id = Auth::id();
       $check = WishList::where('user_id',$user_id)->where('product_id',$id)->first();

       $data = [
           'user_id' => $user_id,
           'product_id' => $id
       ];

       if(Auth::check())
       {
           if($check)
           {
            WishList::where('user_id',$user_id)->where('product_id',$id)->delete();
            return response()->json(['success'=>'Product  Successfully Removed.']);

           }else{

            WishList::create($data);

        return response()->json(['success'=>'Product Added Successfully in Wishlist.']);

          }
       }else{

         return response()->json(['error'=>'Please! You Must Login First.']);
      }
   }


    public function removeWishlist($id)
   {
       $wishlist = WishList::where('id',$id)->delete();


       $mes=[
        'message'=>'Product Successfully Removed.',
        'alert-type'=>'success'

    ];

    return redirect()->back()->with($mes);
   }
}