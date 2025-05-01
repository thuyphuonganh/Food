<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Thêm dữ liệu mẫu cho bảng order_details
        DB::table('order_details')->insert([
            [
                'order_id'   => 1, // Giả sử order_id 1 tồn tại trong bảng orders
                'product_id' => 1, // Giả sử product_id 1 tồn tại trong bảng products
                'price'      => 50000,
                'quantity'   => 2, // Số lượng sản phẩm
            ],
            [
                'order_id'   => 1, // Giả sử order_id 1 tồn tại trong bảng orders
                'product_id' => 2, // Giả sử product_id 2 tồn tại trong bảng products
                'price'      => 30000,
                'quantity'   => 1, // Số lượng sản phẩm
            ],
            [
                'order_id'   => 2, // Giả sử order_id 2 tồn tại trong bảng orders
                'product_id' => 1, // Giả sử product_id 1 tồn tại trong bảng products
                'price'      => 75000,
                'quantity'   => 2, // Số lượng sản phẩm
            ],
        ]);
    }
}
