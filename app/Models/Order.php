<?php

namespace App\Models;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'invoice_id',
        'tracking_id',
        'customer_type',
        'status_id',
        'is_success',
        'customer_id',
        'payment_type',
        'sub_total',
        'tax',
        'total',
        'shipping_rate'
    ];

    public function setInvoiceIdAttribute($maxId)
    {
        $compcode = "ATC";
        $result = $compcode . date('y') . str_pad($maxId, 5, "0", STR_PAD_LEFT);
        $this->attributes['invoice_id'] = $result;
    }

    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class, 'status_id');
    }


    public function orderAddress()
    {
        return $this->hasOne(OrderAddress::class);
    }

    public function orderProduct()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }



    public function setTrackingIdAttribute()
    {
        $this->attributes['tracking_id'] = '';
    }

}
