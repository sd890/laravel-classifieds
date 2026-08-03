<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Province;
use Illuminate\Http\Request;

class povineceController extends Controller
{
   public function index()
   {
    $title="لیست استان ها";
    return view('admin.povinece.povinece',compact('title'));
   }

   public function create()
   {    
    $title="ایجاد استان جدید";
    return view('admin.povinece.create',compact('title'));
   }
   public function store(Request $request)
   {
     Province::query()->create([
        'title'=>$request->input('title')
     ]);

     return redirect()->route('povinece.index')->with('message','استان جدید ذخیره شد');
   }
   public function edit($id)
   {
    $provinece=Province::query()->find($id);
    $title="ویرایش استان"." ".$provinece->title;
    return view('admin.povinece.edit',compact('title','provinece'));

   }
   public function update(Request $request,$id)
   {
    $provinece=Province::query()->find($id);
    $provinece->update([
        'title'=>$request->input('title')
    ]);

    return redirect()->route('povinece.index')->with('message','استان ویرایش شد');
   }
}
