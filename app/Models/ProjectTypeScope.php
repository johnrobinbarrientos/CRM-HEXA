<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectTypeScope extends Model
{
    use SoftDeletes;
    
    protected $table = 'project_type_scopes';

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

    public function TypeScope(){
        return $this->belongsTo('App\Models\ProjectScope','project_scope_uuid','uuid');
    }
   
}