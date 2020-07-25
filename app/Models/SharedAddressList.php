<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SharedAddressList extends Model
{
    use SoftDeletes;
    
    protected $table = 'shared_address_list';

    protected $fillable = [
        'uuid', 'barangay', 'city_municipality','province','region','country','postal_code',
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