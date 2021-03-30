<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyBranchLocation extends Model
{
    use SoftDeletes;
    
    protected $table = 'company_branch_location';

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

    public function branch(){
        return $this->belongsTo('App\Models\CompanyBranch','branch_uuid','uuid');
    }
   
}