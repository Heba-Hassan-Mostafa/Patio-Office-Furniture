<?php

namespace App\Http\Controllers\BackendController;

use App\User;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('orders')->orderBy('id','desc')->get();

       return view('admin.client.index' , compact('users'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$user = User::findOrFail($id);

        $orders = User::findOrFail($id)->orders()->where('user_id',$id)->orderBy('id', 'asc')->get();
        //dd($order);


       return view('admin.client.show',compact('orders'));
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = User::findOrFail($id);
        $client->delete();
        $success=[
            'message'=>' Client Successfully Deleted ',
            'alert-type'=>'success'
        ];
         return back()->with($success);
    }

    
}