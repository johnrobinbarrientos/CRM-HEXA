<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BuyAndPayDiscounts extends Model
{
    use SoftDeletes;
    
    protected $table = 'buy_and_pay_discounts';

    protected $fillable = [
        'uuid', 'company_id', 'document_no','discount_name','gross_amount',
        'discount_rate','discount_amount','discount_type','discount_classification',
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