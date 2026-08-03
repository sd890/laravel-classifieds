<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Province;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title="لیست شهرها";
        return view('admin.city.city',compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title="افزودن شهر";
        $provineces=Province::query()->pluck('title','id');
        return view('admin.city.create',compact('title','provineces'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cities=$request->input('cities');

        foreach($cities as $city)
        {
             $city = trim($city);
        if (!empty($city))
             {
                    City::query()->create([
                    'city'=>$city,
                    'province_id'=>$request->input('province_id')
                    
                ]);
             }
        }
       
         return redirect()->route('city.index')->with('message','شهر جدید اضافه شد');
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
        $city=City::query()->find($id);
        
        $provineces=Province::query()->pluck('title','id');
        $title="ویرایش شهر"." ".$city->city;
        
        return view('admin.city.edit',compact('city','provineces','title'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $city=City::query()->find($id);
        $city->update([
            'city'=>$request->input('title'),
            'province_id'=>$request->input('province_id')
        ]);
         return redirect()->route('city.index')->with('message','شهر ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
