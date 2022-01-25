<?php

namespace App\Http\Controllers\BackendController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contact;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::orderBy('id','desc')->get();


        return view('admin.contacts.index',compact('contacts'), ['title' => 'Contact-Us List'] );
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        $success=[
            'message'=>' Contact Successfully Deleted ',
            'alert-type'=>'success'
        ];
         return back()->with($success);
    }





}