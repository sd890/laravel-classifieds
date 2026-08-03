<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Mail\user\verifyEmail;
use App\Models\email_verifications;
use App\Models\SmsCode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;



use function Ramsey\Uuid\v1;

class userProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user=Auth::user();
        
        return view('web.profile.user.profile',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        $user=User::query()->findOrFail($id);
        return view('web.profile.user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $user=User::query()->findOrFail($id);
        $image=$request->file('image') ? User::saveImage($request->file('image')):$user->image;
        $user->update([
         'name'=>$request->input('name',$user->name),
         'username'=>$request->input('user_name',$user->username),
         'email'=>$request->input('email',$user->email),
         'mobile'=>$request->input('mobile'),
         'password'=>$request->input('password')?Hash::make($request->input('password')): $user->password,
         'image'=>$image
        ]);
        return redirect()->route('profile.index')->with('message','اطلاعات کاربری با موفقیت بروزرسانی شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function showVerifyForm()
    {
        return view('web.profile.user.verify_email');
    }
    public function send_code_email()
    {
        $user=Auth::user();
        $code=rand(100000,999999);

        email_verifications::query()->create([
        'user_id'=>$user->id,
        'email'=>$user->email,
        'code'=>$code
        ]);

        Mail::to($user->email)->send(
            new verifyEmail($user,$code)    
        );
        return redirect()->route('email.verify');
    }
   public function verifyEmail(Request $request)
{
    $request->validate([
        'code' => 'required|numeric',
    ]);

    $user = Auth::user();
    if (!$user) {
        return redirect()->route('login');
    }

    $verification = email_verifications::where('user_id', $user->id)
                                       ->where('code', $request->code)
                                       ->first();

    if ($verification) {
        $user=User::query()->find($user->id);
        $user->update([
                'email_verify'=>1 // یا true
        ]);
        
        
         

        $verification->delete();

        return redirect()->route('profile.index')->with('message', 'ایمیل شما تایید شد!');
    }

    return back()->withErrors(['code' => 'کد وارد شده اشتباه است!']);
}

public function send_Sms_code()
{
    $user=Auth::user();

    // حذف یا منقضی کردن کد قبلی
    SmsCode::query()->where('user_id',$user->id)->delete();

    $code=rand(100000,999999);
    SmsCode::query()->create([
    'user_id'    => $user->id,
    'code'       => $code,
    'used'       => false,              // هنوز استفاده نشده
    'attempts'   => 0,                  // تعداد تلاش‌ها صفر
    'expires_at' => now()->addMinutes(5) // مثلا ۵ دقیقه اعتبار کد
    ]);

     // ارسال کد به کاربر از طریق پیامک (تابع خودت)
    // SmsService::send($user->mobile, "کد تایید شما: $code");

    return redirect()->route('sms.verify')->with('message','کد مدنظر را در کادر زیر وارد کنید ');
}

public function showVerifySmsCodeForm()
{
      return view('web.profile.user.verify_mobile');
}
public function verifySms(Request $request)
{
    $user = Auth::user();

    // اعتبارسنجی اولیه فرم
    $request->validate([
        'code' => 'required|numeric',
    ]);

    // پیدا کردن کد فعال برای کاربر
    $verification = SmsCode::query()
        ->where('user_id', $user->id)
        ->where('used', false)
        ->where('expires_at', '>', now()) // فقط کدهای معتبر
        ->first();

    if (!$verification) {
        return back()->withErrors(['code' => 'هیچ کد فعالی موجود نیست یا منقضی شده است.']);
    }

    // بررسی تعداد تلاش‌ها
    if ($verification->attempts >= 3) {
        $verification->delete();
        return back()->withErrors(['code' => 'تعداد دفعات تلاش شما بیش از حد مجاز است.']);
    }

    if ($verification->code != $request->code) {
        $verification->increment('attempts');
        return back()->withErrors(['code' => 'کد وارد شده اشتباه است.']);
    }

    // تایید موفق
    $user=User::query()->find($user->id);
    $user->update(['is_phone_verified' => 1]);

    // علامت‌گذاری کد به عنوان استفاده شده و حذف
    $verification->update(['used' => true]);
    $verification->delete();

    return redirect()->route('profile.index')->with('message', 'موبایل شما با موفقیت تایید شد!');
}


}
