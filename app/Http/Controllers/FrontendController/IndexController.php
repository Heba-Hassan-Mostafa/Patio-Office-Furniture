<?php

namespace App\Http\Controllers\FrontendController;

use App\Admin;
use App\Models\Coupon;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Setting;
use App\Models\NewsLetter;
use Illuminate\Http\Request;
use App\Models\ImageCategory;
use App\Notifications\CouponMail;
use App\Notifications\CommentMail;
use App\Http\Controllers\Controller;
use App\Notifications\ContactUsMail;
use Stevebauman\Purify\Facades\Purify;
use Illuminate\Support\Facades\Validator;
use App\Notifications\ClientContactUsMail;
use Illuminate\Support\Facades\Notification;

class IndexController extends Controller
{
    public function index()
    {


        return view('frontend.index');
    }


    public function subscriber(Request $request)
    {
        $validator=Validator::make($request->all(),[

            'email' =>'required|email|unique:news_letters'
        ]);

        if($validator->fails())
        {
             return redirect()->back()->withErrors($validator)->withInput();
        }

        $data['email'] = $request->email;

        $subscribe =NewsLetter::create($data);

        $coupon = Coupon::orderBy('id','desc')->first();
        Notification::route('mail' , $subscribe->email)
    ->notify(new CouponMail($coupon));

         $success=[
           'message'=>'You Are Successfully Added ',
           'alert-type'=>'success'
       ];

       return redirect()->back()->with($success);
    }

    public function comment(Request $request)
    {
        $validator=Validator::make($request->all(),[

            'name'              =>'required',
            'client_email'      =>'required|email',
            'comment'           =>'required|string',
        ]);

        if($validator->fails())
        {
             return redirect()->back()->withErrors($validator)->withInput();
        }

        $data['name']               = $request->name;
        $data['client_email']       = $request->client_email;
        $data['comment']            = Purify::clean($request->comment);

       $comment =Comment::create($data);

        $admin = Admin::orderBy('id','desc')->first();

            Notification::route('mail' , $admin->email)
            ->notify(new CommentMail($comment,$admin));

         $success=[
           'message'=>'Thanks, Your Comment Added Successfully  . ',
           'alert-type'=>'success'
       ];

       return redirect()->back()->with($success);
    }


    public function catalogue()
    {
        $cats = ImageCategory::whereHas('catalogues')->whereStatus(1)->orderBy('id','desc')->get();

        return view('frontend.catalogues.all',compact('cats'),['title' => 'Catalogues' ]);
    }

    public function contact(Request $request)
    {

       return view('frontend.client.contacts',['title' => 'Contact Us' ]);
    }


    public function do_contact(Request $request)
    {
        $validator=Validator::make($request->all(),[

            'name'      =>'required',
            'email'     =>'required|email',
            'message'   =>'required|string',
        ]);

        if($validator->fails())
        {
             return redirect()->back()->withErrors($validator)->withInput();
        }

        $data['name']       = $request->name;
        $data['email']      = $request->email;
        $data['message']    = Purify::clean($request->message);

        $contact= Contact::create($data);

        $reply = Contact::orderBy('id','desc')->first();
        Notification::route('mail' , $reply->email)
        ->notify(new ClientContactUsMail($reply));

        $admin = Admin::orderBy('id','desc')->first();

            Notification::route('mail' , $admin->email)
            ->notify(new ContactUsMail($contact,$admin));


         $success=[
           'message'=>'Thanks, Your Message Sent Successfully. ',
           'alert-type'=>'success'
       ];

       return redirect()->back()->with($success);
    }



     public function about()
    {
        return view('frontend.setting.patio' ,['title' => 'About Patio' ]) ;
    }

    public function showComment()
    {
        $comments = Comment::whereStatus(1)->orderBy('id','desc')->paginate(4);

        return view('frontend.comments.show-comment' ,compact('comments'),['title' => 'Clients Comments' ]) ;
    }

     public function search(Request $request)
    {
        $item = $request->search;

        //echo $item;

        $products = Product::with('category')
        ->whereStatus(1)->where('product_code','LIKE',"%$item%")
        ->orderBy('id','asc')->paginate(100);

            if($products)
            {
                  return view('frontend.design.search',compact('products'));
            }else{
              return view('frontend.index');
            }
    }
      

   }
