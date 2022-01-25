<?php

namespace App\Http\Controllers\BackendController;

use App\Models\PdfFile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class PdfFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PdfFile $model)
    {
        if ($model->all()->count() > 0) {

            $model = PdfFile::find(1);
        }

        return view('admin.pdf-files.index' ,compact('model') , ['title' => 'Catalogue Pdf File ']);
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'pdf'       => 'sometimes|nullable|mimes:doc,pdf,docx,zip',


        ]);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data = [];

        //upload pdf
        if($request->hasFile('pdf'))
        {
            //delete old file
            if ($request->hasFile('pdf') != null)
            {
               if (File::exists('/files/pdf/' . pdf()->pdf))
               {
                   unlink('/files/pdf/' . pdf()->pdf);
               }
            }
                $file = $request->file('pdf');
                // $path= public_path().'/files/pdf/';
                $extention=$file->getClientOriginalExtension();
                $filename = time(). '.' . $extention ;
                $file->move( 'files/pdf/' , $filename);

               $data['pdf'] = $filename;



        }

        if (PdfFile::all()->count() > 0) {

            PdfFile::orderBy('id', 'desc')->update($data);

        } else {
            PdfFile::create($request->all());
        }

        $success=[
            'message'=>'File Successfully Updated ',
            'alert-type'=>'success'
        ];
         return redirect(adminUrl('pdf'))->with($success);


    }

     public function destroy($id)
    {
        $pdf = PdfFile::findOrFail($id);
        if(!empty($pdf->pdf))
        {
            if(File::exists('files/pdf/'.$pdf->pdf))
            {
                unlink('files/pdf/'.$pdf->pdf);
            }

        }
        $pdf->update(['pdf'=>NULL]);
        $success=[
            'message'=>'PDF Successfully Deleted ',
            'alert-type'=>'success'
        ];
         return back()->with($success);
    }


    }