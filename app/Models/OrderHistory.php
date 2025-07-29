<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'order_code',
        'status_name',
        'admin_id',
    ];

    public function administration()
    {
        return $this->belongsTo(Administration::class, 'admin_id');
    }

    public function orderHistory($order_id)
    {
        return $this->where('order_id', $order_id)->orderBy('id', 'desc')->get();
    }
}
