<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ResetPasswordController extends Controller
{
    public function resetForm()
    {
        return view('admin.user.reset');
    }

    public function reset(Request $request)
    {
        $validation = Validator::make($request->all() ,[

            'pin_code' => 'required',
            'email'   => 'required|email',
            'password' => 'required|confirmed',
        ]);

        if($validation->fails())
        {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $admin = Admin::where('pin_code' , $request->pin_code)
        ->where('pin_code' , '!=' , 0)
        ->where('email' , $request->email)->first();

        if($admin)
        {
            $admin->password = bcrypt($request->password);
            $admin->pin_code = null;

            if($admin->save())
            {
                $mes=[
                    'message'=>' Password Successfully Updated, Please Login! ',
                    'alert-type'=>'success'

                     ];
                      return redirect()->to('admin/login')->with($mes);
            }
            else{
                $mes=[
                    'message'=>' An Error Occurred, Try Again ',
                    'alert-type'=>'error'

                     ];
                      return redirect()->back()->with($mes);
            }
        }
        else{
            $mes=[
                'message'=>' The Code Is Invalid. ',
                'alert-type'=>'error'

                 ];
                  return redirect()->back()->with($mes);
        }
    }

}