<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyChartOfAccountAccountGroup extends Model
{
    use SoftDeletes;
    
    protected $table = 'company_chart_of_accounts_account_group';

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

    public function ReportGroup(){
        return $this->belongsTo('App\Models\CompanyChartOfAccountReportGroup','coa_report_uuid','uuid');
    }
   
}