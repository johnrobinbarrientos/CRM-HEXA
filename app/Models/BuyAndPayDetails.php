<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BuyAndPayDetails extends Model
{
    use SoftDeletes;
    
    protected $table = 'buy_and_pay_details';

    protected $fillable = [
        'uuid', 'company_id', 'document_no','item_uuid','location_uuid',
        'order_qty','order_accepted','uom','item_rate','gross_amount',
        'discount_amount','net_sales_amount','vat_amount','ewt_amount',
        'total_amount',
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