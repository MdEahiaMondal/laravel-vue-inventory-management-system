<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Pose extends Model
{
    protected $fillable = [
        'product_id',
        'product_name',
        'selling_quantity',
        'selling_price',
        'sub_total'
    ];
}
