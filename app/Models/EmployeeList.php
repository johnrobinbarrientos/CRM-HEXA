<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeList extends Model
{
    use SoftDeletes;
    
    protected $table = 'employee_list';

    protected $fillable = [
        'uuid','user_id','company_id', 'emp_id','first_name','middle_name','last_name',
        'ext', 'branch_location_uuid', 'is_custodian', 'is_driver', 'is_system_user',
        'is_active', 'email', 'contact_no', 'emergeny_contact', 'emergeny_contact_relation',
        'relation_contact_no', 'employment_type_uuid', 'date_hired', 'date_regularized',
        'date_terminated', 'is_min_wage', 'daily_wage', 'cost_center_uuid', 'is_applied_tax',
        'wt_uuid', 'tax_id', 'sss_id', 'phic_id', 'hdmf_id', 'global_address_uuid', 'address1',
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

    public function BranchLocation(){
        return $this->belongsTo('App\Models\CompanyBranchLocation','branch_location_uuid','uuid');
    }
   
}