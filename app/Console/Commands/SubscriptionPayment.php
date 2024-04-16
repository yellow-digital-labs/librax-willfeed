<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Subscription;
use App\Models\SubscriptionPayment AS SubscriptionPaymentModel;
use Stripe;
use Stripe\Exception\CardException;

class SubscriptionPayment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:subscription-payment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Charge card of user who have subscribed the payment';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //get all users which is expiring Today and payment method available
        $users = User::select(["users.*", "subscriptions.plan_validity"])
            ->leftJoin("subscriptions", "subscriptions.id", "=", "users.subscription_id")
            ->where("users.accountType", "<>", 0)
            ->where([
                "users.approved_by_admin" => "Yes",
                "subscriptions.plan_validity" => "mensile"
            ])
            ->where("users.stripe_customer_id", "<>", "")
            ->where("users.exp_datetime", "<=", date("Y-m-d 00:00:00"))
            ->get();
        
        if($users){
            $subscription = Subscription::where(['id' => 1])->first();
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            foreach($users as $user){
                try{
                    //charge the card
                    $request = [
                        "customer" => $user->stripe_customer_id,
                        "amount" => $subscription->amount * 100,
                        "currency" => env('STRIPE_CURRENCY'),
                        "description" => "Subscription payment for WillFeed on ".date("Y-m-d H:i:s")
                    ];
                    $payment = Stripe\Charge::create($request);
                    $status = "pending";
                    if($payment->status == "succeeded"){
                        $status = "success";
                    } else {
                        $status = "failed";
                    }

                    //update database
                    SubscriptionPaymentModel::create([
                        "user_id" => $user->id,
                        "subscription_id" => $subscription->id,
                        "subscription_name" => $subscription->name,
                        "subscription_amount" => $subscription->amount,
                        "transaction_no" => $payment->balance_transaction,
                        "transaction_amount" => $payment->amount_captured,
                        "card" => $payment->payment_method_details->card->last4,
                        "status" => $status,
                        "request_data" => json_encode($request),
                        "response_data" => json_encode($payment),
                        "transaction_datetime" => date('Y-m-d H:i:s', $payment->created)
                    ]);

                    if($status == "success"){
                        User::where(['id' => $user->id])->update([
                            "exp_datetime" => date("Y-m-d H:i:s", strtotime("+30 days"))
                        ]);
                    }
                } catch(CardException $e) {
                    echo '<br>\n'.$e->getMessage();
                }
            }
        }
    }
}
