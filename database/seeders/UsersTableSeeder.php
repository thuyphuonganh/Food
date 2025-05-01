<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Tạo dữ liệu mẫu cho bảng users
        User::create([
            'name' => 'John Doe',
            'address' => '123 Main St',
            'phone' => '0123456789',
            'email' => 'johndoe@example.com',
            'password' => bcrypt('password123'), // Mã hóa mật khẩu
        ]);
    }
}
