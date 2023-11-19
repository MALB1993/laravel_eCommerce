<?php

use App\Models\Coupon;
use App\Models\Order;
use Carbon\Carbon;
use Hekmatinasser\Verta\Facades\Verta;
use RealRashid\SweetAlert\Facades\Alert;

if (!function_exists('generateFileName')) {
    function generateFileName($name)
    {
        $year         = Carbon::now()->year;
        $month        = Carbon::now()->month;
        $hour         = Carbon::now()->hour;
        $minute       = Carbon::now()->minute;
        $second       = Carbon::now()->second;
        $microSecond  = Carbon::now()->microsecond;

        return $year . "_" . $month . "_" . $hour . "_" . $minute . "_" . $second . "_" . $microSecond . "_" . $name;
    }
}

if (!function_exists('convertShamsiToGeographical')) {
    function convertShamsiToGeographical($shamsi)
    {
        if ($shamsi == null) {
            return null;
        }

        $pattern = "/[-\s]/";
        $shamsiDate = preg_split($pattern, $shamsi);
        $date = $shamsiDate[0] . "-" . $shamsiDate[1] . "-" . $shamsiDate[2] . " " . $shamsiDate[3];
        return Verta::parse($date)->datetime();
    }
}


if (!function_exists('cartTotalSaleAmount')) {
    function cartTotalSaleAmount()
    {
        $cartTotalSaleAmount = 0;
        foreach (\Cart::getContent() as $item) {
            if ($item->attributes->is_sale) {
                $cartTotalSaleAmount += $item->quantity * ($item->attributes->price - $item->attributes->sale_price);
            }
        }
        return $cartTotalSaleAmount;
    }
}

if (!function_exists('totalDeliveryAmount')) {
    function totalDeliveryAmount()
    {
        $totalDeliveryAmount = 0;
        foreach (\Cart::getContent() as $item) {
            $totalDeliveryAmount += $item->associatedModel->delivery_amount;
        }
        return $totalDeliveryAmount;
    }
}


if(!function_exists('cartTotalAmount'))
{
    function cartTotalAmount()
    {
        
        if(session()->has('coupon'))
        {
            if(session()->get('coupon.amount') > \Cart::getTotal() + totalDeliveryAmount())
            {
                return 0;
            }else{
                return \Cart::getTotal() + totalDeliveryAmount() - session()->get('coupon.amount');
            }
        }else{
            return \Cart::getTotal() + totalDeliveryAmount();
        }
    }
}


if(!function_exists('checkCoupon'))
{
    function checkCoupon($code)
    {
        $coupon = Coupon::query()->where('code',$code)->where('expired_at', '>' , Carbon::now())->first();
        if($coupon === null)
        {
            return ['error' => __('This coupon code is invalid.')];
        }

        if(Order::query()->where('user_id', auth()->id())->where('coupon_id',$coupon->code)->where('payment_status', 1)->exists() )
        {
            return ['error' => __('Whoops! This coupon code is invalid.')];
        }

        if( $coupon->getRawOriginal('type') === 'amount' )
        {
            session()->put('coupon' ,[
                'code'      =>  $coupon->code,
                'amount'    =>  $coupon->amount
            ]);
        }else{
            $total  = \Cart::getTotal();
            $amount = (($total * $coupon->percentage) / 100) > $coupon->max_percentage_amount ? $coupon->max_percentage_amount : (($total * $coupon->percentage) / 100);
            session()->put('coupon' ,[
                'code'      =>  $coupon->code,
                'amount'    =>  $coupon->amount
            ]);
        }
    }
}