<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemList extends Model
{
    use SoftDeletes;
    
    protected $table = 'item_list';

    protected $fillable = [
        'uuid','item_group_uuid','item_code','item_barcode','global_base_uom_uuid','item_description','item_shortname',
        'is_purchase_item','purchase_price','is_sales_item','sales_price','manual_rate','customer_group_uuid',
        'option_rate','is_expiry','vat_uuid','is_maintain_stock','is_active','coa_income_account_uuid','coa_cos_account_uuid',
        'reorder_qty','item_asset_group_uuid','cat_department_uuid','cat_section_uuid','cat_category_uuid','cat_manufacturer_uuid','cat_item_type_uuid',
        'cat_brand_uuid','cat_form_uuid','cat_packing_type_uuid','cat_size',
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


    public function CatDepartment(){
        return $this->belongsTo('App\Models\ItemCatDepartment','cat_department_uuid','uuid');
    }

    public function CatSection(){
        return $this->belongsTo('App\Models\ItemCatSection','cat_section_uuid','uuid');
    }

    public function CatCategory(){
        return $this->belongsTo('App\Models\ItemCatCategory','cat_category_uuid','uuid');
    }

    public function CatManufacturer(){
        return $this->belongsTo('App\Models\ItemCatManufacturer','cat_manufacturer_uuid','uuid');
    }

    public function CatItemType(){
        return $this->belongsTo('App\Models\ItemCatItemType','cat_item_type_uuid','uuid');
    }

    public function CatBrand(){
        return $this->belongsTo('App\Models\ItemCatBrand','cat_brand_uuid','uuid');
    }

    public function CatForm(){
        return $this->belongsTo('App\Models\ItemCatForm','cat_form_uuid','uuid');
    }

    public function CatPackingType(){
        return $this->belongsTo('App\Models\ItemCatPackingType','cat_packing_type_uuid','uuid');
    }

    public function AssetGroup(){
        return $this->belongsTo('App\Models\ItemAssetGroup','item_asset_group_uuid','uuid');
    }

   
}