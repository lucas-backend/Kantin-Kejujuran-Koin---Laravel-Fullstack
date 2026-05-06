<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryNames = [
            'Makanan Berat',
            'Snack',
            'Minuman',
            'Mie Instan',
        ];

        foreach ($categoryNames as $categoryName) {
            Category::firstOrCreate([
                'name' => $categoryName,
            ]);
        }
    }
}
