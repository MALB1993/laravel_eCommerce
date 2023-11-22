<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\ProductVariation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function payment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'address_id'        =>  'required',
            'payment_method'    =>  'required'
        ]);

        if ($validator->fails()) {
            alert()->error(__('Error'), __('Payment Cancelled'));
            return redirect()->back();
        }

        $checkcart = $this->checkcart();
        
        if (array_key_exists('error', $checkcart)) {
            alert()->error(__('Info'), $checkcart['error']);
            return redirect()->back();
        }

        $amounts = $this->getAmount();
        
        if (array_key_exists('error', $amounts)) {
            alert()->error(__('Info'), $amounts['error']);
            return redirect()->back();
        }


        $api = 'test';
        $amount = $amounts['paying_amount'];
        $redirect = route('home.payment_verify');
        $result = $this->send($api, $amount, $redirect);
        $result = json_decode($result);
        if ($result->status) {
            $go = "https://pay.ir/pg/$result->token";
            return redirect()->to($go);
        } else {
            echo $result->errorMessage;
        }
    }


    public function paymentVerify(Request $request)
    {
        $api = 'test';
        $token = $request->token;
        $result = json_decode($this->verify($api, $token));
        if (isset($result->status)) {
            if ($result->status == 1) {
                echo "<h1>تراکنش با موفقیت انجام شد</h1>";
            } else {
                echo "<h1>تراکنش با خطا مواجه شد</h1>";
            }
        } else {
            if ($_GET['status'] == 0) {
                echo "<h1>تراکنش با خطا مواجه شد</h1>";
            }
        }
    }

    public function send($api, $amount, $redirect)
    {
        return $this->curl_post('https://pay.ir/pg/send', [
            'api'          => $api,
            'amount'       => $amount,
            'redirect'     => $redirect
        ]);
    }

    public function curl_post($url, $params)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
        ]);
        $res = curl_exec($ch);
        curl_close($ch);

        return $res;
    }

    public function verify($api, $token)
    {
        return $this->curl_post('https://pay.ir/pg/verify', [
            'api'     => $api,
            'token' => $token,
        ]);
    }

    public function checkcart()
    {

        if (\Cart::isEmpty()) {
            return ['error' => __('is Your shopping cart is empty')];
        }

        foreach (\Cart::getContent() as $item) {
            $variation = ProductVariation::query()->find($item->attributes->id);

            $price = $variation->is_sale ? $variation->sale_price : $variation->price;

            if ($item->price != $price) {
                \Cart::clear();
                return ['error' => __('The price of the product has changed')];
            }

            if ($item->quantity > $variation->quantity) {
                \Cart::clear();
                return ['error' => __('The quantity of the product has changed')];
            }

            return ['success' => 'success'];
        }
    }

    public function getAmount()
    {
        if(session()->has('coupon'))
        {
            $checkCoupon = checkCoupon(session()->get('coupon.code'));

            if(array_key_exists('error', $checkCoupon))
            {
                return $checkCoupon;
            }
        }



        return [
            'total_amount'      =>  (\Cart::getTotal() + cartTotalSaleAmount()),
            'delivery_amount'   =>  totalDeliveryAmount(),
            'coupon_amount'     =>  session()->has('coupon') ? session()->get('coupon.amount') : 0,
            'paying_amount'     =>  cartTotalAmount(),
        ];
    }
}
