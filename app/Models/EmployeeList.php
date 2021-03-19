<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeList extends Model
{
    use SoftDeletes;
    
    protected $table = 'employee_list';

    protected $fillable = [
        'uuid','user_id','emp_id','first_name','middle_name','last_name',
        'ext', 'branch_location_uuid', 'is_custodian', 'is_driver', 'is_system_user',
        'is_active', 'email', 'contact_no', 'emergency_contact', 'contact_relation',
        'emergency_contact_no', 'employment_type_uuid', 'date_hired', 'date_regularized',
        'date_separated', 'is_min_wage', 'daily_wage', 'cost_center_uuid',
        'tax_id', 'sss_id', 'phic_id', 'hdmf_id', 'address_uuid', 'address1','job_title',
        'is_supervisor','employment_status_uuid','birth_date','department_uuid','gender','profile_pic',
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

    public function Department(){
        return $this->belongsTo('App\Models\CompanyDepartment','department_uuid','uuid');
    }
    public function EmploymentType(){
        return $this->belongsTo('App\Models\EmployeeEmploymentType','employment_type_uuid','uuid');
    }
    public function EmploymentStatus(){
        return $this->belongsTo('App\Models\EmployeeEmploymentStatus','employment_status_uuid','uuid');
    }

    public function SystemInvitation(){
        return $this->belongsTo('App\Models\EmployeeSystemInvitation','employee_uuid','uuid');
    }
   
}