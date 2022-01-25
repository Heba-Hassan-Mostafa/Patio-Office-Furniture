<?php

namespace App\Http\Controllers\BackendController;

use App\Models\ClientBrand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class ClientBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = ClientBrand::orderBy('id','desc')->get();

        return view('admin.brands.index' , compact('brands'), ['title' => 'Client Brand List']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brands.create' , ['title' => 'Create Brand']);
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
            'name'                  => 'required|unique:categories',
            'status'                => 'required',
            'image'                 =>'required|image|mimes:jpeg,png,jpg,gif,svg',

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
            })->save('files/brands/'. $filename,100);

            $data['image'] = $filename;
        }
        ClientBrand::create($data);

       $success=[
           'message'=>'Brand Successfully Added ',
           'alert-type'=>'success'
       ];
        return redirect(adminUrl('brand'))->with($success);
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
        $model = ClientBrand::findOrFail($id);

        return view('admin.brands.edit' , compact('model'), ['title' => 'Edit Client Brand']);
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
            'image'               =>'image|mimes:jpeg,png,jpg,gif,svg',

        ]);

        $brand=ClientBrand::findOrfail($id);

            $data['name']  = $request->name;
            $data['status'] = $request->status;

            if($request->hasFile('image'))

            {
                if(!empty($brand->image))
                {
                    if(File::exists('files/brands/'.$brand->image))
                    {
                        unlink('files/brands/'.$brand->image);
                    }

                }

                $image=$request->file('image');
                $extention=$image->getClientOriginalExtension();
                $filename=time().'.'.$extention;

                Image::make($image->getRealPath())->resize(800,null,function($constraint){

                    $constraint->aspectRatio();
                })->save('files/brands/'. $filename,100);

                $data['image'] = $filename;
            }
           $brand = $brand->update($data);

            if($brand)
            {
            $success=[
             'message'=>'Brand Successfully Updated ',
             'alert-type'=>'success'
         ];
         return redirect(adminUrl('brand'))->with($success);
        }else{
            $success=[
                'message'=>'Nothing To Update ',
                'alert-type'=>'error'
            ];
            return redirect(adminUrl('brand'))->with($success);
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
        $brand = ClientBrand::findOrFail($id);
        if(!empty($brand->image))
        {
            if(File::exists('files/brands/'.$brand->image))
            {
                unlink('files/brands/'.$brand->image);
            }

        }
        $brand->delete();

        $success=[
            'message'=>'Brand Successfully Deleted ',
            'alert-type'=>'success'
        ];
         return back()->with($success);

    }
}