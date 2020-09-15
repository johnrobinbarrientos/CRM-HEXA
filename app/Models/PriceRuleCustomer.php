<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PriceRuleCustomer extends Model
{
    use SoftDeletes;
    
    protected $table = 'price_rule_customer';

    protected $fillable = [
        'uuid', 'company_id', 'rule_name', 'type', 
        'rate','fixed','date_start','date_end',
        'mechanics','minimum_amount','maximum_amount',
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