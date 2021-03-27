<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemUom extends Model
{
    use SoftDeletes;
    
    protected $table = 'item_uom';

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


    public function GlobalUom(){
        return $this->belongsTo('App\Models\GlobalUom','global_uom_uuid','uuid');
    }

    public function Item(){
        return $this->belongsTo('App\Models\ItemList','item_uuid','uuid');
    }
   
}