<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class OrderAddress extends Model
{
    protected $fillable = [
        'order_id',
        'type',
        'customer_type',
       
        'name',
        'email',
        'address_line_1',
        'address_line_2',
        'state',
        'city',
        
        'zip_code',
        'phone',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }



}
