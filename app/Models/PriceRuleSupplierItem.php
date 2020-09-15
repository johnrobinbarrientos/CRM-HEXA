<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PriceRuleSupplierItem extends Model
{
    use SoftDeletes;
    
    protected $table = 'price_rule_supplier_items';

    protected $fillable = [
        'uuid', 'company_id', 'price_rule_supplier_uuid', 'item_uuid',
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