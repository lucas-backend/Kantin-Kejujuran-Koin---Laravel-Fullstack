<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            CategorySeeder::class,
            MenuSeeder::class,
            TransactionSeeder::class,
            TransactionItemSeeder::class,
        ]);


        User::factory()->admin()->create([
            'name' => 'Admin Kantin',
            'email' => 'lucaswebdev17@gmail.com',
            'password' => 'admin123',
        ]);
    }


}
