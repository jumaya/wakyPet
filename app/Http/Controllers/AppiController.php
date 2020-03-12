<?php

namespace App\Http\Controllers;

use App\Mascota;
use App\Plan;
use App\Programacion;
use App\Raza;
use App\User;
use Exception;
use Illuminate\Http\Request;

class AppiController extends Controller
{
    public function getClient()
    {
        $data = User::select('id', 'name', 'email')->get();
        return response()->json($data);
    }

    public function getMascota(Request $request)
    {
        $data = Mascota::getPet($request->get('data'));
        return response()->json($data);
    }

    public function getRaza()
    {
        $data = Raza::all();
        return response()->json($data);
    }

    /**
     * Save a client with his information and return response json.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveMascota(Request $request)
    {
        $a = json_encode($request->all());
        $json = json_decode($a, true);

        try {
            $p = new Mascota();
            $p->nombre = $json['nombre'];
            $p->raza_id = $json['raza'];
            $p->fecha_nacimiento = $json['fecha_nacimiento'];
            $p->user_id = $json['user_id'];
            $p->foto = $json['foto'];
            $p->save();
            return response()->json("Se guardo exitosamente", 200);
        } catch (Exception $e) {
            if ($e instanceof \PDOException) {
                return $e->getMessage();
            }
        }
    }

    public function getProgramacion(Request $request)
    {
        $data = Programacion::getProgramacion($request->get('data'));
        return response()->json($data);
    }

    public function getNameMascota(Request $request)
    {
        $data = Mascota::select('mascota_id', 'nombre')->where('user_id', '=', $request->get('data'))->get();
        return response()->json($data);
    }

    public function getPlan()
    {
        $data = Plan::all();
        return response()->json($data);
    }

    public function saveProgPaseo(Request $request)
    {
        $a = json_encode($request->all());
        $json = json_decode($a, true);

        try {
            $p = new Programacion();
            $p->title = $json['title'];
            $p->mascota_id = $json['mascota_id'];
            $p->plan_id = $json['plan_id'];
            $p->start = $json['start'];
            $p->end = $json['end'];
            $p->save();
            return response()->json("Se guardo exitosamente", 200);
        } catch (Exception $e) {
            if ($e instanceof \PDOException) {
                return $e->getMessage();
            }
        }
    }

}
