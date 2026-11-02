<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call([
            PaymentMethodSeeder::class,
        ]);
    }
}
