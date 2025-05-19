<?php


namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TestUserSeeder extends Seeder
{
    public function run()
    {
        /**
         * 環境チェック .env ファイルで APP_ENV=local の場合(開発環境の場合)
         * 
         * テストユーザー作成
         */

        if (app()->environment('local')) {
            User::firstOrCreate(
                ['email' => 'test@example.com'],
                [
                    'name' => 'テストユーザー',
                    'password' => Hash::make('password123')
                ]
            );
        }
    }
}
