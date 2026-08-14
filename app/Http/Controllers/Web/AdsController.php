<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Models\Category;
use App\Models\City;

use Illuminate\Http\Request;
use App\Http\Requests\Adrequest;
use App\Mail\user\createdAd;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Mail;

class AdsController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     */
    use AuthorizesRequests;
    public function index()
    {

        $user=Auth::user();
        $id=$user->id;
        return view('web.ads.ads',compact('id'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       $cities=City::query()->pluck('city','id');
       $categories=Category::query()->pluck('title','id');

       return view('web.ads.create',compact('cities','categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Adrequest $request)
    {
        $image=Ad::saveImage($request->file('image'));
        $user=Auth::user();
        
        
        $title=$request->input('title');
        Ad::query()->create([
         'title'=>$request->input('title'),
        'slug'=>Str::slug($request->input('title')),
        'short_desc'=>$request->input('short_description'),
        'description'=>$request->input('description'),
        'image'=>$image,
        'user_id'=>$user->id,
        'price'=>$request->input('price')?? null,
        'status'=>\App\Enums\AdStatus::Pending->value,
        'is_featured'=>false,
        'views'=>0,
        'price_type'=>$request->input('price_type')?? 'fixed',
        'category_id'=>$request->input('category_id'),
        'city_id'=>$request->input('city_id'),
        'contact_number' =>$request->input('show_mobile') ? $user->mobile : null,
        ]);

        if($user->email_verify)
        {
             Mail::to($user->email)->queue(
            new createdAd($user,$title)
        );
        }
       
        
        return redirect()->route('my_ads.index')->with('message','آگهی با موفقیت ثبت شد و در انتظار  تایید..');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user=Auth::user();
        $ad = Ad::findOrFail($id);
        
        
        
            // ساخت کلید اختصاصی برای این آگهی در سشن
            $sessionKey = 'viewed_ad_' . $ad->id;
            $today = now()->toDateString(); // تاریخ امروز

            // اگر امروز این آگهی دیده نشده بود → شمارنده را زیاد کن
            if(!session()->has($sessionKey) || session($sessionKey) !== $today)
        {
                // افزایش تعداد بازدید
                $ad->increment('views');
                session([$sessionKey => $today]);
        }
    

          return view('web.ads.show', compact('ad'));
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
            $ad=Ad::query()->findOrFail($id);
           
            
         $this->authorize('update', $ad);  // اینجا بررسی policy انجام میشه
            
            $categories=Category::query()->pluck('title','id');
        
            $cities=City::query()->pluck('city','id');
            
            return view('web.ads.edit',compact('ad','categories','cities'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Adrequest $request,$id)
    {
        $ad=Ad::query()->findOrFail($id);
       $this->authorize('update', $ad);  // اینجا بررسی policy انجام میشه
        $image=$request->file('image') ? Ad::saveImage($request->file('image')) :$ad->image;
            $ad->update([
        'title' => $request->input('title'),
        'slug' => Str::slug($request->input('title')),
        'short_desc' => $request->input('short_description'), 
        'description' => $request->input('description'),
        'image' =>$image,
        'price' => $request->input('price', $ad->price),
        'price_type' => $request->input('price_type', $ad->price_type),
        'category_id' => $request->input('category_id'),
        'city_id' => $request->input('city_id'),
     ]);
      return redirect()->route('my_ads.index')->with('message','اطلاعات با موفقیت بروزرسانی شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $ad=Ad::query()->findOrFail($id);
        $user=Auth::user();
       
        $this->authorize('delete',$ad);
            $ad->delete();
            return redirect()->route('ads.index')->with('message','آگهی با موفقیت حذف شد');
        
        
    }

    public function add_images(Request $request,$id)
    {
        $ad=Ad::query()->findOrFail($id);
        return view('web.ads.add_images',compact('id'));
    }

    public function show_images($id)
    {
        return view('web.ads.show_images',compact('id'));
    }
    public function show_favorites()
    {
        
        return view('web.ads.show_favorites_ads');
    }
}
