<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class POBDGroupSupplierDiscountExcludedItem extends Model
{
    use SoftDeletes;
    
    protected $table = 'pobd_group_supplier_discount_excluded_items';

    protected $fillable = [];

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