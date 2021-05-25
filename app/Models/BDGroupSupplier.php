<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BDGroupSupplier extends Model
{
    use SoftDeletes;
    
    protected $table = 'bd_group_suppliers';

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
    

    public function Discounts(){
        return $this->hasMany('App\Models\BDGroupSupplierDiscount','bd_group_supplier_uuid','uuid');
    }

}