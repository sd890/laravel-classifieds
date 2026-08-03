<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Mail\user\PaymentConfirmation;
use App\Mail\user\PaymentFailt;
use App\Models\Ad;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Shetabit\Multipay\Payment;
use Shetabit\Multipay\Invoice;

class OrderController extends Controller
{
    public function payment(Request $request,$ad_id)
    {

        $paymentConfig=config('payment');//مسیر کانفیگ و ورودی فایل payment
        $payment=new Payment($paymentConfig);

        $user=Auth::user();
        $ad=Ad::query()->findOrFail($ad_id);
        $code=rand(1111,9999);

        $total_price=$ad->price;
        $order=Order::query()->create([
            'user_id'=>$user->id,
            'total_price'=>$ad->price,
            'code'=>$code,
            'status'=>\App\Enums\paymentStatus::Draf,
           'gateway' => 'zarinpal', 
        ]);

        OrderDetail::query()->create([

            'order_id'=>$order->id,
           'ad_id'=>$ad->id,
           'price'=>$ad->price,
           'count' => 1, // ✅ پیشنهاد: چون ممکنه بعداً چندتایی بخری
          'status'=>\App\Enums\orderStatus::Processing
        ]);

        $result=$payment->purchase((new Invoice)->amount($total_price),
        function($driver, $transactionId) use($order)
        { 
         // Store transactionId in database.
         $order->update([
            'transaction_id'=>$transactionId
         ]);

        })->pay()->render();
        return $result;
    }

    public function callback(Request $request)
    {
        $Autorize=$_GET['Authority'];
        $order=Order::query()->where('transaction_id',$Autorize)->first();
        $code=$order->code;
        $user=User::query()->findOrFail($order->user_id);
        $order_details=OrderDetail::query()->where('order_id',$order->id)->get();

        if($_GET["Status"]=="OK")
        {
            $order->update([
                'status'=>\App\Enums\paymentStatus::Success->value
            ]);

            foreach($order_details as $order_detail)
            {
                $order_detail->update([
                    'status'=>\App\Enums\orderStatus::Send->value
                ]);
            }

            Mail::to($user->email)->send(
                new PaymentConfirmation($user,$code)
            );

             return view('web.pay.accept',compact('code'));
        }
        else
            {
                $order->update([
                'status'=>\App\Enums\paymentStatus::Faild->value
            ]);
             foreach($order_details as $order_detail)
            {
                $order_detail->update([
                    'status'=>\App\Enums\orderStatus::Rejected->value
                ]);
            }

            Mail::to($user->email)->send(
                new PaymentFailt($user)
            );
            return view('web.pay.reject');

            }
    }
}
