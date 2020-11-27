<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupplierBaseDiscountGroupItem extends Model
{
    use SoftDeletes;
    
    protected $table = 'supplier_base_discount_group_items';

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

    public function Supplier(){
        return $this->belongsTo('App\Models\SupplierList','supplier_uuid','uuid');
    }

    public function Item(){
        return $this->belongsTo('App\Models\ItemList','item_uuid','uuid');
    }

    public function SupplierBaseDiscountGroup(){
        return $this->belongsTo('App\Models\SupplierBaseDiscountGroup','supplier_base_discount_group_uuid','uuid');
    }
}