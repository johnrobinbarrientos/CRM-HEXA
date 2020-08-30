<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BuyAndPayOrderDetails extends Model
{
    use SoftDeletes;
    
    protected $table = 'buy_and_pay_order_details';

    protected $fillable = [
        'uuid', 'company_id', 'bp_order_uuid','item_uuid',
        'location_uuid','order_qty','order_accepted',
        'uom','item_rate',
    ];

    protected $primaryKey = 'uuid';
    protected $keyType = 'string';
    public $incrementing = false;


    protected static function boot()
    {
        parent::boot();

        static::creating(function (Model $model) {
            $model->setAttribute($model->getKeyName(), \Uuid::generate(4));
        });
    }
   
}