<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyChartOfAccounts extends Model
{
    use SoftDeletes;
    
    protected $table = 'company_chart_of_accounts';

    protected $fillable = [
        'uuid', 'company_id', 'code','account_name','coa_group_uuid',
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