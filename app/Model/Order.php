<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customer_id',
        'total_qty',
        'sub_total',
        'vat',
        'total_amount',
        'pay_amount',
        'due_amount',
        'pay_by',
        'order_date',
        'order_month',
        'order_year',
    ];

    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function orderDetails(){
        return $this->hasMany(OrderDetail::class, 'order_id');
    }

}
