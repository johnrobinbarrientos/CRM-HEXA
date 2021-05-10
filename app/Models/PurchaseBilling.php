<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseBilling extends Model
{
    use SoftDeletes;
    
    protected $table = 'purchase_billings';

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

    public function Expenses(){
        return $this->hasMany('App\Models\PurchaseBillingExpense','purchase_billing_uuid','uuid');
    }

    public function Supplier(){
        return $this->belongsTo('App\Models\SupplierList','supplier_uuid','uuid');
    }

    public function OrderReasonCode(){
        return $this->belongsTo('App\Models\PurchaseOrderReasonCode','orders_reason_code_uuid','uuid');
    }

    public function Branch(){
        return $this->belongsTo('App\Models\CompanyBranch','branch_uuid','uuid');
    }

    public function BranchLocation(){
        return $this->belongsTo('App\Models\CompanyBranchLocation','branch_location_uuid','uuid');
    }

    public function BillingProjects(){
        return $this->belongsTo('App\Models\PurchaseBillingProject','purchase_billing_uuid','uuid');
    }


}