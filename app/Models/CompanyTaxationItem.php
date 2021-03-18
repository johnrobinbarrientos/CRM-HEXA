<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyTaxationItem extends Model
{
    use SoftDeletes;
    
    protected $table = 'company_taxation_item';

    protected $fillable = [
        'uuid','tax_type','tax_name','shortname',
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