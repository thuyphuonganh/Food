<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders'; // Đảm bảo tên bảng là 'orders'

    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'address',
        'note',
        'status',
        'total',
    ];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
