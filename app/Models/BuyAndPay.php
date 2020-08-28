<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BuyAndPay extends Model
{
    use SoftDeletes;
    
    protected $table = 'buy_and_pay';

    protected $fillable = [
        'uuid','company_id','transaction_type','document_no','reference_no',
        'item_group_uuid','asset_group_uuid','date_purchased','date_expected',
        'supplier_uuid','amount','is_apply_tax','status','default_payable_account',
        'reason_code',
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