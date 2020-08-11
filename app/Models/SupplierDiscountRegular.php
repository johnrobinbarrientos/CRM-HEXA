<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupplierDiscountRegular extends Model
{
    use SoftDeletes;
    
    protected $table = 'supplier_discount_regular';

    protected $fillable = [
        'uuid', 'company_id', 'supplier_uuid','discount_name','discount_rate',
        'start_date','end_date','discount_type','is_active',
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