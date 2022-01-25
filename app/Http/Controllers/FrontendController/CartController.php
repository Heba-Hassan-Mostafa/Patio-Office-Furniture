<?php

namespace App\Http\Controllers\FrontendController;

use App\Admin;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\WishList;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Notifications\UserOrderMail;
use Illuminate\Support\Facades\Auth;
use App\Notifications\AdminOrderMail;
use Stevebauman\Purify\Facades\Purify;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;

class CartController extends Controller
{
    public function addCart($id)
    {

$product = Product::where('id',$id)->first();

  $data = array();

 if ($product->discount == NULL) {
 	$data['id'] = $product->id;
 	$data['name'] = $product->product_code;
 	$data['qty'] = 1;
 	$data['price'] = ($product->price ? $product->price : 0);
 	$data['weight'] = 1;
 	$data['options']['image'] = $product->image;
 	 Cart::add($data);
      return response()->json(['success'=>'Product Added Successfully in Cart.']);
    }else{

 	$data['id'] = $product->id;
 	$data['name'] = $product->product_code;
 	$data['qty'] = 1;
 	$data['price'] = ($product->discount ? $product->discount : 0);
 	$data['weight'] = 1;
 	$data['options']['image'] = $product->image;
 	 Cart::add($data);
      return response()->json(['success'=>'Product Added Successfully in Cart.']);

 }
    }

    public function check()
    {
        $content=Cart::content();

        return response()->json($content);
    }

    public function showCart()
    {
        $carts = Cart::content();
        return view('frontend.products.cart' ,compact('carts'));
    }

    public function removeCart($rowId)
    {
         Cart::remove($rowId);
        $mes=[
            'message'=>'Product Removed From Cart. ',
            'alert-type'=>'success'

             ];
            return redirect()->back()->with($mes);
    }

    public function updateCart(Request $request)
    {
        $rowId=$request->product_id;
        $qty=$request->qty;

        Cart::update($rowId, $qty);
        $mes=[
            'message'=>'Product Quantity Updated Successfully. ',
            'alert-type'=>'success'

             ];
            return redirect()->back()->with($mes);
    }

    public function productCartView($id)
    {
       $product= Product::with(['category','sub_category'])->where('id',$id)->first();
       $product_cat = $product->category->name;

       return response()->json([

        'product' => $product,
        'product_cat' =>$product_cat,

       ]);
    }

    public function insertCart(Request $request)
    {
        $id = $request->product_id;

        $product = Product::where('id',$id)->first();


    $data = array();

    if ($product->discount == NULL) {
 	$data['id'] = $product->id;
 	$data['name'] = $product->product_code;
 	$data['qty'] = $request->qty;
 	$data['price'] = ($product->price ? $product->price : 0);
 	$data['weight'] = 1;
 	$data['options']['image'] = $product->image;
 	 Cart::add($data);
    $mes=[
            'message'=>'Product Added Successfully To Cart. ',
            'alert-type'=>'success'

             ];
            return redirect()->back()->with($mes);
    }else{

 	$data['id'] = $product->id;
 	$data['name'] = $product->product_code;
 	$data['qty'] = $request->qty;
 	$data['price'] = ($product->discount ? $product->discount : 0);
 	$data['weight'] = 1;
 	$data['options']['image'] = $product->image;

 	 Cart::add($data);
    $mes=[
            'message'=>'Product Added Successfully To Cart. ',
            'alert-type'=>'success'

             ];
            return redirect()->back()->with($mes);

 }
    }

     public function checkout()
    {
       if(Auth::check())
       {
        $carts = Cart::content();
        return view('frontend.products.checkout' ,compact('carts'));

       }else{

        $mes=[
            'message'=>' At First Login With Your Account. ',
            'alert-type'=>'error'

             ];
            return redirect('/')->with($mes);

       }
    }

    public function wishList()
    {
       $user_id=Auth::id();
       $products=WishList::with(['product','user'])
       ->where('user_id',$user_id)
       ->get();

       //return response()->json($products);
       return view('frontend.products.wishlist',compact('products'));
    }

    public function coupon(Request $request)
    {
        $coupon = $request->coupon;
        $check = Coupon::where('coupon',$coupon)->first();

        if($check)
        {
            Session::put('coupon',
            [
                'name'=>$check->coupon,
                'discount' =>$check->discount,
                'price' => (Cart::subtotal()-(Cart::subtotal()*$check->discount/100))

            ]);

            $mes=[
                'message'=>'Coupon Apllied Successfully. ',
                'alert-type'=>'success'

                 ];
                return redirect()->back()->with($mes);

        }else{
            $mes=[
                'message'=>'Invalid Coupon. ',
                'alert-type'=>'error'

                 ];
                return redirect()->back()->with($mes);

        }


    }

    public function removeCoupon()
    {
        Session::forget('coupon');
        $mes=[
            'message'=>'Coupon Removed Successfully. ',
            'alert-type'=>'success'

             ];
            return redirect()->back()->with($mes);
    }

     public function order()
    {
        if(Auth::check())
       {
        $carts = Cart::content();
        return view('frontend.products.order' ,compact('carts'));

       }else{

        $mes=[
            'message'=>' At First Login With Your Account. ',
            'alert-type'=>'success'

             ];
            return redirect('/login')->with($mes);

       }
    }


    public function makeOrder(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'first_name'   =>'required',
            'last_name'    =>'required',
            'email'        =>'required|email',
            'phone'        =>'required',
            'address'      =>'sometimes|nullable',
            'note'         =>'required',
        ]);

        if($validator->fails())
        {
             return redirect()->back()->withErrors($validator)->withInput();
        }


        $data = array();

         //insert order
   $data['user_id']              = Auth::id();
   $data['total']                = $request->total;

   if(Session::has('coupon'))
   {
       $data['total'] = Session::get('coupon')['price'];

   }else{
    $data['total'] = Cart::Subtotal();
   }
    $data['status']             = 0;
    $data['first_name']         = $request->first_name;
    $data['last_name']          = $request->last_name;
    $data['email']              = $request->email;
    $data['phone']              = $request->phone;
    $data['address']            = $request->address;
    $data['note']               = Purify::clean($request->note);
    $data['date']               = date('d-m-y');
    $data['month']              = date('F');
    $data['year']               = date('Y');
    //$order_id                   = DB::table('orders')->insertGetId($data);


    $orders = Order::create($data);
    $order_id = $orders->id;


    //insert order details

    $content = Cart::content();

    $detail = array();

    foreach($content as $row)
    {
        $detail['order_id']  = $order_id;
        $detail['product_id'] = $row->id;
        $detail['product_code'] = $row->name;
        $detail['quantity'] = $row->qty;
        $detail['price'] = $row->price;
        $detail['total_price'] = $row->qty * $row->price;

        OrderDetail::create($detail);

    }
    Cart::destroy();
    if(Session::has('coupon'))
    {
        Session::forget('coupon');

    }

    $order = Order::whereStatus(0)->orderBy('id','desc')->first();
    Notification::route('mail' , $order->email)
    ->notify(new UserOrderMail($order));

    $admin = Admin::orderBy('id','desc')->first();

    Notification::route('mail' , $admin->email)
    ->notify(new AdminOrderMail($orders,$admin));


    $mes=[
        'message'=>'Order Process Successfully Done. ',
        'alert-type'=>'success'

         ];
        return redirect()->to('/')->with($mes);


    }
}