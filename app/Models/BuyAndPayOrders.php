<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BuyAndPayOrders extends Model
{
    use SoftDeletes;
    
    protected $table = 'buy_and_pay_orders';

    protected $fillable = [
        'uuid', 'company_id', 'po_no','item_group_uuid','asset_group_uuid',
        'date_purchased','date_expected','supplier_uuid','status','orders_reason_code_uuid',
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