<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupplierCheckPayee extends Model
{
    use SoftDeletes;
    
    protected $table = 'supplier_check_payees';

    protected $fillable = [
        'uuid', 'company_id', 'supplier_uuid', 'check_payee',
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