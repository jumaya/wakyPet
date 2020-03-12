<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMascota;
use App\Mascota;
use App\Raza;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DataTables;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session as Session;

class MascotaController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {        
        $valor =  Raza::getRaza();                
        return view('mascota', compact('valor'));
    }

    public function create(Request $request)
    {
        $valor =  Raza::getRaza();
        if ($request->ajax()) {
            $data = Mascota::getPet(Auth::user()->id);
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" title="Edit" data-toggle="tooltip" data-id="' . $row->mascota_id . '" data-original-title="Editar" class="edit btn btn-primary btn-sm editPet"> <i class="fa fa fa-edit"></i> </a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->mascota_id . '" data-original-title="Eliminar" class="btn btn-danger btn-sm deletePet"><i class="fa fa fa-trash"></i></a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('mascota', compact('valor'));
    }

    /**
     * Campo para editar un registro de la mascota
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {           
        $data = Mascota::getPetById($id); 
        Session::put('test', $data->raza_id);        
        return response()->json($data);
    }

    /**
     * Se guarda un registro de la mascota al sistema
     * @param  App\Http\Requests\StoreClient - validate the input data
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMascota $request)
    {        
        $base64 = '';
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->getRealPath();
            $photo = file_get_contents($path);
            $base64 = base64_encode($photo);
        }

        Mascota::updateOrCreate(
            ['mascota_id' => $request->client_id],
            [
                'nombre' => $request->nombre,
                'raza_id' => $request->raza[0],
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'user_id' => Auth::user()->id,
                'foto' => $base64,
            ]
        );

        return redirect()->route('mascota')
            ->with('alert', 'Registro exitoso!');
    }


    /**
     * Actualiza el registro de la mascota con la informacion que obtiene de ajax
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $p = Mascota::select('mascota_id', 'nombre', 'raza_id', 'fecha_nacimiento')
            ->find($request->mascota_id);
        $p->nombre = $request->nombre;
        $p->raza_id = $request->raza;
        $p->fecha_nacimiento = $request->fecha_nacimiento;

        if (is_file($request->foto)) {
            $photo = file_get_contents($request->foto);
            $base64 = base64_encode($photo);
            $p->foto = $base64;
        }
        $p->save();
    }

    /**
     * Elimina el registro de la mascota 
     *
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        Mascota::find($id)->delete();
        return response()->json("Deleted succesfully", 202);
    }
}
