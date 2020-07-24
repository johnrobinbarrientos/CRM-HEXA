<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeList extends Model
{
    use SoftDeletes;
    
    protected $table = 'employee_list';

    protected $fillable = [
        'uuid', 'company_id', 'emp_id','first_name','middle_name','last_name',
        'branch_location_uuid','cost_center_uuid','employment_type_uuid','is_custodian',
        'is_driver','wt_uuid','date_hired','date_regularized','date_terminated',
        'emergeny_contact','emergeny_contact_relation','email','contact_no',
        'shared_address_uuid','is_active','is_system_user','daily_wage','is_min_wage',
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