<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerList extends Model
{
    use SoftDeletes;
    
    protected $table = 'customer_list';

    protected $fillable = [
        'uuid', 'company_id', 'sold_to_name','business_group_name','business_group_shortname',
        'tax_id_no','customer_group_uuid','shared_customer_chain_uuid','shared_customer_channel_uuid',
        'shared_customer_type_uuid','vat_uuid','payment_term_uuid','coa_receivable_account_id','email',
        'contact_no','shared_address_uuid',
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
   
}