<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Employ extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'photo', 'salary', 'address', 'joining_date', 'nid'];
}
