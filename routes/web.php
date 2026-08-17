<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Web\AdsController;
use App\Http\Controllers\web\PublicAdsController;
use Illuminate\Support\Facades\Route;

use function PHPUnit\Framework\callback;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
/////////////////////admin pages ///////////////////////////////
Route::prefix('admin')->middleware('auth')->group(function()
{
    Route::get('/welcome',function(){
        return view('admin.welcome');
    });

    Route::resource('category',\App\Http\Controllers\Admin\categoryController::class);
    Route::resource('povinece',\App\Http\Controllers\Admin\povineceController::class);
    Route::resource('city',\App\Http\Controllers\Admin\CityController::class);

    //////////////////AdsStatus/////////
    Route::get('ads-status',[\App\Http\Controllers\Admin\adsStatus::class,'index']);
    Route::get('ads-status/approved',[\App\Http\Controllers\Admin\adsStatus::class,'approved']);
    Route::get('ads-status/pending',[\App\Http\Controllers\Admin\adsStatus::class,'pending']);
    Route::get('ads-status/rejected',[\App\Http\Controllers\Admin\adsStatus::class,'rejected']);

    /////////////////users///////////////////////////

    Route::resource('users',\App\Http\Controllers\Admin\UserController::class);
});


///////////// web pages//////////////////////////////////
Route::get('/dashboard', function () {
    return view('web.profile.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function()
{
    Route::resource('dashboard/my_ads',\App\Http\Controllers\Web\AdsController::class);
    Route::get('dashboard/my_ads/create',[\App\Http\Controllers\Web\AdsController::class,'create']);
    Route::get('dashboard/my_ads/add_image/{id}',[\App\Http\Controllers\web\AdsController::class,'add_images'])->name('add.images.ad');
    Route::get('dashboard/my_ads/show_image/{id}',[\App\Http\Controllers\Web\AdsController::class,'show_images'])->name('show.images.ad');

    Route::get('/get-cities/{province_id}',[\App\Http\Controllers\web\locationController::class,'getCities'])->name('getCities');

    Route::resource('dashboard/profile',\App\Http\Controllers\web\userProfileController::class);


    ////////////////////////// verify email//////////////////////
    Route::post('/email/send_code_email',[\App\Http\Controllers\web\userProfileController::class,'send_code_email'])->name('send_code_email');
    Route::get('/email/verify',[\App\Http\Controllers\web\userProfileController::class,'showVerifyForm'])->name('email.verify');
    Route::post('/email/verify',[\App\Http\Controllers\web\userProfileController::class,'verifyEmail'])->name('email.verify.post');

    //////////////////verify mobile number////////////////////////
    Route::post('/send_sms_code',[\App\Http\Controllers\web\userProfileController::class,'send_Sms_code'])->name('send.sms.code');
    Route::get('/mobile/verify',[\App\Http\Controllers\web\userProfileController::class,'showVerifySmsCodeForm'])->name('sms.verify');
    Route::post('/mobile/verify',[\App\Http\Controllers\web\userProfileController::class,'verifySms'])->name('sms.verify.post');

    ///////////////////////////chats/////////////////////////////
    Route::get('/dashboard/chat',[\App\Http\Controllers\CahtController::class,'index'])->name('chat.index');
    Route::get('/dashboard/chat/start/{user}',[\App\Http\Controllers\CahtController::class,'startConversation'])->name('chat.start');
    Route::get('/dashboard/chat/{conversation}',[\App\Http\Controllers\CahtController::class,'show'])->name('chat.show');
    Route::post('/dashboard/chat/{conversation}/send',[\App\Http\Controllers\CahtController::class,'sendMessage'])->name('chat.send');
    Route::post('/dashboard/chat/{conversation}/read', [\App\Http\Controllers\CahtController::class, 'markAsRead'])->name('chat.read');

    ///////////////////////////favorite/////////////////////////
    Route::post('/ads/favorite/{id}',[\App\Http\Controllers\web\PublicAdsController::class,'toggleFavorite'])->name('ads.favorite');
    Route::get('/dashboard/favorites_ads/',[\App\Http\Controllers\Web\AdsController::class,'show_favorites'])->name('show.favorites.ads');

    /////////////////////payment////////////////////////////
    Route::post('/payment/{ad_id}',[\App\Http\Controllers\Web\OrderController::class,'payment'])->name('payment');
});

    Route::get('/',[\App\Http\Controllers\web\HomeController::class,'home'])->name('home');

    Route::get('/ads',[PublicAdsController::class,'index']);

    Route::get('/ads/{id}',[\App\Http\Controllers\web\PublicAdsController::class,'show'])->name('show.public.ads');

    Route::middleware('auth')->post('/ads/conversation/{id}',[\App\Http\Controllers\web\PublicAdsController::class,'conversation'])->name('ads.conversation');


    ////about us page && contavt us page////////////
    Route::get('about',[\App\Http\Controllers\Web\InfoAboutUs::class,'about_us']);
    Route::get('contact',[\App\Http\Controllers\Web\InfoAboutUs::class,'contact_us']);

    ////////////////////////////callbak payment
     Route::get('/callback',[\App\Http\Controllers\web\OrderController::class,'callback'])->name('callback');
    Route::post('/callback',[\App\Http\Controllers\web\OrderController::class,'callback'])->name('callback');







require __DIR__.'/auth.php';
