<?php

namespace App\Http\Controllers\BackendController;

use App\Models\Post;
use App\Models\Category;
use App\Models\NewsLetter;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewsLetterPostNotification;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=Post::with('postCategory')->orderBy('id','desc')->get();


       return view('admin.posts.index',compact('posts'), ['title' => 'Post List'] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=PostCategory::orderBy('id','desc')->pluck('name','id')->toArray();
        return view('admin.posts.create',compact('categories') , ['title' => 'Create Post']);
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
            'title'               => 'required|unique:posts',
            'content'             => 'required',
            'post_category_id'    => 'required',
            'status'              => 'required',
            'keywords'            =>'required',
            'description'         =>'required',
            'image'               =>'required',


        ]);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data['title']                 = $request->title;
        $data['content']               = $request->content;
        $data['post_category_id']      = $request->post_category_id;
        $data['status']                = $request->status;
        $data['keywords']              = $request->keywords;
        $data['description']           = $request->description;


        if($request->hasFile('image'))

        {
            $image=$request->file('image');
            $extention=$image->getClientOriginalExtension();
            $filename=time().'.'.$extention;

            Image::make($image->getRealPath())->resize(800,null,function($constraint){

                $constraint->aspectRatio();
            })->save('files/posts/'. $filename,100);

            $data['image'] = $filename;
        }
       $post = Post::create($data);

        $subscribers=NewsLetter::all();

        foreach($subscribers as $subscriber)
        {
            Notification::route('mail' , $subscriber->email)
            ->notify(new NewsLetterPostNotification($post));
        }
       $success=[
           'message'=>'Post Successfully Added ',
           'alert-type'=>'success'
       ];
        return redirect(adminUrl('post'))->with($success);
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
        $model = Post::findOrFail($id);
        $categories=PostCategory::orderBy('id','desc')->pluck('name','id')->toArray();

        return view('admin.posts.edit' , compact('model','categories'), ['title' => 'Edit Post']);
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
            'title'              => 'required',
            'content'           => 'required',
            'post_category_id'  => 'required',
            'status'            => 'required',
            'keywords'            =>'required',
            'description'         =>'required',



        ]);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

         $post=Post::findOrFail($id);


        $data['title']                 = $request->title;
        $data['content']               = $request->content;
        $data['post_category_id']      = $request->post_category_id;
        $data['status']                = $request->status;
        $data['keywords']              = $request->keywords;
        $data['description']           = $request->description;



           $post = $post->update($data);


            if($post)
            {
            $success=[
             'message'=>'Post Successfully Updated ',
             'alert-type'=>'success'
         ];
         return redirect(adminUrl('post'))->with($success);
        }else{
            $success=[
                'message'=>'Nothing To Update ',
                'alert-type'=>'error'
            ];
            return redirect(adminUrl('post'))->with($success);
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
        $post = Post::findOrFail($id);
        if(!empty($post->image))
        {
            if(File::exists('files/posts/'.$post->image))
            {
                unlink('files/posts/'.$post->image);
            }

        }
        $post->delete();
        $success=[
            'message'=>'Post Successfully Deleted ',
            'alert-type'=>'success'
        ];
         return back()->with($success);

    }

    public function updateImage(Request $request , $id)
    {
        Validator::make($request->all(), [

         'image'                 => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data=array();

        $post=Post::findOrFail($id);



        if($request->hasFile('image'))

        {
             //delete old image
             if ($post->image != '')
             {
                if (File::exists('files/posts/' . $post->image))
                {
                    unlink('files/posts/' . $post->image);
                }
             }

            $image=$request->file('image');
            $extention=$image->getClientOriginalExtension();
            $filename=time().'.'.$extention;

            Image::make($image->getRealPath())->resize(800,null,function($constraint){

                $constraint->aspectRatio();
            })->save('files/posts/'. $filename,100);

            $data['image'] = $filename;
        }

        $post=$post->update($data);

        if($post)
            {
            $success=[
             'message'=>'Image Successfully Updated ',
             'alert-type'=>'success'
         ];
         return redirect(adminUrl('post'))->with($success);
        }else{
            $success=[
                'message'=>'Nothing To Update ',
                'alert-type'=>'error'
            ];
            return redirect(adminUrl('post'))->with($success);
        }


    }

    public function active($id)
    {

        Post::where('id','=',$id)->update(['status'=> 1]);

         $success=[
           'message'=>'Post SuccessfullyAactive ',
           'alert-type'=>'success'
       ];
        return redirect()->back()->with($success);
    }

     public function inactive($id)
    {

        Post::where('id','=',$id)->update(['status'=> 0]);

         $success=[
           'message'=>'Post Successfully Inactive ',
           'alert-type'=>'success'
       ];
        return redirect()->back()->with($success);
    }

}