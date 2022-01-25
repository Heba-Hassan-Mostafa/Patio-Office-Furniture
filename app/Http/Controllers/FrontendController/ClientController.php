<?php

namespace App\Http\Controllers\FrontendController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    public function changePassword()
    {
        return view('frontend.client.change-password');
    }

     public function changePasswordSave(Request $request)
    {

        $validator=Validator::make($request->all(),[
            'current_password' =>'required',
            'password'         =>'required|confirmed'

        ]);
        // if($validator->fails())
        // {
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }
        $pass=Auth::user()->password;
        $currentPass=$request->input('current_password');
        $newPass=$request->password;
        $confirmed=$request->password_confirmation;
        if(Hash::check($currentPass, $pass))
        {
            if($newPass === $confirmed )
            {
                $user=User::find(Auth::id());
            $user->password=Hash::make($request->input('password'));
            $user->save();
            Auth::logout();

         $mes=[
            'message'=>' Password Changed Successfully! Now Login With New Password. ',
            'alert-type'=>'success'

             ];
            return redirect()->to('/')->with($mes);

            }else{
            $mes=[
            'message'=>'The password confirmation does not match',
            'alert-type'=>'error'

             ];
              return redirect()->back()->with($mes);
        }

        }else{
            $mes=[
            'message'=>' Old Password not matched ',
            'alert-type'=>'error'

             ];
              return redirect()->back()->with($mes);
        }

    }
}
