<?php

namespace Database\Factories;

use App\Models\Menu;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<TransactionItem>
 */
class TransactionItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = TransactionItem::class;

    public function definition(): array
    {   
        $quantity = fake()->numberBetween(1,5);
        $cost = fake()->numberBetween(3000, 12000);
        $profitPerUnit = fake()->numberBetween(1000,4000);

        return [
            'transaction_id' => Transaction::factory(),
            'menu_id' => Menu::factory(),
            'quantity' => $quantity,
            'cost_price_snapshot' => $cost,
            'profit' => $profitPerUnit * $quantity,
        ];
    }
}
