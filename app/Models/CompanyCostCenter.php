<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyCostCenter extends Model
{
    use SoftDeletes;
    
    protected $table = 'company_cost_center';

    protected $fillable = [
        'uuid', 'company_id', 'cost_center_name','cost_center_shortname','is_group','cost_center_group',
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