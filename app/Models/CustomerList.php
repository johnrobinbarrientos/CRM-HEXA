<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerList extends Model
{
    use SoftDeletes;
    
    protected $table = 'customer_list';

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

    public function discounts(){
        return $this->hasMany('App\Models\CustomerDiscountRegular','customer_uuid','uuid');
    }

    public function CustomerGroup(){
        return $this->belongsTo('App\Models\CustomerGroup','customer_group_uuid','uuid');
    }

    public function CustomerChain(){
        return $this->belongsTo('App\Models\CustomerChain','customer_chain_uuid','uuid');
    }

    public function CustomerChannel(){
        return $this->belongsTo('App\Models\CustomerChannel','customer_channel_uuid','uuid');
    }

    public function CustomerType(){
        return $this->belongsTo('App\Models\CustomerType','customer_type_uuid','uuid');
    }

    public function PaymentTerm(){
        return $this->belongsTo('App\Models\CompanyPaymentTerm','payment_term_uuid','uuid');
    }

    public function CostCenter(){
        return $this->belongsTo('App\Models\CostCenter','cost_center_uuid','uuid');
    }

    public function AccountReceivable(){
        return $this->belongsTo('App\Models\CompanyChartOfAccount','coa_receivable_account_uuid','uuid');
    }

    public function CustomerVAT(){
        return $this->belongsTo('App\Models\CompanyTaxation','vat_uuid','uuid');
    }

    public function AddressList(){
        return $this->belongsTo('App\Models\AddressList','address_uuid','uuid');
    }
   
}