<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Mail\ResetPassword;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{
    public function showRequestForm()
    {
        return view('admin.user.email');
    }

    public function sendResetEmail(Request $request)
    {

        $validation = Validator::make($request->all(), [
            'email'    =>'required|email',

        ]);

        if($validation->fails())
        {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $admin = Admin::where('email' , $request->email)->first();

        if ($admin)
        {
            $code = rand(1111, 9999);
            $update = $admin->update(['pin_code' => $code]);
            if ($update) {

                // send email
                Mail::to($admin->email)
                ->send(new ResetPassword($admin));

                return redirect()->route('update.pass')->with(
                    [
                        'pin_code_for_test' => $code,
                        'mail_fails'        => Mail::failures(),
                        'email'             => $admin->email,
                        'message'           =>' Please, Check Your Email.',
                        'alert-type'        =>'success'
                    ]);
            }
        else{
            $mes=[
                'message'     =>'An Error Occurred, Try Again',
                'alert-type'=>'error'

                 ];
                  return with($mes);
            }

         }
         else{
            $mes=[
                'message'     =>'An Error Occurred, Try Again',
                'alert-type'=>'error'

                 ];
                  return with($mes);
            }
}
}