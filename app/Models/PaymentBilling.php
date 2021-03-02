<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentBilling extends Model
{
    use SoftDeletes;
    
    protected $table = 'payment_billings';
    
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


    public function Payment(){
        return $this->belongsTo('App\Models\Payment','payment_uuid','uuid');
    }
    
    public function Billings(){
        return $this->belongsTo('App\Models\PaymentBilling','billing_uuid','uuid');
    }
}