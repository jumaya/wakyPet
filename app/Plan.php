<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $table = 'planes';
    protected $primaryKey = 'plan_id';

     /**
     * The attributes that are more assignable.
     *
     * @var array
     */
    protected $fillable = ['plan_id', 'descripcion', 'valor'];

    public $timestamps = false;

    public static function getPlan()
    {
        return Plan::all();
    }
    
}
