<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerBranch extends Model
{
    use SoftDeletes;
    
    protected $table = 'customer_branch';

    protected $fillable = [
        'uuid','customer_uuid','name','contact_person',
        'address','email_address','contact_no','is_active'
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