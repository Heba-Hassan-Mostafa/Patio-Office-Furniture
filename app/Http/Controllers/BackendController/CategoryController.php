<?php

namespace App\Http\Controllers\BackendController;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::withCount('products')->orderBy('order','Asc')->get();

        return view('admin.category.index' , compact('categories'), ['title' => 'Category List']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create' , ['title' => 'Create Category']);
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
            'name'          => 'required|unique:categories',
            'status'        => 'required',
            // 'order'         => 'sometimes|nullable|integer|min:-2147483648|max:2147483647',

        ]);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data['name']              = $request->name;
        $data['status']             = $request->status;

        Category::create($data);

       $success=[
           'message'=>'Category Successfully Added ',
           'alert-type'=>'success'
       ];
        return redirect(adminUrl('category'))->with($success);
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
        $model = Category::findOrFail($id);

        return view('admin.category.edit' , compact('model'), ['title' => 'Edit Category']);
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
            // 'order'               => 'sometimes|nullable|integer|min:-2147483648|max:2147483647',

        ]);
        $input = $request->all();
        $category=Category::findOrfail($id);

            $input['name']  = $request->name;
            $input['status'] = $request->status;

           $category = $category->update($input);
            if($category)
            {
            $success=[
             'message'=>'Category Successfully Updated ',
             'alert-type'=>'success'
         ];
         return redirect(adminUrl('category'))->with($success);
        }else{
            $success=[
                'message'=>'Nothing To Update ',
                'alert-type'=>'error'
            ];
            return redirect(adminUrl('category'))->with($success);
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
        $category = Category::findOrFail($id);
        $category->delete();
        $success=[
            'message'=>'Category Successfully Deleted ',
            'alert-type'=>'success'
        ];
         return back()->with($success);

    }

    public function reorder(Request $request)
    {
        $cats = Category::all();

        foreach ($cats as $cat) {

            $id = $cat->id;

            foreach ($request->order as $order) {
                if ($order['id'] == $id) {

                    $cat->update(['order' => $order['position']]);
                }
            }
        }

        return response('Update Successfully.', 200);

    }
}