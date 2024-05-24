<?php
    
namespace App\Http\Controllers;
     
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Subscription;
use App\Models\SubscriptionPayment AS SubscriptionPaymentModel;
use App\Helpers\Helpers;
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
                    "description" => $user->name
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

            $remaining_days = Helpers::getDaysBetweenDates(date('Y-m-d H:i:s', time()), $user->exp_datetime);
            if($remaining_days < 0){
                $subscription = Subscription::where(['id' => 1])->first();
                $stripe_amount = number_format(($subscription->amount + ($subscription->amount * 22 / 100)), 2, '.', '');
                //charge the card
                $req = [
                    "customer" => $customer_id,
                    "amount" => $stripe_amount * 100,
                    "currency" => env('STRIPE_CURRENCY'),
                    "description" => "Subscription payment for WillFeed on ".date("Y-m-d H:i:s")
                ];
                $payment = Stripe\Charge::create($req);
                $status = "pending";
                if($payment->status == "succeeded"){
                    $status = "success";
                } else {
                    $ststuc = "failed";
                }

                //update database
                SubscriptionPaymentModel::create([
                    "user_id" => $user->id,
                    "subscription_id" => $subscription->id,
                    "subscription_name" => $subscription->name,
                    "subscription_amount" => $stripe_amount,
                    "transaction_no" => $payment->balance_transaction,
                    "transaction_amount" => $payment->amount_captured,
                    "card" => $payment->payment_method_details->card->last4,
                    "status" => "success",
                    "request_data" => json_encode($req),
                    "response_data" => json_encode($payment),
                    "transaction_datetime" => date('Y-m-d H:i:s', $payment->created)
                ]);

                if($status == "success"){
                    User::where(['id' => $user->id])->update([
                        "exp_datetime" => date("Y-m-d 00:00:00", strtotime("+30 days"))
                    ]);
                }
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