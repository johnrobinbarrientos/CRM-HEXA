<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BDGroupSupplierDiscount extends Model
{
    use SoftDeletes;
    
    protected $table = 'bd_group_supplier_discounts';

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
        return $this->hasMany('App\Models\BDGroupSupplierDiscountExcludedItem','bd_group_supplier_discount_uuid','uuid');
    }
   
}