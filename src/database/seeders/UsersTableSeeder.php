<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 管理者ユーザー（ログインテスト用）
        DB::table('users')->insert([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), // パスワードはハッシュ化
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 一般ユーザー（社員）5人分
        $employees = [
            ['name' => '佐藤 太郎', 'email' => 'sato@example.com'],
            ['name' => '鈴木 花子', 'email' => 'suzuki@example.com'],
            ['name' => '田中 一郎', 'email' => 'tanaka@example.com'],
            ['name' => '高橋 さくら', 'email' => 'takahashi@example.com'],
            ['name' => '伊藤 健', 'email' => 'ito@example.com'],
        ];

        foreach ($employees as $employee) {
            DB::table('users')->insert([
                'name' => $employee['name'],
                'email' => $employee['email'],
                'password' => Hash::make('password'),
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
