<?php

namespace App\Jobs;

use App\Mail\SubscriptionRenewing;
use App\Models\Subscription;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendEmailAboutSubscriptionRenewal implements ShouldQueue
{
    use Queueable;
    protected $subscription;

    /**
     * Create a new job instance.
     */
    public function __construct(Subscription $subscription)
    {
        $this->subscription = $subscription;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $user = $this->subscription->user;
        Mail::to($user->email)->queue(new SubscriptionRenewing($this->subscription));
    }
}
