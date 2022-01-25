<?php

namespace App\Http\Controllers\BackendController;

use Psy\Util\Json;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Project;
use App\Models\Category;
use App\Models\NewsLetter;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;
use Symfony\Component\HttpFoundation\Response;
use App\Notifications\NewsLetterProductNotification;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $products = Product::with(['category','sub_category'])->orderBy('order','asc')->get();


       return view('admin.product.index',compact('products'), ['title' => 'Product List'] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $categories=Category::whereStatus(1)->orderBy('id','desc')->pluck('name','id')->toArray();

        return view('admin.product.create',compact('categories') , ['title' => 'Create Product']);
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
            'product_name'          => 'required|unique:products',
            'product_code'          => 'required|unique:products',
            'category_id'           => 'required',
            'sub_category_id'       => 'sometimes|nullable',
            'price'                 => 'sometimes|nullable',
            'discount'              => 'sometimes|nullable',
            'image'                 => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'detail'                => 'required',
            'features'              => 'sometimes|nullable',
            'best_sellers'          => 'sometimes|nullable',
            'on_sale'               => 'sometimes|nullable',
            'offers'                => 'sometimes|nullable',
            'status'                => 'required',

        ]);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data['product_name']             = $request->product_name;
        $data['product_code']             = $request->product_code;
        $data['category_id']              = $request->category_id;
        $data['sub_category_id']          = $request->sub_category_id;
        $data['price']                    = $request->price;
        $data['discount']                 = $request->discount;
        $data['detail']                   = $request->detail;
        $data['features']                 = $request->features;
        $data['best_sellers']             = $request->best_sellers;
        $data['on_sale']                  = $request->on_sale;
        $data['offers']                   = $request->offers;
        $data['status']                   = $request->status;

        if($request->hasFile('image'))

        {
            $image=$request->file('image');
            $extention=$image->getClientOriginalExtension();
            $filename=time().'.'.$extention;

            Image::make($image->getRealPath())->resize(800,null,function($constraint){

                $constraint->aspectRatio();
            })->save('files/products/'. $filename,100);

            $data['image'] = $filename;
        }

       $product= Product::create($data);

        $subscribers=NewsLetter::all();

        foreach($subscribers as $subscriber)
        {
            Notification::route('mail' , $subscriber->email)
            ->notify(new NewsLetterProductNotification($product));
        }
        //dd($data);
       $success=[
           'message'=>'Product Successfully Added ',
           'alert-type'=>'success'
       ];
        return redirect(adminUrl('product'))->with($success);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $product=Product::with(['category','sub_category'])->whereId($id)->first();

       //dd($product->subCategory->name);
       return view('admin.product.show',compact('product'),['title'=>'Show Product']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $model = Product::findOrFail($id);
        $categories=Category::whereStatus(1)->orderBy('id','desc')->pluck('name','id')->toArray();

         return view('admin.product.edit' , compact('model','categories'), ['title' => 'Edit Product']);
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
            'product_name'          => 'required',
            'product_code'          => 'required',
            'category_id'           => 'required',
            'sub_category_id'       => 'sometimes|nullable',
            'price'                 => 'sometimes|nullable',
            'discount'              => 'sometimes|nullable',
            'detail'                => 'required',
            'features'              => 'sometimes|nullable',
            'best_sellers'          => 'sometimes|nullable',
            'on_sale'               => 'sometimes|nullable',
            'offers'                => 'sometimes|nullable',
            'status'                => 'required',

        ]);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $data['product_name']             = $request->product_name;
        $data['product_code']             = $request->product_code;
        $data['category_id']              = $request->category_id;
        $data['sub_category_id']          = $request->sub_category_id;
        $data['price']                    = $request->price;
        $data['discount']                 = $request->discount;
        $data['detail']                   = $request->detail;
        $data['features']                 = $request->features;
        $data['best_sellers']             = $request->best_sellers;
        $data['on_sale']                  = $request->on_sale;
        $data['offers']                   = $request->offers;
        $data['status']                   = $request->status;


         $product=Product::findOrFail($id);
         $product=$product->update($data);



        if($product)
        {
            $success=[
           'message'=>'Product Successfully Updated ',
           'alert-type'=>'success'
       ];
        return redirect(adminUrl('product'))->with($success);
        }else{
            $success=[
           'message'=>'Nothing To Update',
           'alert-type'=>'success'
       ];
        return redirect(adminUrl('product'))->with($success);
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
        $product=Product::findOrFail($id);
        if(!empty($product->image))
        {
            if(File::exists('files/products/'.$product->image))
            {
                unlink('files/products/'.$product->image);
            }

        }
        $product->delete();

         $success=[
           'message'=>'Product Successfully Deleted ',
           'alert-type'=>'success'
       ];
        return redirect()->back()->with($success);

    }



    public function getSubCat($category_id)
    {

       $subCat= SubCategory::where('category_id',$category_id)->get();


        return json_encode($subCat);

    }

    public function inactive($id)
    {
       Product::where('id','=',$id)->update(['status'=>0]);

         $success=[
           'message'=>'Product Successfully Inactive ',
           'alert-type'=>'success'
       ];
        return redirect()->back()->with($success);
    }
    public function active($id)
    {
       Product::where('id','=',$id)->update(['status'=>1]);

         $success=[
           'message'=>'Product Successfully Active ',
           'alert-type'=>'success'
       ];
        return redirect()->back()->with($success);
    }

    public function updateImage(Request $request ,$id)
    {
        $product=Product::findOrFail($id);

        $data = array();

        if($request->hasFile('image'))
        {

            if(!empty($product->image))
            {
                if(File::exists('files/products/'.$product->image))
                {
                    unlink('files/products/'.$product->image);
                }

            }

            $image=$request->file('image');
            $extention=$image->getClientOriginalExtension();
            $filename=time().'.'.$extention;

            Image::make($image->getRealPath())->resize(800,null,function($constraint){

                $constraint->aspectRatio();
            })->save('files/products/'. $filename,100);

            $data['image'] = $filename;
        }



            $product =$product->update($data);

            $success=[
                'message'=>'Image Successfully Updated ',
                'alert-type'=>'success'
            ];


                    return redirect(adminUrl('product'))->with($success);

    }


    public function reorder(Request $request)
    {
        $products = Product::all();

        foreach ($products as $product) {

            $id = $product->id;

            foreach ($request->order as $order) {
                if ($order['id'] == $id) {

                    $product->update(['order' => $order['position']]);
                }
            }
        }

        return response('Update Successfully.', 200);

    }

    }