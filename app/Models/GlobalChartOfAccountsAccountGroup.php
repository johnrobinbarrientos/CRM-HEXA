<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GlobalChartOfAccountsAccountGroup extends Model
{
    use SoftDeletes;
    
    protected $table = 'global_chart_of_accounts_account_group';

    protected $fillable = [
        'uuid', 'coa_report_uuid', 'account_group',
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