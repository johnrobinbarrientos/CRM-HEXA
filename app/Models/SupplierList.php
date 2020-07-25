<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupplierList extends Model
{
    use SoftDeletes;
    
    protected $table = 'supplier_list';

    protected $fillable = [
        'uuid', 'company_id', 'business_name','business_shortname','check_payee','tax_id_no',
        'supplier_group_uuid','lead_time','is_transporter','vat_uuid','ewt_uuid','payment_term_uuid',
        'coa_payable_account_uuid','email','contact_no','shared_address_uuid',
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