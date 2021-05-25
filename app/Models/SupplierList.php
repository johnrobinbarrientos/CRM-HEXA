<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupplierList extends Model
{
    use SoftDeletes;
    
    protected $table = 'supplier_list';

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


    public function SupplierGroup(){
        return $this->belongsTo('App\Models\SupplierGroup','supplier_group_uuid','uuid');
    }

    public function PaymentTerm(){
        return $this->belongsTo('App\Models\CompanyPaymentTerm','payment_term_uuid','uuid');
    }

    public function CostCenter(){
        return $this->belongsTo('App\Models\CostCenter','cost_center_uuid','uuid');
    }

    public function AddressList(){
        return $this->belongsTo('App\Models\AddressList','address_uuid','uuid');
    }

    public function AccountPayable(){
        return $this->belongsTo('App\Models\CompanyChartOfAccount','coa_payable_account_uuid','uuid');
    }

    public function AccountExpense(){
        return $this->belongsTo('App\Models\CompanyChartOfAccount','coa_expense_account_uuid','uuid');
    }

    public function SupplierVAT(){
        return $this->belongsTo('App\Models\CompanyTaxation','vat_uuid','uuid');
    }

    public function SupplierEWT(){
        return $this->belongsTo('App\Models\CompanyTaxation','ewt_uuid','uuid');
    }

    public function vat(){
        return $this->hasOne('App\Models\CompanyTaxation','uuid','vat_uuid');
    }

    public function EWT(){
        return $this->hasOne('App\Models\CompanyTaxation','uuid','ewt_uuid');
    }
   
    public function DiscountGroups()
    {
        return $this->hasMany('App\Models\BDGroupSupplier','supplier_uuid','uuid');
    }
}