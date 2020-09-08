<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupplierRegularDiscount extends Model
{
    use SoftDeletes;
    
    protected $table = 'supplier_regular_discount';

    protected $fillable = [
        'uuid', 'company_id', 'supplier_uuid','discount_type','discount_name','discount_rate',
        'discount_fixed','is_active',
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