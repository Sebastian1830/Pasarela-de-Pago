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
        return view('pagoOnline')->with('alumnos',$alumnos)->with('pagos',$pagos);
    }
}
