<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Menu;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Menu>
 */
class MenuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Menu::class;

    public function definition(): array
    {
        $cost = fake()->numberBetween(100, 15000);
        return [
            'name' => fake()->words(2, true),
            'cost_price' => $cost,
            'selling_price' => $cost + fake()->numberBetween(500, 5000),
            'stock' => fake()->numberBetween(0, 100),
            'is_active' => fake()->boolean(90), 
            'image_path' => 'menu-images/'.fake()->uuid().'.jpg', 
            'category_id' => fake()->boolean(85) ? Category::Factory() : null,
        ];
    }
}
