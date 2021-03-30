<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyPaymentTerm extends Model
{
    use SoftDeletes;
    
    protected $table = 'company_payment_term';

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
   
}