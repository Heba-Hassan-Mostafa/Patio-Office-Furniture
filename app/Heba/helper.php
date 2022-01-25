<?php

//Setting fun
if(!function_exists('setting'))
{
    function setting()
    {
        return  \App\Models\Setting::orderBy('id' , 'desc')->first();
    }

}

//Setting fun
if(!function_exists('pdf'))
{
    function pdf()
    {
        return  \App\Models\PdfFile::orderBy('id' , 'desc')->first();
    }

}




// function to control name of url admin/

use GuzzleHttp\Psr7\Request;

if(!function_exists('adminUrl'))
{
    function adminUrl($url = null)
    {
        return url('admin/'.$url);
    }

}



      // youtube Link
if (!function_exists('getYoutubeId'))
    {
      function getYoutubeId($url)
      {
        preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
        return isset($match[1]) ? $match[1] : null;
      }
    }
