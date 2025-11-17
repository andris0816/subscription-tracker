<?php

namespace Database\Factories;

use App\Currency;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subscription>
 */
class SubscriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => null,
            'name' => $this->faker->company(),
            'price' => $this->faker->randomNumber(4),
            'currency' => $this->faker->randomElement(Currency::class),
            'renewal_date' => $this->faker->date(),
            'billing_cycle' => $this->faker->randomElement(['monthly', 'yearly', 'weekly', 'biweekly', 'daily']),
            'cancel_url' => $this->faker->url(),
        ];
    }
}
