<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchasePriceRule extends Model
{
    use SoftDeletes;
    
    protected $table = 'purchase_price_rules';

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
   
    public function PriceRuleDetail(){
        return $this->hasOne('App\Models\PurchasePriceRuleDetail','bp_price_rule_uuid','uuid');
    }
}