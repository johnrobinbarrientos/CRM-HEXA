<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseOrderBaseDiscountGroupDetail extends Model
{
    use SoftDeletes;
    
    protected $table = 'purchase_order_base_discount_group_details';

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

    public function OrderBaseDiscountGroup(){
        return $this->belongsTo('App\Models\PurchaseOrderBaseDiscountGroup','bp_order_base_discount_group_uuid','uuid');
    }
   
}