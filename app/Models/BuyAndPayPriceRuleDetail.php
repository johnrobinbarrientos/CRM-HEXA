<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BuyAndPayPriceRuleDetail extends Model
{
    use SoftDeletes;
    
    protected $table = 'buy_and_pay_price_rule_details';

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

    public function PriceRule(){
        return $this->belongsTo('App\Models\BuyAndPayPriceRule','bp_price_rule_uuid','uuid');
    }
   
}