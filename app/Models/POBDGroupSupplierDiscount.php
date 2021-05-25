<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class POBDGroupSupplierDiscount extends Model
{
    use SoftDeletes;
    
    protected $table = 'pobd_group_supplier_discounts';

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

    public function ExludedItems(){
        return $this->hasMany('App\Models\POBDGroupSupplierDiscountExcludedItem','pobd_group_supplier_discount_uuid','uuid');
    }

    public function POBDGroupSupplier(){
       return $this->belongsTo('App\Models\POBDGroupSupplier','pobd_group_supplier_uuid','uuid');
    }
   
}