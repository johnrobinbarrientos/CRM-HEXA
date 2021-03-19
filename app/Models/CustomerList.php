<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerList extends Model
{
    use SoftDeletes;
    
    protected $table = 'customer_list';

    protected $fillable = [
        'uuid','sold_to_name','business_group_name','business_shortname','is_active',
        'tax_id_no','customer_group_uuid','customer_chain_uuid','customer_channel_uuid',
        'customer_type_uuid','vat_uuid','payment_term_uuid','coa_receivable_account_uuid',
        'email','contact_person','contact_no','address_uuid','address1','cost_center_uuid'
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
   
}