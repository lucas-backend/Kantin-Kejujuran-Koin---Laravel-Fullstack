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
        // $this->call([
        //     CategorySeeder::class,
        //     MenuSeeder::class,
        //     TransactionSeeder::class,
        //     TransactionItemSeeder::class,
        // ]);

        $admin = User::query()->firstOrNew([
            'email' => 'lucaswebdev17@gmail.com',
        ]);
        $admin->name = 'Admin Kantin';
        $admin->password = 'admin123';
        $admin->is_admin = true;
        $admin->save();

        $sharedBuyer = config('auth.shared_buyer');
        $buyer = User::query()->firstOrNew([
            'email' => $sharedBuyer['email'],
        ]);
        $buyer->name = $sharedBuyer['name'];
        $buyer->password = $sharedBuyer['password'];
        $buyer->is_admin = false;
        $buyer->save();
    }
}
