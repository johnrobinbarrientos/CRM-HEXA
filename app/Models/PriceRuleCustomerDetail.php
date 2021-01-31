<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PriceRuleCustomerDetail extends Model
{
    use SoftDeletes;
    
    protected $table = 'price_rule_customer_details';

    protected $fillable = [
        'uuid','price_rule_customer_uuid', 'customer_uuid', 
        'applied_to',
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