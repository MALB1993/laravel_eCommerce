<?php

use Carbon\Carbon;
use Hekmatinasser\Verta\Facades\Verta;

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
