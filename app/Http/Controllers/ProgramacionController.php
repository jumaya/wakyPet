<?php

namespace App\Http\Controllers;

use App\Mascota;
use App\Plan;
use App\Programacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgramacionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $mascota = Mascota::getPet(Auth::user()->id); 
        $plan = Plan::getPlan();
        if (request()->ajax()) {
            $start = (!empty($_GET["start"])) ? ($_GET["start"]) : ('');
            $end = (!empty($_GET["end"])) ? ($_GET["end"]) : ('');
            $data =  Programacion::select(        
                'id',
                'title',
                'start',
                'end')
                ->join('mascota', 'mascota.mascota_id', '=', 'programacion.mascota_id')
                ->whereDate('start', '>=', $start)
                ->whereDate('end',   '<=', $end)
                ->where('mascota.user_id', '=', Auth::user()->id)
                ->get();            
            return response()->json($data);
        }
        
        return view('programacion', compact('mascota', 'plan'));
    }


    public function store(Request $request)
    {
        $insertArr = [
            'title' => $request->title,            
            'start' => $request->start,
            'end' => $request->end,
            'mascota_id' => $request->mascota_id,
            'plan_id' => $request->plan_id,
        ];
        $event = Programacion::insert($insertArr);
        return response()->json($event);
    }


    public function update(Request $request)
    {
        $where = array('id' => $request->id);
        $updateArr = ['start' => $request->start, 'end' => $request->end];
        $event  = Programacion::where($where)->update($updateArr);
        return response()->json($event);
    }

    public function destroy(Request $request)
    {
        $event = Programacion::where('id', $request->id)->delete();
        return response()->json($event);
    }
}
