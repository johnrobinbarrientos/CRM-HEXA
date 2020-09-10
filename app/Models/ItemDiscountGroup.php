<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemDiscountGroup extends Model
{
    use SoftDeletes;
    
    protected $table = 'item_discount_group';

    protected $fillable = [
        'uuid', 'company_id', 'group_name', 'discount_type',
        'discount_rate','discount_fixed',
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