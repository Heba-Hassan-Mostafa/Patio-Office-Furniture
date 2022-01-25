<?php

namespace App\Http\Controllers\BackendController;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    public function todayOrder()
    {
        $today = date('d-m-y');
        $orders = Order::where('status',0)->where('date',$today)->get();
        //dd($orders);

        return view('admin.reports.today-orders',compact('orders'));
    }


    public function todayDeliver()
    {
        $today = date('d-m-y');
        $orders = Order::where('status',3)->where('date',$today)->get();
        //dd($orders);

        return view('admin.reports.today-deliver',compact('orders'));
    }

    public function monthOrder()
    {
        $month = date('F');
        $orders = Order::where('status',3)->where('month',$month)->get();
        //dd($orders);

        return view('admin.reports.month-orders',compact('orders'));
    }

    public function searchReport()
    {


        return view('admin.reports.search');
    }


    public function searchYear(Request $request)
    {
        $year = $request->year;

        $total = Order::where('status',3)->where('year',$year)->sum('total');
        //echo $total;
         $orders = Order::where('status',3)->where('year',$year)->get();
         return view('admin.reports.search-year',compact('orders','total'));
    }

    public function searchMonth(Request $request)
    {
        $month = $request->month;
        //echo $month;
        $total = Order::where('status',3)->where('month',$month)->sum('total');
        //echo $total;
         $orders = Order::where('status',3)->where('month',$month)->get();
         return view('admin.reports.search-month',compact('orders','total'));
    }


    public function searchdate(Request $request)
    {
        $date = $request->date;
        //echo $date;

        $newDate=date('d-m-y',strtotime($date));
         //echo $newDate;
        $total = Order::where('status',3)->where('date',$newDate)->sum('total');
        //echo $total;
         $orders = Order::where('status',3)->where('date',$newDate)->get();
         return view('admin.reports.search-date',compact('orders','total'));
    }






}
