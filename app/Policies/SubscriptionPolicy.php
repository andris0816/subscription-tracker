<?php

namespace App\Policies;

use App\Models\Subscription;
use App\Models\User;

class SubscriptionPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, Subscription $subscription): bool
    {
        return $this->hasOwnership($user, $subscription);
    }

    public function delete(User $user, Subscription $subscription): bool
    {
        return $this->hasOwnership($user, $subscription);
    }

    protected function hasOwnership(User $user, Subscription $subscription): bool
    {
        return $user->getKey() === $subscription->user_id;
    }
}
