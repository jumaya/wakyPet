<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Programacion extends Model
{
    protected $table = 'programacion';
    protected $primaryKey = 'id';

     /**
     * The attributes that are more assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'title', 'mascota_id', 'plan_id', 'start', 'end'];

    public $timestamps = false;

     /**
     * return clients and his travels with client_id filter
     *
     * @return \App\Client
     * @param  string  $id
     */
    public static function getProgramacion($id) {
    return Programacion::select(        
        'id',
        'title',
        'start',
        'end')
        ->join('mascota', 'mascota.mascota_id', '=', 'programacion.mascota_id')        
        ->where('mascota.user_id', '=', $id)
        ->get();
    }   
}
