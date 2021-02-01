<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PriceRuleSupplier extends Model
{
    use SoftDeletes;
    
    protected $table = 'price_rule_suppliers';

    protected $fillable = [
        'uuid','rule_name', 
        'rate','date_start','date_end',
        'mechanics','target_amount',
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

    public function PriceRuleSupplierDetails()
    {
        return $this->hasMany('App\Models\PriceRuleSupplierDetail','price_rule_supplier_uuid','uuid');
    }
   
}