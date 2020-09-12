<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupplierBaseDiscountGroup extends Model
{
    use SoftDeletes;
    
    protected $table = 'supplier_base_discount_group';

    protected $fillable = [
        'uuid', 'company_id', 'supplier_uuid', 'group_name',
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