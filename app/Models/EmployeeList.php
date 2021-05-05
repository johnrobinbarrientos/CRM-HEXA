<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeList extends Model
{
    use SoftDeletes;
    
    protected $table = 'employee_list';

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

    public function BranchLocation(){
        return $this->belongsTo('App\Models\CompanyBranchLocation','branch_location_uuid','uuid');
    }

    public function Branch(){
        return $this->belongsTo('App\Models\CompanyBranch','branch_uuid','uuid');
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

    public function CostCenter(){
        return $this->belongsTo('App\Models\CostCenter','cost_center_uuid','uuid');
    }

    public function Supervisor(){
        return $this->belongsTo('App\Models\EmployeeList','supervisor_emp_uuid','uuid');
    }

    public function AddressList(){
        return $this->belongsTo('App\Models\AddressList','address_uuid','uuid');
    }

    public function SystemInvitation(){
        return $this->belongsTo('App\Models\EmployeeSystemInvitation','employee_uuid','uuid');
    }
   
}