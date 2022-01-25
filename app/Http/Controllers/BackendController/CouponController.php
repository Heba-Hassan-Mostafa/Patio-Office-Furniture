<?php

namespace App\Http\Controllers\BackendController;

use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupon::orderBy('id','desc')->get();


       return view('admin.coupon.index',compact('coupons'), ['title' => 'Coupon List'] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.coupon.create' , ['title' => 'Create Coupon']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'coupon'       => 'required|unique:coupons',
            'discount'     => 'required',

        ]);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data['coupon']               = $request->coupon;
        $data['discount']             = $request->discount;

        Coupon::create($data);

       $success=[
           'message'=>'Coupon Successfully Added ',
           'alert-type'=>'success'
       ];
        return redirect(adminUrl('coupon'))->with($success);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Coupon::findOrFail($id);

        return view('admin.coupon.edit' , compact('model'), ['title' => 'Edit Coupon']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'coupon'       => 'required',
            'discount'     => 'required',

        ]);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->all();
        $coupon=Coupon::findOrfail($id);

        $data['coupon']               = $request->coupon;
        $data['discount']             = $request->discount;

           $coupon = $coupon->update($data);
            if($coupon)
            {
            $success=[
             'message'=>'Coupon Successfully Updated ',
             'alert-type'=>'success'
         ];
         return redirect(adminUrl('coupon'))->with($success);
        }else{
            $success=[
                'message'=>'Nothing To Update ',
                'alert-type'=>'error'
            ];
            return redirect(adminUrl('coupon'))->with($success);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();
        $success=[
            'message'=>'Coupon Successfully Deleted ',
            'alert-type'=>'success'
        ];
         return back()->with($success);

    }


}
