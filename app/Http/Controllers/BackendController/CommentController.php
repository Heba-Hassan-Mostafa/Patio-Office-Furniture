<?php

namespace App\Http\Controllers\BackendController;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::orderBy('order','asc')->get();


        return view('admin.comments.index',compact('comments'), ['title' => 'Comments List'] );
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        $success=[
            'message'=>' Comment Successfully Deleted ',
            'alert-type'=>'success'
        ];
         return back()->with($success);
    }

    public function change(Request $request)
    {

        $comment = Comment::findOrFail($request->id);
        $comment->status = $request->status;

        $comment->save();


        return response()->json(['success'=>'Status change successfully.']);


    }

    public function reorder(Request $request)
    {
        $comments = Comment::all();

        foreach ($comments as $comment) {

            $id = $comment->id;

            foreach ($request->order as $order) {
                if ($order['id'] == $id) {

                    $comment->update(['order' => $order['position']]);
                }
            }
        }

        return response('Update Successfully.', 200);

    }


}