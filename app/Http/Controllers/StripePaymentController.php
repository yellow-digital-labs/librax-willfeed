<?php
    
namespace App\Http\Controllers;
     
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Subscription;
use Session;
use Stripe;
use Auth;
     
class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe()
    {
        return view('content.pages.stripe');
    }
    
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        $email = Auth::user()->email;
        $user_id = Auth::user()->id;

        if($request->save_card){

            //save to database
        }

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    
        $user = User::where(['id' => $user_id])->first();
        $subscription = Subscription::where(['id' => 2])->first();
        if(!$user->stripe_customer_id){
            //create customer on stripe
            // $customer = Stripe\Customer::create([
            //     "source" => $request->stripeToken,
            //     "email" => $email,
            //     "description" => "Create customer via WillFeed webapp API"
            // ]);

            // User::where(['id' => $user_id])->update([
            //     "stripe_customer_id" => $customer->id
            // ]);

            // $customer_id = $customer->id;

            $payment = Stripe\Charge::create ([
                // "customer" => $customer_id,
                "amount" => $subscription->amount * 100,
                "currency" => env('STRIPE_CURRENCY'),
                "source" => $request->stripeToken,
                "description" => "Subscription payment for WillFeed"
            ]);
        } else {
            $customer_id = $user->stripe_customer_id;

            $payment = Stripe\Charge::create ([
                "customer" => $customer_id,
                "amount" => $subscription->amount * 100,
                "currency" => env('STRIPE_CURRENCY'),
                "source" => $request->stripeToken,
                "description" => "Subscription payment for WillFeed"
            ]);
        }

        dd($payment);
      
        Session::flash('success', 'Payment successful!');
              
        return back();
    }
}