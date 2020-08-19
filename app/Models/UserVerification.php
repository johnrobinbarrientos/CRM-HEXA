<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserVerification extends Model
{
    use SoftDeletes;
    
    protected $table = 'user_verifications';

    protected $fillable = [
        'user_id', 'verification_code', 'status'
    ];
}