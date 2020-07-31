<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupplierList extends Model
{
    use SoftDeletes;
    
    protected $table = 'supplier_list';

    protected $fillable = [
        'uuid', 'company_id', 'business_name','business_shortname','check_payee','tax_identification_no',
        'supplier_group_uuid','lead_time','is_transporter','vat_uuid','payment_term_uuid',
        'coa_payable_account_uuid','email','contact_no','global_address_uuid',
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


    public function SupplierGroup(){
        return $this->belongsTo('App\Models\SupplierGroup','supplier_group_uuid','uuid');
    }

    public function PaymentTerm(){
        return $this->belongsTo('App\Models\CompanyPaymentTerm','payment_term_uuid','uuid');
    }

    public function AccountPayable(){
        return $this->belongsTo('App\Models\CompanyChartOfAccounts','coa_payable_account_uuid','uuid');
    }
   
    public function discounts(){
        return $this->hasMany('App\Models\SupplierDiscountRegular','supplier_uuid','uuid');
    }
}