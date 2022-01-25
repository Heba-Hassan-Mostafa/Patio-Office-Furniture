<?php

namespace App\Http\Controllers\BackendController;

use App\Models\Video;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = Video::orderBy('order','Asc')->get();

        return view('admin.videos.index' , compact('videos'), ['title' => 'Video List']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.videos.create' , ['title' => 'Create Video']);

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
            'video_name'     => 'required|unique:videos',
            'video_link'     => 'required|url',
            'status'        => 'required',

        ]);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data['video_name']          = $request->video_name;
        $data['video_link']          = $request->video_link;
        $data['status']              = $request->status;

        Video::create($data);

       $success=[
           'message'=>'Video Successfully Added ',
           'alert-type'=>'success'
       ];
        return redirect(adminUrl('video'))->with($success);
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
        $model = Video::findOrFail($id);

        return view('admin.videos.edit' , compact('model'), ['title' => 'Edit Video']);
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
       $validator = Validator::make($request->all(),[

            'video_name'          => 'required',
            'video_link'          => 'required|url',
            'status'              =>'required',

        ]);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $video=Video::findOrfail($id);

            $data['video_name']  = $request->video_name;
            $data['video_link']  = $request->video_link;
            $data['status']      = $request->status;

           $video = $video->update($data);

            if($video)
            {
            $success=[
             'message'=>'Video Successfully Updated ',
             'alert-type'=>'success'
         ];
         return redirect(adminUrl('video'))->with($success);
        }else{
            $success=[
                'message'=>'Nothing To Update ',
                'alert-type'=>'error'
            ];
            return redirect(adminUrl('video'))->with($success);
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
        $video = Video::findOrFail($id);
        $video->delete();
        $success=[
            'message'=>'Video Successfully Deleted ',
            'alert-type'=>'success'
        ];
         return back()->with($success);
    }

    public function reorder(Request $request)
    {
        $videos = Video::all();

        foreach ($videos as $video) {

            $id = $video->id;

            foreach ($request->order as $order) {
                if ($order['id'] == $id) {

                    $video->update(['order' => $order['position']]);
                }
            }
        }

        return response('Update Successfully.', 200);

    }
}