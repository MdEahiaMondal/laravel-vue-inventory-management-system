<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'product_qty',
        'product_price',
        'sub_total',
    ];


    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }

}
