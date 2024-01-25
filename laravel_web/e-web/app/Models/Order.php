<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = [
        'user_id',
        'fname',
        'lname',
        'email',
        'phone',
        'address',
        'country',
        'city',
        'pincode',
        'total_price',
        'status',
        'message',
        'tracking_number',
    ];
    public function order_item(){
        return $this->hasMany(OrderItem::class);
    }
}
