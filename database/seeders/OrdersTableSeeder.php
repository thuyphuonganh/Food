<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Thêm dữ liệu mới
        DB::table('orders')->insert([
            [
                'fullName'    => 'Nguyen Van A',
                'phoneNumber' => '0123456789',
                'address'     => '123 Đường ABC, Quận 1, TP.HCM',
                'description' => 'Mua hàng hóa',
                'status'      => 'pending',
                'totalAmount' => 100000,
                'user_id'     => 1, // giả sử user ID 1
            ],
            [
                'fullName'    => 'Tran Thi B',
                'phoneNumber' => '0987654321',
                'address'     => '456 Đường DEF, Quận 2, TP.HCM',
                'description' => 'Thanh toán sau',
                'status'      => 'completed',
                'totalAmount' => 150000,
                'user_id'     => 2, // giả sử user ID 2
            ],
        ]);
    }
}
