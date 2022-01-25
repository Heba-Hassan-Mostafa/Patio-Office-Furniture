<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('frontend.client.account');
    }

    public function logout()
    {
        Auth::logout();

        $mes=[
            'message'=>'Successfully Logout',
            'alert-type'=>'success'

        ];

        return redirect()->to('/')->with($mes);
    }
}