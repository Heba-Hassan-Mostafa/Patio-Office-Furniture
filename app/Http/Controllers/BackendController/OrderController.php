<?php

namespace App\Http\Controllers\BackendController;

use PDF;
use App\Models\Order;
use App\Mail\SendInvoice;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

class OrderController extends Controller
{
     public function newOrder()
    {
        $orders = Order::where('status',0)->orderBy('id','desc')->get();
        //dd($orders);
        return view('admin.orders.pending',compact('orders'));
    }

    public function viewOrder($id)
    {
        $order = Order::with('user')->where('id',$id)->first();
        //dd($order);

        $details=OrderDetail::with('product')->where('order_id',$id)->get();

        //dd($details);
        return view('admin.orders.view-order',compact('order','details'));
    }

    public function acceptPayment($id)
    {

        Order::where('id',$id)->update(['status'=>1]);

        $mes = [
            'message' => 'Order Accepted',
            'alert-type' => 'success',
        ];

        return redirect()->route('new.order')->with($mes);
    }


    public function cancelPayment($id)
    {

        Order::where('id',$id)->update(['status'=>4]);

        $mes = [
            'message' => 'Order Canceled',
            'alert-type' => 'success',
        ];

        return redirect()->route('new.order')->with($mes);
    }


    public function donePayment($id)
    {

        Order::where('id',$id)->update(['status'=>3]);

        $mes = [
            'message' => 'Order successfully Deliveried ',
            'alert-type' => 'success',
        ];

        return redirect()->route('delivery.order')->with($mes);
    }




    public function acceptOrder()
    {
        $orders = Order::where('status',1)->orderBy('id','desc')->get();
        //dd($orders);
        return view('admin.orders.pending',compact('orders'));
    }

    public function cancelOrder()
    {
        $orders = Order::where('status',4)->orderBy('id','desc')->get();
        //dd($orders);
        return view('admin.orders.pending',compact('orders'));
    }

    public function deliveryOrder()
    {
        $orders = Order::where('status',3)->orderBy('id','desc')->get();
        //dd($orders);
        return view('admin.orders.pending',compact('orders'));
    }

 public function print($id)
   {
       $order = Order::with('user')->where('id',$id)->first();
       $details=OrderDetail::with('product')->where('order_id',$id)->get();
       return view('admin.orders.print-order',compact('order','details'));
   }

   public function pdf($id)
   {
       $order = Order::with('user')->where('id',$id)->first();

       $data ['id']         = $order->id;
       $data ['first_name'] = $order->first_name;
       $data ['last_name']  = $order->last_name;
       $data ['phone']      = $order->phone;
       $data ['email']      = $order->email;
       $data ['total']      = $order->total;
       $data ['month']      = $order->month;
       $data ['date']       = $order->date;
       $data ['year']      = $order->year;
       $data ['note']       = $order->note;
       $data ['status']     =$order->status;
       $data['logo']        = "files/setting/".setting()->logo;



       $items=[];
       $details=OrderDetail::with('product')->where('order_id',$id)->get();

       foreach($details as $detail){
        $items[] =
        [
            'product_code' => $detail->product_code,
            'product_name' => $detail->product->product_name,
            'image'        => '/files/products/'.$detail->product->image,
            'quantity'     => $detail->quantity,
            'price'        => $detail->price,
            'total_price'  => $detail->total_price,
            'created_at'   => $detail->created_at->format('Y-m-d'),

        ];
       }
       $data['items'] = $items;

       $pdf = PDF::loadView('admin.orders.pdf', $data);

       if(Route::currentRouteName() == 'pdf.order')
       {
        return $pdf->stream( $order->first_name.'.pdf');
       }else{
           $pdf->save('frontend/invoices/'.$order->first_name.'.pdf');
           return $order->first_name.'.pdf';
       }
   }

   public function sendEmail($id)
   {
       $order = Order::with('user')->where('id',$id)->first();
       $details=OrderDetail::with('product')->where('order_id',$id)->get();

       $this->pdf($id);
       Mail::to($order->email)->locale(config('app.locale'))->send(new SendInvoice($order));

       $success=[
        'message'=>'Email Send Successfully ',
        'alert-type'=>'success'
    ];
     return redirect()->back()->with($success);
   }

}