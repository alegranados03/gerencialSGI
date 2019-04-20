<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
             r.name as nombre_rol 
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
}
