<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseOrderBaseDiscountGroup extends Model
{
    use SoftDeletes;
    
    protected $table = 'purchase_order_base_discount_groups';

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

    public function PurchaseOrderBaseDiscountGroupDetails()
    {
        return $this->hasMany('App\Models\PurchaseOrderBaseDiscountGroupDetail','bp_order_base_discount_group_uuid','uuid');
    }

    public function PurchaseOrderBaseDiscountGroupItem()
    {
        return $this->hasMany('App\Models\PurchaseOrderBaseDiscountGroupItem','bp_order_base_discount_group_detail_uuid','uuid');
    }
   
}