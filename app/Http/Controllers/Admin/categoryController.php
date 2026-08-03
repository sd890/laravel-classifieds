<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class categoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title="لیست دسته بندی";
        return view('admin.category.category',compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       $title='ایجاد دسته بندی';
       $Categories=Category::query()->pluck('title','id');
       return view('admin.category.create',compact('title','Categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>['required','min:5']
        ]);

        Category::storeInfo($request);
        return redirect()->route('category.index')->with('message','اطلاعات با موفقیت ذخیره شد');

        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category=Category::query()->find($id);
        $Categories=Category::query()->pluck('title','id');
        return view('admin.category.edit',compact('category','Categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
       $category=Category::query()->find($id);
       $imge=Category::saveImage($request->file);
        $category->update([
            'title'=>$request->input('title'),
            'image'=>$imge,
            'parent_id'=>$request->input('parent_id')
        ]);
        return redirect()->route('category.index')->with('massege','اطلاعات با موفقیت بروزرسانی شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
