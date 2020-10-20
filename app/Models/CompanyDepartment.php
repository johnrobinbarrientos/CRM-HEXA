<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyDepartment extends Model
{
    use SoftDeletes;
    
    protected $table = 'company_department';

    protected $fillable = [
        'uuid', 'company_id','department','global_cost_center_uuid',
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

    public function GlobalCostCenter(){
        return $this->belongsTo('App\Models\GlobalCostCenter','global_cost_center_uuid','uuid');
    }
   
}