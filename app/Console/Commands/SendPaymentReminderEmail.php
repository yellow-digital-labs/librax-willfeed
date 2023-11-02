<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\Order;
use App\Models\User;
use App\Mail\OrderPaymentReminder;

class SendPaymentReminderEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-payment-reminder-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'When payment term is over then send a payment reminder email';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // $this->sendEmails("A vista", 1); //A vista
        $this->sendEmails("30gg", 30); //30gg
        $this->sendEmails("60gg", 60); //60gg
        $this->sendEmails("90gg", 90); //90gg
    }

    public function sendEmails($payment_option, $payment_days){
        $orders = Order::where([
            "payment_status" => "unpaid",
            "order_status_id" => 4,
            "payment_option" => $payment_option,
        ])
        ->whereDate("order_date", "<=", date("Y-m-d", strtotime('-'.$payment_days.' days')))
        ->get();
        if($orders){
            foreach($orders as $order){
                $seller = User::where(["id" => $order->seller_id])->first();
                $buyer = User::where(["id" => $order->user_id])->first();

                $orderUrl = route("order-details", [
                    "id" => $order->id
                ]);

                Mail::to($buyer->email)->send(new OrderPaymentReminder([
                    "order_id" => $order->id,
                    "url" => $orderUrl,
                    "sellerName" => $order->seller_name,
                    "customerName" => $order->user_name,
                    "amount" => $order->total_payable_amount,
                    "paymentTerm" => $order->payment_option
                ]));

                Mail::to($seller->email)->send(new OrderPaymentReminder([
                    "order_id" => $order->id,
                    "url" => $orderUrl,
                    "sellerName" => $order->seller_name,
                    "customerName" => $order->user_name,
                    "amount" => $order->total_payable_amount,
                    "paymentTerm" => $order->payment_option
                ]));
            }
        }
    }
}
