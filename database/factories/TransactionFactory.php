<?php

namespace Database\Factories;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Transaction::class;

    public function definition(): array
    {
        return [
            'buyer_name' => fake()->name(),
            'payment_method' => fake()->randomElement([
                Transaction::PAYMENT_CASH,
                Transaction::PAYMENT_QRIS,
            ]),
            'total_amount' => 0,
            'total_profit' => 0,
        ];
    }
}
