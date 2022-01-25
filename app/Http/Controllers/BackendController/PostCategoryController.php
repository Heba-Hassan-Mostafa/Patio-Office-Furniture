<?php

namespace App\Http\Controllers\BackendController;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PostCategory;
use Illuminate\Support\Facades\Validator;

class PostCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $categories=PostCategory::orderBy('id','desc')->get();

       return view('admin.post-category.index',compact('categories'), ['title' => 'Post Category List'] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('admin.post-category.create' , ['title' => 'Create Post Category']);
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
            'name'             => 'required|unique:post_categories',
            'status'           => 'required',

        ]);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data['name']              = $request->name;
        $data['status']            = $request->status;

        PostCategory::create($data);

       $success=[
           'message'=>'PostCategory Successfully Added ',
           'alert-type'=>'success'
       ];
        return redirect(adminUrl('post-category'))->with($success);
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
        $model = PostCategory::findOrFail($id);

        return view('admin.post-category.edit' , compact('model'), ['title' => 'Edit Post Category']);
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
            'name'             => 'required',
            'status'           => 'required',

        ]);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data['name']              = $request->name;
        $data['status']            = $request->status;

        $category=PostCategory::findOrfail($id);



           $category = $category->update($data);
            if($category)
            {
            $success=[
             'message'=>'Post Category Successfully Updated ',
             'alert-type'=>'success'
         ];
         return redirect(adminUrl('post-category'))->with($success);
        }else{
            $success=[
                'message'=>'Nothing To Update ',
                'alert-type'=>'error'
            ];
            return redirect(adminUrl('post-category'))->with($success);
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
        $category = PostCategory::findOrFail($id);
        $category->delete();
        $success=[
            'message'=>'Post Category Successfully Deleted ',
            'alert-type'=>'success'
        ];
         return back()->with($success);

    }


}