<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectScope extends Model
{
    use SoftDeletes;
    
    protected $table = 'project_scope';

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

    public function ScopeDetails(){
        return $this->hasMany('App\Models\ProjectScopeDetail','project_scope_uuid','uuid');
    }

    // public function ProjectType(){
    //     return $this->belongsTo('App\Models\ProjectType','project_type_uuid','uuid');
    // }
   
}