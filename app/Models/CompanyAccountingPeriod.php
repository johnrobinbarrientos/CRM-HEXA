<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyAccountingPeriod extends Model
{
    use SoftDeletes;
    
    protected $table = 'company_accounting_period';

    protected $fillable = [
        'uuid','company_id','year_name','jan_is_open','feb_is_open',
        'mar_is_open','apr_is_open','may_is_open','jun_is_open','jul_is_open',
        'aug_is_open','sep_is_open','oct_is_open','nov_is_open','dec_is_open',
        
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