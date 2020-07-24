<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemList extends Model
{
    use SoftDeletes;
    
    protected $table = 'item_list';

    protected $fillable = [
        'uuid', 'company_id', 'item_group_uuid','item_code','item_barcode','cs_barcode',
        'item_description','item_shortname','supplier_uuid','is_purchase_item','purchase_uom',
        'purchase_cost','is_sales_item','sales_uom','sales_cost','transfer_cost','is_expiry',
        'vat_uuid','coa_income_account_uuid','coa_cos_account_uuid','reorder_qty','item_asset_group_uuid',
        'mv_registration_no','plate_no','assigned_to_emp_uuid',
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