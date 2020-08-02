<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyList extends Model
{
    use SoftDeletes;

    protected $table = 'company_list';

    protected $fillable = [
        'company_name', 'shortname', 'tagline', 'website', 'email',
        'contact_no', 'tax_id_no', 'prefix', 'global_address_uuid',
    ];
   
    public function users()
    {
        return $this->hasMany('App\Models\User');
    }

    public function AddressList(){
        return $this->belongsTo('App\Models\GlobalAddressList','global_address_uuid','uuid');
    }
}
