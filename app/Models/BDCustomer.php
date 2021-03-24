<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BDCustomer extends Model
{
    use SoftDeletes;
    
    protected $table = 'bd_customers';


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
    

    public function Discounts(){
        return $this->hasMany('App\Models\BDCustomerDiscount','bd_customer_uuid','uuid');
    }

}