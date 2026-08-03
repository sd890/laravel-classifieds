<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InfoAboutUs extends Controller
{
   public function about_us()
   {

    return view('web/info us/about_us');
   }

   public function contact_us()
   {
         return view('web/info us/contact_us');
   }
}
