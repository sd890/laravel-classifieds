<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Models\Conversation;
use App\Models\Image;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class PublicAdsController extends Controller
{

    public function index()
    {
        return view('web.publicAds.index');
    }

    public function show($id)
    {
        $ad=Ad::query()->where('status',\App\Enums\AdStatus::Approved->value)
        ->where(function ($query) {
            $query->whereNull('expired_at')
            ->orWhere('expired_at','>',now());
        })
        ->findOrFail($id);

       
             // افزایش بازدید روزانه
                $sessionKey = 'viewed_ad_' . $ad->id;
                $today = now()->toDateString();

                if (
                    !session()->has($sessionKey) ||
                    session($sessionKey) !== $today
                ) {
                    $ad->increment('views');

                    session([
                        $sessionKey => $today
                    ]);
                }

                // تصاویر آگهی
        $images = Image::query()
        ->where('ad_id', $ad->id)
        ->take(5)
        ->get();

        // اگر کاربر لاگین نکرده باشد
            if (!Auth::check()) {
                return view('web.publicAds.show', compact(
                    'ad',
                    'images'
                ));
            }
    
            $recivedId=$ad->user_id;
            $userId=Auth::id();

             // اگر کاربر صاحب آگهی باشد، چت لازم نیست
           /* if ($userId == $recivedId) {
                return view('web.publicAds.show', compact(
                    'ad',
                    'images'
                ));
            }
 */
           
            
              

          $conversation = Conversation::between($userId, $recivedId)->first();

            if(!$conversation)
            {
                $conversation=Conversation::query()->create([

                    'user_one_id'=>$userId,
                    'user_two_id'=>$recivedId
                ]
                    
                );
            }

            // دریافت پیام ها
           $messages = $conversation->messages()
            ->with('sender')
            ->latest()
            ->take(20)
            ->get()
            ->reverse();

             return view(
        'web.publicAds.show',
        compact(
            'ad',
            'conversation',
            'messages',
            'images'
             )
        );
            
        
    }
    public function conversation(Request $request,$id)
    {
        $ad=Ad::query()->findOrFail($id);
        $userId=Auth::id();
        $recivedId=$ad->user_id;

        $request->validate([
            'message' => 'required|string|max:1000',
        ]);
      $conversation = Conversation::between($userId, $recivedId)->first();

        if(!$conversation)
        {
            $conversation=Conversation::query()->create([
                'user_one_id'=>$userId,
                'user_two_id'=>$recivedId
            ]);
        }

         // چک کردن امنیت: فقط اعضای گفتگو بتونن پیام بدن
        if (!in_array($userId, [$conversation->user_one_id, $conversation->user_two_id])) {
            abort(403, 'Unauthorized action.');
        }


        $messages=Message::query()->create([
          'conversation_id'=>$conversation->id,
           'sender_id'=>Auth::id(),
           'message'=>$request->input('message'),
        ]);

         return redirect()->route('show.public.ads', $ad->id)->with('success', 'پیام ارسال شد.');
    }

    public function toggleFavorite($id)
    {
        $userId=Auth::id();
        $user=User::query()->find($userId);

        $ad=Ad::query()->find($id);
        if ($user->favorites()->where('ad_id', $ad->id)->exists())
        {
            $user->favorites()->detach($ad->id);
            return back()->with('success', 'آگهی از علاقه‌مندی‌ها حذف شد.');
        }
        else{
            $user->favorites()->attach($ad->id);
            return back()->with('success', 'آگهی به علاقه‌مندی‌ها اضافه شد.');
        }
    }
}
