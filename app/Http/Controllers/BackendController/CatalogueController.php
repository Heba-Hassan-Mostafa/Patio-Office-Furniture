<?php

namespace App\Http\Controllers\BackendController;

use Illuminate\Http\Request;
use App\Models\ImageCategory;
use App\Models\Catalogue;
use App\Http\Controllers\Controller;
use App\Models\ImageMedia;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class CatalogueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images=Catalogue::with(['imageCategory','imageMedia'])->orderBy('id', 'DESC')->get();


       return view('admin.images.index',compact('images'), ['title' => 'Catalogue Images List'] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=ImageCategory::orderBy('id','desc')->pluck('name','id')->toArray();
        return view('admin.images.create',compact('categories') , ['title' => 'Create Image']);
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
            'title'                 =>'required|unique:catalogues',
            'image_category_id'     => 'required',
            'status'                => 'required',

        ]);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data['title']                  = $request->title;
        $data['image_category_id']      = $request->image_category_id;
        $data['status']                 = $request->status;


        $img = Catalogue::create($data);

        if ($request->images && count($request->images) > 0) {
            $i = 1;
            foreach ($request->images as $file) {
                $filename = time().'-'.$i.'.'.$file->getClientOriginalExtension();
                $file_size = $file->getSize();
                $file_type = $file->getMimeType();
                Image::make($file->getRealPath())->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save('files/images/' . $filename, 100);

                $img->imageMedia()->create([
                    'file_name' => $filename,
                    'file_size' => $file_size,
                    'file_type' => $file_type,
                ]);
                $i++;
            }
        }


       $success=[
           'message'=>'Images Successfully Added ',
           'alert-type'=>'success'
       ];
        return redirect(adminUrl('image'))->with($success);
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
        $model = Catalogue::findOrFail($id);
        $categories=ImageCategory::whereStatus(1)->orderBy('id','desc')->pluck('name','id')->toArray();

        return view('admin.images.edit' , compact('model','categories'), ['title' => 'Edit Image']);
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
            'title'                 =>'required',
            'image.*'               => 'mimes:jpeg,png,jpg,gif,svg',
            'image_category_id'     => 'required',
            'status'                => 'required',

        ]);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $img=Catalogue::findOrFail($id);


        if($img)
        {

        $data['title']                  = $request->title;
        $data['image_category_id']      = $request->image_category_id;
        $data['status']                 = $request->status;


         $img->update($data);

         if ($request->images && count($request->images) > 0) {
            $i = 1;
            foreach ($request->images as $file) {
                $filename = time().'-'.$i.'.'.$file->getClientOriginalExtension();
                $file_size = $file->getSize();
                $file_type = $file->getMimeType();
                Image::make($file->getRealPath())->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save('files/images/' . $filename, 100);

                $img->imageMedia()->create([
                    'file_name' => $filename,
                    'file_size' => $file_size,
                    'file_type' => $file_type,
                ]);
                $i++;
            }
        }


            $success=[
             'message'=>'Images Successfully Updated ',
             'alert-type'=>'success'
         ];
         return redirect(adminUrl('image'))->with($success);

        }

            $success=[
                'message'=>'Nothing To Update ',
                'alert-type'=>'error'
            ];
            return redirect(adminUrl('image'))->with($success);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $img = Catalogue::findOrFail($id);
        if($img)
        {
            if($img->imageMedia->count() > 0)
            {
                foreach($img->imageMedia as $media)
                {
                    if(File::exists('files/images/'.$media->file_name))
                {
                    unlink('files/images/'.$media->file_name);
                }
                }
            }
            $img->delete();
        $success=[
            'message'=>'images Successfully Deleted ',
            'alert-type'=>'success'
        ];
         return back()->with($success);
        }

        $success=[
            'message'=>'Something was wrong ',
            'alert-type'=>'error'
        ];
        return back()->with($success);



    }



    // public function active($id)
    // {

    //     Catalogue::where('id','=',$id)->update(['status'=> 1]);

    //      $success=[
    //       'message'=>'Images Successfully Aactive ',
    //       'alert-type'=>'success'
    //   ];
    //     return redirect()->back()->with($success);
    // }

    //  public function inactive($id)
    // {

    //     Catalogue::where('id','=',$id)->update(['status'=> 0]);

    //      $success=[
    //       'message'=>'Images Successfully Inactive ',
    //       'alert-type'=>'success'
    //   ];
    //     return redirect()->back()->with($success);
    // }

    public function delete_image($img_id)
    {
        $media = ImageMedia::whereId($img_id)->first();

        if($media)
        {
            if(File::exists('files/images/'.$media->file_name))
            {
                unlink('files/images/'.$media->file_name);
            }
            $media->delete();
            return true;
        }
        return false;
    }

}