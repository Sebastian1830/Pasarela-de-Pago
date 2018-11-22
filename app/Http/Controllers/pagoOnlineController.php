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

    public function index()
    {
        $id =  auth()->user()->apoderado_id ;
        $alumnos = \DB::select("call up_alumxapo({$id})");
        return view('pagoOnline')->with('alumnos',$alumnos);
    }
}
