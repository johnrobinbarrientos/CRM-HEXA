<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseOrder extends Model
{
    use SoftDeletes;
    
    protected $table = 'purchase_orders';

    protected $fillable = [
        'uuid','po_no','receiving_no','billing_no','item_group_uuid','asset_group_uuid','item_discount_group_uuid',
        'term','date_purchased','date_expected','date_received','date_billed','date_due','memo_po','memo_receiving','memo_billing','supplier_uuid','po_status',
        'billing_status','orders_reason_code_uuid','recieving_reason_code','is_apply_tax','branch_uuid','branch_locations_uuid',
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
        return $this->belongsTo('App\Models\PurchaseOrderReasonCode','orders_reason_code_uuid','uuid');
    }

    public function Branch(){
        return $this->belongsTo('App\Models\CompanyBranch','branch_uuid','uuid');
    }

    public function BranchLocation(){
        return $this->belongsTo('App\Models\CompanyBranchLocation','branch_locations_uuid','uuid');
    }
   
}