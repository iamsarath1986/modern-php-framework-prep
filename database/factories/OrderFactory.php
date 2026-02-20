<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $subtotal = $this->faker->randomFloat(2, 10, 500); // Random amount between 10 and 500
        $tax = round($subtotal * 0.10, 2); // 10% Tax
        $total = $subtotal + $tax;
        return [
            // Random User ID between 1 and 25
            'user_id' => $this->faker->numberBetween(1, 25),
            // Unique Order Number (e.g., ORD-82394710)
            'order_number' => 'ORD-' . $this->faker->unique()->numerify('########'),
            'subtotal' => $subtotal,
            'tax' => $tax,
            'total' => $total,
            'status' => $this->faker->randomElement(['pending', 'processing', 'completed', 'cancelled']),
            'payment_status' => $this->faker->randomElement(['unpaid', 'paid', 'failed']),

            // Random date in the last year
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => function (array $attributes) {
                return $attributes['created_at'];
            },
        ];
    }
}
