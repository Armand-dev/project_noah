<?php

namespace App\Jobs\StripeWebhooks;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Laravel\Cashier\Cashier;
use Laravel\Cashier\Subscription;
use Spatie\WebhookClient\Models\WebhookCall;

class HandleCustomerSubscriptionCreated implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /** @var \Spatie\WebhookClient\Models\WebhookCall */
    public $webhookCall;

    public function __construct(WebhookCall $webhookCall)
    {
        $this->webhookCall = $webhookCall;
    }

    public function handle()
    {
        $data = $this->webhookCall->payload['data']['object'];

        Subscription::create([
            'user_id' => Cashier::findBillable($data['customer'])->id,
            'name' => 'default',
            'stripe_id' => $data['id'],
//            'stripe_status' => $data['status'],
            'stripe_status' => 'paid',
            'stripe_price' => $data[''],
            'quantity' => $data['quantity'],
            'trial_ends_at' => $data['trial_end'],
            'ends_at' => $data['current_period_end'],
        ]);

        return redirect()->route('dashboard');
    }
}
