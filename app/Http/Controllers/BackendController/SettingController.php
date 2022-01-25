<?php

namespace App\Http\Controllers\BackendController;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;



class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Setting $model)
    {
        if ($model->all()->count() > 0) {

            $model = Setting::first();
        }

        return view('admin.setting.index' ,compact('model'));
    }



    public function update(Request $request, $id)
    {



        $data = $this->validate($request,
        [

		'logo'                      =>'sometimes|nullable|image|mimes:png,jpg,jpeg,gif,bmp',
		'icon'                      =>'sometimes|nullable|image|mimes:png,jpg,jpeg,gif,bmp',
		'gmail'                     =>'sometimes|nullable|email',
		'phone_one'                 =>'sometimes|nullable',
        'phone_two'                 =>'sometimes|nullable',
        'instagram'                 =>'url|sometimes|nullable',
        'facebook'                  =>'url|sometimes|nullable',
        'youtube'                   =>'url|sometimes|nullable',
		'twitter'                   =>'url|sometimes|nullable',
        'about_patio'               =>'sometimes|nullable',
        'siteName'                  =>'sometimes|nullable',
        'keywords'                  =>'sometimes|nullable',
        'description'               =>'sometimes|nullable',
        'status'                    =>'',
        'message_maintenance'       =>'sometimes|nullable',
        'address'                   =>'sometimes|nullable',

        ]);

        if($request->hasFile('logo'))
        {
              //delete old image
              if ($data['logo'] != '')
              {
                 if (File::exists('files/setting/' . setting()->logo))
                 {
                     unlink('files/setting/' . setting()->logo);
                 }
              }

            $image = $request->file('logo');
            $extention=$image->getClientOriginalExtension();
            $filename = time(). '.' . $extention;
            Image::make($image->getRealPath())->resize(800 , null , function($constraint){

                $constraint->aspectRatio();
            })->save('files/setting/'. $filename , 100);

            $data['logo'] = $filename;

        }


        if($request->hasFile('icon'))
        {
             //delete old image
             if ($data['icon'] != '')
             {
                if (File::exists('files/setting/' . setting()->icon))
                {
                    unlink('files/setting/' . setting()->icon);
                }
             }

            $image = $request->file('icon');
            $extention=$image->getClientOriginalExtension();
            $filename = time(). '.' . $extention;
            Image::make($image->getRealPath())->resize(800 , null , function($constraint){

                $constraint->aspectRatio();
            })->save('files/setting/'. $filename , 100);

            $data['icon'] = $filename;

        }





        if (Setting::all()->count() > 0) {

            Setting::orderBy('id', 'desc')->update($data);

        } else {
            Setting::create($request->all());
        }

        $success=[
            'message'=>'Setting Successfully Updated ',
            'alert-type'=>'success'
        ];
         return redirect(adminUrl('setting'))->with($success);

    }

    }