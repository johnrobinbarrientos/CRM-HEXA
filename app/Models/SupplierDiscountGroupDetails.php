<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupplierDiscountGroupDetails extends Model
{
    use SoftDeletes;
    
    protected $table = 'supplier_discount_group_details';

    protected $fillable = [
        'uuid', 'company_id', 'supplier_discount_group_uuid', 'discount_name', 'discount_rate',
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