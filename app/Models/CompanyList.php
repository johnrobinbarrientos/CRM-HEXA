<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyList extends Model
{
    use SoftDeletes;

    protected $table = 'company_list';

    protected $fillable = [];
   
    public function users()
    {
        return $this->hasMany('App\Models\User');
    }

    public function AddressList(){
        return $this->belongsTo('App\Models\GlobalAddressList','address_uuid','uuid');
    }
}
