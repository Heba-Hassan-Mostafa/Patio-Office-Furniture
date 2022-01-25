<?php

namespace App\Http\Controllers\BackendController;

use App\Models\NewsLetter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsLetterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = NewsLetter::orderBy('id','desc')->get();


        return view('admin.newsletter.index',compact('news'), ['title' => 'Subscriber List'] );
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news = NewsLetter::findOrFail($id);
        $news->delete();
        $success=[
            'message'=>' Subscriber Successfully Deleted ',
            'alert-type'=>'success'
        ];
         return back()->with($success);
    }
}
