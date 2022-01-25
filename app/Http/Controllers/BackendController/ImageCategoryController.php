<?php

namespace App\Http\Controllers\BackendController;

use Illuminate\Http\Request;
use App\Models\ImageCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class ImageCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = ImageCategory::with('catalogues')->orderBy('id','desc')->get();

        return view('admin.image-category.index' , compact('categories'), ['title' => 'Image Category List']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('admin.image-category.create' , ['title' => 'Create Image Category']);
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
            'name'          => 'required|unique:image_categories',
            'status'        => 'required',
            'image'         => 'required|image|mimes:jpeg,png,jpg,gif,svg',


        ]);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data['name']              = $request->name;
        $data['status']             = $request->status;

        if($request->hasFile('image'))

        {
            $image=$request->file('image');
            $extention=$image->getClientOriginalExtension();
            $filename=time().'.'.$extention;

            Image::make($image->getRealPath())->resize(800,null,function($constraint){

                $constraint->aspectRatio();
            })->save('files/imgCats/'. $filename,100);

            $data['image'] = $filename;
        }
        ImageCategory::create($data);

       $success=[
           'message'=>'Image Category Successfully Added ',
           'alert-type'=>'success'
       ];
        return redirect(adminUrl('imgcategory'))->with($success);
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
        $model = ImageCategory::findOrFail($id);

        return view('admin.image-category.edit' , compact('model'), ['title' => 'Edit Image Category']);
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
        $this->validate($request,
        [
            'name'                => 'required',
            'status'              =>'required',
            'image'               => 'image|mimes:jpeg,png,jpg,gif,svg',

        ]);
        $category= ImageCategory::findOrfail($id);

            $data['name']  = $request->name;
            $data['status'] = $request->status;

             if($request->hasFile('image'))

        {
             //delete old image
             if ($category->image != '')
             {
                if (File::exists('files/imgCats/' . $category->image))
                {
                    unlink('files/imgCats/' . $category->image);
                }
             }

            $image=$request->file('image');
            $extention=$image->getClientOriginalExtension();
            $filename=time().'.'.$extention;

            Image::make($image->getRealPath())->resize(800,null,function($constraint){

                $constraint->aspectRatio();
            })->save('files/imgCats/'. $filename,100);

            $data['image'] = $filename;
        }
           $category = $category->update($data);
            if($category)
            {
            $success=[
             'message'=>'Image Category Successfully Updated ',
             'alert-type'=>'success'
         ];
         return redirect(adminUrl('imgcategory'))->with($success);
        }else{
            $success=[
                'message'=>'Nothing To Update ',
                'alert-type'=>'error'
            ];
            return redirect(adminUrl('imgcategory'))->with($success);
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
        $category = ImageCategory::findOrFail($id);

        if ($category->image != '')
             {
                if (File::exists('files/imgCats/' . $category->image))
                {
                    unlink('files/imgCats/' . $category->image);
                }
             }
        $category->delete();
        $success=[
            'message'=>'Image Category Successfully Deleted ',
            'alert-type'=>'success'
        ];
         return back()->with($success);

    }
}