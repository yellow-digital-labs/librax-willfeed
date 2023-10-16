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
        try{
            $email = Auth::user()->email;
            $user_id = Auth::user()->id;

            if($request->save_card){

                //save to database
            }

            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        
            $user = User::where(['id' => $user_id])->first();
            $subscription = Subscription::where(['id' => 1])->first();
            if(!$user->stripe_customer_id){
                //create customer on stripe
                $customer = Stripe\Customer::create([
                    "source" => $request->stripeToken,
                    "email" => $email,
                    "description" => "Create customer via WillFeed webapp API"
                ]);

                User::where(['id' => $user_id])->update([
                    "stripe_customer_id" => $customer->id
                ]);

                $customer_id = $customer->id;

                // $payment = Stripe\Charge::create ([
                //     "customer" => $customer_id,
                //     "amount" => $subscription->amount * 100,
                //     "currency" => env('STRIPE_CURRENCY'),
                //     // "source" => $request->stripeToken,
                //     "description" => "Subscription payment for WillFeed"
                // ]);
            } else {
                $customer_id = $user->stripe_customer_id;

                $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
                $stripe->customers->update(
                    $customer_id,
                    ['source' => $request->stripeToken]
                );

                // $payment = Stripe\Charge::create ([
                //     "customer" => $customer_id,
                //     "amount" => $subscription->amount * 100,
                //     "currency" => env('STRIPE_CURRENCY'),
                //     // "source" => $request->stripeToken,
                //     "description" => "Subscription payment for WillFeed"
                // ]);
            }
        
            Session::flash('success', 'Card added successfully');
                
            return back();
        }catch(Exception $e){
            return back()->withErrors(["msg" => $e->getMessage()]);
        }
    }

    public function stripeDelete(){
        try{
            $user = Auth::user();
            $user_id = $user->id;

            $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
            $payment_methods_data = $stripe->customers->allPaymentMethods(
                $user->stripe_customer_id,
                ["type" => "card"]
            );

            if(count($payment_methods_data->data)){
                $stripe->paymentMethods->detach(
                    $payment_methods_data->data[0]->id,
                    []
                );

                Session::flash('success', 'Successfully removed payment method!');
                
                return back();
            } else {
                Session::flash('success', 'Invalid request!');
                
                return back();
            }
        }catch(Exception $e){
            return back()->withErrors(["msg" => $e->getMessage()]);
        }
    }
}