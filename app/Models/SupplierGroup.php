<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupplierGroup extends Model
{
    use SoftDeletes;
    
    protected $table = 'supplier_group';

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

    public function Suppliers()
    {
        return $this->hasMany('App\Models\SupplierList','supplier_group_uuid','uuid');
    }

   
}