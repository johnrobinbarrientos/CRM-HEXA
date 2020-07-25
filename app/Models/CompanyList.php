<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyList extends Model
{
    use SoftDeletes;
    
    protected $table = 'company_list';

    protected $fillable = [
        'uuid', 'global_address_id', 'company_name','shortname','tagline','website','email','contact_no','tax_id_no','prefix',
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