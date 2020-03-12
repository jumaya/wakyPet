<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mascota extends Model
{
    protected $table = 'mascota';
    protected $primaryKey = 'mascota_id';

     /**
     * The attributes that are more assignable.
     *
     * @var array
     */
    protected $fillable = ['mascota_id', 'nombre', 'raza_id', 'fecha_nacimiento', 'user_id', 'foto'];


    public $timestamps = false;

    /**
     * return clients and his travels with client_id filter
     *
     * @return \App\Client
     * @param  string  $id
     */
    public static function getPet($id)
    {
        return Mascota::select(
            'mascota_id',
            'mascota.nombre',
            'raza.nombre as raza',
            'raza.raza_id as raza_id',
            'fecha_nacimiento',
            'foto'
        )
            ->join('raza', 'raza.raza_id', '=', 'mascota.raza_id')
            ->where('user_id', '=', $id)
            ->get();
    }


    /**
     * return clients and his travels with client_id filter
     *
     * @return \App\Client
     * @param  string  $id
     */
    public static function getPetById($id)
    {
        return Mascota::select(
            'mascota_id',
            'mascota.nombre',
            'raza.nombre as raza',
            'raza.raza_id as raza_id',
            'fecha_nacimiento',
            'foto'
        )
            ->join('raza', 'raza.raza_id', '=', 'mascota.raza_id')
            ->where('mascota_id', '=', $id)
            ->first();
    }


}
