<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\City;
use App\Models\Profession;
use App\Models\UserPreference;
use App\Models\UserEmailNotification;
use App\Models\Snapshot;
use App\Models\Cart;
use App\Models\CartItems;
use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\UserCard;
use Auth;
use Mail;
use Carbon\Carbon;

class UserController extends Controller
{
    public function profileSettings()
    {
        return view('settings.profile');
    }

    public function accountSettings()
    {
        $preferences = UserPreference::where('user_id', Auth::user()->id)->first();
        $notifications = UserEmailNotification::where('user_id', Auth::user()->id)->first();
        $user = Auth::user();
        $snapshots = Snapshot::where('user_id', Auth::user()->id)->get();
        $snapcount = $snapshots->count();

        return view('settings.account')->with(compact('preferences', 'notifications', 'user', 'snapcount'));
    }

    public function profile()
    {
        return view('profile');
    }

    public function follow()
    {
        return view('follow');
    }
    
    public function userProfile($uuid) {
        $user = User::where('uuid', $uuid)->first();
        $id = $user->id;
        return view('user-profile')->with(compact('id', 'uuid'));
    }

    public function cart()
    {
        return view('cart');
    }
    
    public function calendar()
    {
        return view('overview.calendar');
    }

    public function checkout()
    {
        return view('checkout');
    }
    
    public function cartCheckout()
    {
        return view('cart-checkout');
    }

    public function payment() 
    {
        try {
            $response = [];
            $cart = Cart::with('user','user.city', 'user.city.state')->where(['user_id' => Auth::user()->id, 'is_deleted' => 0])->first();
            $card = UserCard::where(['user_id' => Auth::user()->id])->where('active', 1)->first();
            $address = Address::with('state', 'country')->where(['user_id' => Auth::user()->id])->where('type', 'billing')->first();
            if (!$address) {
                $address = Address::with('state', 'country')->where(['user_id' => Auth::user()->id])->first();
            }

            // Check record is exist or not
            $order = Order::where(['user_id' => Auth::user()->id, 'cart_id' => $cart->id])->first();
            if (empty($order)) {            
                $order = new Order;
            }
            
            $order->user_id = Auth::user()->id;
            $order->customer_full_name = $address->full_name;
            $order->cart_id = $cart->id;
            $order->total_item_count = $cart->items_count;
            $order->items_qty = $cart->items_qty;
            $order->sub_total = $cart->sub_total;
            $order->grand_total = $cart->grand_total;
            $order->tax_total = $cart->tax_total;
            $order->total_discount_amount = $cart->total_discount_amount;
            $order->promo_discount_amount = $cart->promo_discount_amount;
            $order->promo_discount_percentage = $cart->promo_discount_percentage;
            $order->coupon_code = $cart->coupon_code;

            $order->status = 'new';
            $order->save();
            
            $order->increment_id = "O".$order->id;
            $order->save();
            
            OrderItems::where(['order_id' => $order->id])->delete();
            
            $cartItems = CartItems::where('cart_id', $cart->id)->get();
            foreach ($cartItems as $item) {
                if (!is_null($item->delivery_date)) {
                    $dateTime = $item->delivery_date." 00:00:00";
                    $updatedDateFormat =  Carbon::createFromFormat('m/d/Y H:i:s', $dateTime)->format('Y-m-d');
                }
                $orderItems = new OrderItems;
                $orderItems->order_id = $order->id;
                $orderItems->snapshot_package_id = $item->snapshot_package_id;
                $orderItems->snapshot_id = $item->snapshot_id;
                $orderItems->snapshot_package_user_id = $item->snapshot_package_user_id;
                $orderItems->quantity = $item->quantity;
                $orderItems->price = $item->price;
                $orderItems->extras = $item->extras;
                $orderItems->total = $item->total;
                $orderItems->tax_percent = $item->tax_percent;
                $orderItems->tax_amount = $item->tax_amount;
                $orderItems->coupon_code = $item->coupon_code;
                $orderItems->delivery_date = $updatedDateFormat ?? null;
                $orderItems->delivery_from_time = $item->delivery_from_time;
                $orderItems->delivery_to_time = $item->delivery_to_time;
                $orderItems->arrange_delivery_later = $item->arrange_delivery_later;
                $orderItems->is_upsell = $item->is_upsell;
                $orderItems->upsell_price = $item->upsell_price;
                $orderItems->save();
            }

            $telrManager = new \TelrGateway\TelrManager();

            $billingParams = [
                    'first_name' => $address->full_name,
                    'sur_name' => '',
                    'address_1' => $address->address,
                    'address_2' => $address->address_number,
                    'city' => $cart->user->city->name,
                    'region' => $address->state->name,
                    'zip' => '',
                    'country' => $address->country_id,
                    'email' => $cart->user->email,
                    'phone' => $cart->user->phone,
                ];

            return $telrManager->pay($order->id, $order->grand_total, 'DESCRIPTION ...', $billingParams)->redirect();
        } catch (Exception $e) {
            return $this->response->error(
                $e->getMessage()
            );
        }
    }

    public function paymentSuccess(Request $request) 
    {
        $cart = Cart::with('user')->where(['user_id' => Auth::user()->id, 'is_deleted' => 0])->first();
        $user = $cart->user;

        CartItems::where('cart_id', $cart->id)->update(['is_deleted' => 1]);
        $cart->is_deleted = 1;
        $cart->save();

        $order = Order::where('cart_id', $cart->id)->first();

        Mail::send('email.order_details', ['order' => $order], function($message) use($user){
            $message->to($user->email);
            $message->subject('SEEN : Order Placed Successfully!');
        });

        $payment_status = 'success';

        return view('payment')->with(compact('payment_status', 'order'));
    }

    public function paymentCancel(Request $request) 
    {
        $payment_status = 'cancel';
        $order = null;
        return view('payment')->with(compact('payment_status', 'order'));
    }

    public function paymentDeclined(Request $request) 
    {
        $payment_status = 'declined';
        $order = null;
        return view('payment')->with(compact('payment_status', 'order'));
    }
    
    public function purchases()
    {
        return view('overview.purchases');
    }
    
    public function sales()
    {
        return view('overview.sales');
    }
}
