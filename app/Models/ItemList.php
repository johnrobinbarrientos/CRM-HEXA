<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemList extends Model
{
    use SoftDeletes;
    
    protected $table = 'item_list';

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

    public function ItemGroup(){
        return $this->belongsTo('App\Models\ItemGroup','item_group_uuid','uuid');
    }


    public function Suppliers(){
        return $this->hasMany('App\Models\ItemSupplier','item_uuid','uuid')->with('Supplier.DiscountGroups.Discounts');
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

    public function BaseUOM(){
        return $this->belongsTo('App\Models\GlobalUom','global_base_uom_uuid','uuid');
    }

    public function VATItem(){
        return $this->belongsTo('App\Models\CompanyTaxationItem','vat_uuid','uuid');
    }

   
}