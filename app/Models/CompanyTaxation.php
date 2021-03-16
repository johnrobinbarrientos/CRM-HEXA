<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyTaxation extends Model
{
    use SoftDeletes;
    
    protected $table = 'company_taxation';

    protected $fillable = [
        'uuid','tax_type','tax_name','tax_rate','is_supplier',
        'is_item','shortname',
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