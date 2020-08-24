<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    protected $fillable = [
        'employ_id',
        'amount',
        'date',
        'month',
        'year'
    ];


    public function employ(){
        return $this->belongsTo(Employ::class);
    }

}
