<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupplierBaseDiscountGroupDetail extends Model
{
    use SoftDeletes;
    
    protected $table = 'supplier_base_discount_group_details';

    protected $fillable = [
        'uuid','supplier_base_discount_group_uuid', 'discount_name', 'discount_rate',
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