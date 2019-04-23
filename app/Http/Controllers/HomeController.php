<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use app\User;
class HomeController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->isAdmin()){
            $sqlQuery = "SELECT 
            CONCAT(u.primer_nombre, ' ', u.segundo_nombre,' ',u.primer_apellido,' ',u.segundo_apellido) as nombre_usuario, 
            u.email as email,
            r.name as nombre_rol,
            u.id 
            FROM users as u 
            inner join role_user on role_user.user_id=u.id 
            inner join roles as r on role_user.role_id=r.id;";
            
            $usuarios = DB::select(DB::raw($sqlQuery));
            return view('usuario.index',compact('usuarios'));
        }
        else{
            return view('home');
        }
    }

    public function bitacoraUsuarios($idUsuario){
        $sqlQuery = "SELECT 
        CONCAT(user.primer_nombre,' ', user.segundo_nombre, ' ' , user.primer_apellido,' ', user.segundo_apellido) as nombre_completo, historia.comentario_de_actividad, historia.created_at FROM historial_actividad as historia
            INNER JOIN users as user
            ON user.id = historia.user_id
            WHERE user.id=".$idUsuario.";";
        $actividades = DB::select(DB::raw($sqlQuery));
        return view('usuario.bitacora', compact('actividades'));
    }

    public function create(){
        return view('usuario.create');
    }

    public function store(Request $request){
        //User::create($request->all());
        return redirect()->route('home')->with('success','Usuario registrado correctamente');
    }
}
