<?php

namespace App\Http\Controllers\FrontendController;

use App\Models\Post;
use App\Models\Video;

use App\Http\Controllers\Controller;

class BlogController extends Controller
{
     public function blog()
    {
        $videos = Video::whereStatus(1)->orderBy('order','asc')->paginate(1);
        $posts=Post::with('postCategory')->whereStatus(1)->orderBy('id','desc')->paginate(5);


       return view('frontend.blog.post',compact('posts','videos'),['title' => 'Blog' ]);
    }





    public function blogContent($id)
    {

        $post=Post::with('postCategory')->Where('id',$id)->whereStatus(1)->first();

        $filters=Post::with('postCategory')->whereStatus(1)->inRandomOrder()->paginate(3);
        //$filters = $randomPosts->except($post->id);



       return view('frontend.blog.post-content',compact('post','filters'),['title' => 'Blog' ]);
    }

}