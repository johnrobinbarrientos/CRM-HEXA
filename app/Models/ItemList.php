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
        'purchase_price','is_sales_item','sales_uom','sales_price','transfer_price','is_expiry',
        'vat_uuid','ewt_uuid','is_maintain_stock','is_active','coa_income_account_uuid','coa_cos_account_uuid','reorder_qty','item_asset_group_uuid',
        'category1_uuid','category2_uuid','category3_uuid','category4_uuid',
        'category5_uuid',
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

    public function ItemGroup(){
        return $this->belongsTo('App\Models\ItemGroup','item_group_uuid','uuid');
    }


    public function Suppliers(){
        return $this->hasMany('App\Models\ItemSupplier','item_uuid','uuid')->with('Supplier');
    }

    public function IncomeAccount(){
        return $this->belongsTo('App\Models\CompanyChartOfAccount','coa_income_account_uuid','uuid');
    }

    public function CosAccount(){
        return $this->belongsTo('App\Models\CompanyChartOfAccount','coa_cos_account_uuid','uuid');
    }

    public function Tax(){
        return $this->belongsTo('App\Models\CompanyTaxation','vat_uuid','uuid');
    }

    public function Category1(){
        return $this->belongsTo('App\Models\ItemCategory1','category1_uuid','uuid');
    }

    public function Category2(){
        return $this->belongsTo('App\Models\ItemCategory2','category2_uuid','uuid');
    }

    public function Category3(){
        return $this->belongsTo('App\Models\ItemCategory3','category3_uuid','uuid');
    }

    public function Category4(){
        return $this->belongsTo('App\Models\ItemCategory4','category4_uuid','uuid');
    }

    public function Category5(){
        return $this->belongsTo('App\Models\ItemCategory5','category5_uuid','uuid');
    }

    public function AssetGroup(){
        return $this->belongsTo('App\Models\ItemAssetGroup','item_asset_group_uuid','uuid');
    }

    public function UOMs(){
        return $this->hasMany('App\Models\ItemUom','item_uuid','uuid');
    }
   
}