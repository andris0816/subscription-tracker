<?php

namespace App\Console\Commands;

use App\Jobs\SendEmailAboutSubscriptionRenewal;
use App\Models\Subscription;
use Illuminate\Console\Command;

class CheckRenewableSubscriptions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-renewable-subscriptions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $subs = Subscription::whereDate("renewal_date", now()->addDays(5))->get();
        foreach ($subs as $sub) {
            dispatch(new SendEmailAboutSubscriptionRenewal($sub));
        }
    }
}
