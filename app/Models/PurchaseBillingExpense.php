<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseBillingExpense extends Model
{
    use SoftDeletes;
    
    protected $table = 'purchase_billing_expenses';

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

    public function PurchaseOrderBilling(){
        return $this->belongsTo('App\Models\PurchaseBilling','purchase_order_billing_uuid','uuid');
    }

    public function Account()
    {
        return $this->belongsTo('App\Models\CompanyChartOfAccount','coa_uuid','uuid');
    }

    public function Project()
    {
        return $this->belongsTo('App\Models\ProjectList','project_uuid','uuid');
    }

}