<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemSupplier extends Model
{
    use SoftDeletes;
    
    protected $table = 'item_suppliers';

    protected $fillable = [
        'uuid', 'supplier_uuid','deleted_at'
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


    public function Supplier(){
        return $this->belongsTo('App\Models\SupplierList','supplier_uuid','uuid');
    }

    public function Item(){
        return $this->belongsTo('App\Models\ItemList','item_uuid','uuid');
    }
   
}