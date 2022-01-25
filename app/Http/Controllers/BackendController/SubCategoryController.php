<?php

namespace App\Http\Controllers\BackendController;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcats = SubCategory::with('category')->orderBy('id' , 'desc')->get();
        $categories= Category::orderBy('id','desc')->pluck('name','id')->toArray();


        return view('admin.subcategory.index' , compact('subcats','categories') ,['title' => 'SubCategory List'] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.subcategory.create' , ['title' => 'Create SubCategory']);
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
            'name'          => 'required|unique:sub_categories',
            'status'        => 'required',
            'category_id'   => 'required',

        ]);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data['name']              = $request->name;
        $data['status']            = $request->status;
        $data['category_id']      = $request->category_id;

        SubCategory::create($data);

       $success=[
           'message'=>'SubCategory Successfully Added ',
           'alert-type'=>'success'
       ];
        return redirect(adminUrl('subcategory'))->with($success);
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
        $model = SubCategory::findOrFail($id);
        $categories=Category::orderBy('id','desc')->pluck('name','id')->toArray();

        return view('admin.subcategory.edit' , compact('model','categories'), ['title' => 'Edit SubCategory']);
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
            'category_id'         => 'required',
        ]);
        $input = $request->all();
        $subCategory=SubCategory::findOrfail($id);

            $input['name']  = $request->name;
            $input['status'] = $request->status;
            $input['category_id'] = $request->category_id;

           $subCategory = $subCategory->update($input);
            if($subCategory)
            {
            $success=[
             'message'=>'SubCategory Successfully Updated ',
             'alert-type'=>'success'
         ];
         return redirect(adminUrl('subcategory'))->with($success);
        }else{
            $success=[
                'message'=>'Nothing To Update ',
                'alert-type'=>'error'
            ];
            return redirect(adminUrl('subcategory'))->with($success);
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
        $subCategory = SubCategory::findOrFail($id);
        $subCategory->delete();
        $success=[
            'message'=>'SubCategory Successfully Deleted ',
            'alert-type'=>'success'
        ];
         return back()->with($success);
    }
}