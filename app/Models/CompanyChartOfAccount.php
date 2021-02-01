<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyChartOfAccount extends Model
{
    use SoftDeletes;
    
    protected $table = 'company_chart_of_accounts';

    protected $fillable = [
        'uuid','code','account_name','coa_group_uuid',
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

    public function AccountGroup(){
        return $this->belongsTo('App\Models\CompanyChartOfAccountAccountGroup','coa_group_uuid','uuid');
    }
   
}