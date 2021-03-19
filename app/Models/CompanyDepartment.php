<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyDepartment extends Model
{
    use SoftDeletes;
    
    protected $table = 'company_department';

    protected $fillable = [
        'uuid','department','cost_center_uuid',
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

    public function CostCenter(){
        return $this->belongsTo('App\Models\CostCenter','cost_center_uuid','uuid');
    }
   
}