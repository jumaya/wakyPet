<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Raza extends Model
{
    protected $table = 'raza';
    protected $primaryKey = 'raza_id';

     /**
     * The attributes that are more assignable.
     *
     * @var array
     */
    protected $fillable = ['raza_id', 'nombre'];

    public $timestamps = false;


    /**
     * return clients and his travels with client_id filter
     * @return \App\Client
     * @param  string  $id
     */
    public static function getRaza()
    {
        return Raza::all();
    }

}
