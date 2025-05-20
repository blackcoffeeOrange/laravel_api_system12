<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 必要ならファクトリも使える
        // \App\Models\User::factory(10)->create();

        $this->call([
            TestUserSeeder::class,
        ]);
    }
}
