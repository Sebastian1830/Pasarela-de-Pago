<?php

namespace App\Http\Controllers;

use App\Alumno;
use Illuminate\Http\Request;

class pagoOnlineController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $idapoderado =  auth()->user()->apoderado_id;
        $alumnos = \DB::select("call up_alumxapo({$idapoderado})");
        $idalumno = $request->input('alumno_id');
        $pagos = \DB::select('call up_pago(?,?)',array($idapoderado,$idalumno));
        $refresh = $idalumno == null ? true : false;
        return view('pagoOnline')->with('alumnos',$alumnos)->with('pagos',$pagos)->with('exist',$refresh);
    }

    public function update(Request $request){
        $id = $request->id;
        $status = $request->status;

        $date= date('Y-m-d');

        \DB::table('pagos')
            ->where('id', $id)
            ->update(['estado' => $status]);

        \DB::table('bitacorapago')->insert(
            ['pagos_id' => $id, 'fechaPago' => $date]
        );
        return "Actualizado a Pagado"; 
    }
}
