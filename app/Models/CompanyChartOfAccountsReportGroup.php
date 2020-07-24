<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyChartOfAccountsReportGroup extends Model
{
    use SoftDeletes;
    
    protected $table = 'company_chart_of_accounts_report_group';

    protected $fillable = [
        'uuid', 'company_id', 'coa_report_name',
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