<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemBatchExpiry extends Model
{
    use SoftDeletes;
    
    protected $table = 'item_batch_expiry';

    protected $fillable = [
        'uuid','item_uuid','batch_code','batch_name','date_expiry','accepted_qty',
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