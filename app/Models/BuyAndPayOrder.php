<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BuyAndPayOrder extends Model
{
    use SoftDeletes;
    
    protected $table = 'buy_and_pay_orders';

    protected $fillable = [
        'uuid', 'company_id', 'po_no','item_group_uuid','asset_group_uuid','item_discount_group_uuid',
        'term','date_purchased','date_expected','supplier_uuid','status','orders_reason_code_uuid','is_apply_tax','branch_uuid',
        'branch_locations_uuid',
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

    public function Supplier(){
        return $this->belongsTo('App\Models\SupplierList','supplier_uuid','uuid');
    }

    public function ItemGroup(){
        return $this->belongsTo('App\Models\ItemGroup','item_group_uuid','uuid');
    }

    public function ItemAssetGroup(){
        return $this->belongsTo('App\Models\ItemAssetGroup','asset_group_uuid','uuid');
    }

    public function OrderReasonCode(){
        return $this->belongsTo('App\Models\BuyAndPayOrderReasonCodes','orders_reason_code_uuid','uuid');
    }
   
}