<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class adsStatus extends Controller
{
    public function index()
    {
        return view('admin.adsStatus.index');

    }

    public function approved()
    {
            return view('admin.adsStatus.approved');
    }

     public function pending()
    {
        return view('admin.adsStatus.pending');
    }

    public function rejected()
    {
         return view('admin.adsStatus.rejected');
    }
}
