<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class EstrategicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function producto_P1()
    {
        return view('estrategico.producto_P1');
    }

    public function ajaxRequestProducto_P1E(Request $request){
        $sqlQuery = "SELECT 
        CONCAT(u.primer_nombre, ' ', u.segundo_nombre,' ',u.primer_apellido,' ',u.segundo_apellido) as 'Nombre Completo', 
        u.email as email,
        r.name as rol,
        u.created_at as Creado
        FROM users as u 
        inner join role_user on role_user.user_id=u.id 
        inner join roles as r on role_user.role_id=r.id
        WHERE u.created_at >= '".$_REQUEST['fechaInicio']." 00:00:00' AND u.created_at <='".$_REQUEST['fechaFin']." 23:59:59';";
        $usuarios = DB::select(DB::raw($sqlQuery));
        return response($usuarios);
    }


    public function producto_P2()
    {
        return view('estrategico.producto_P2');
    }

    public function ajaxRequestProducto_P2E(Request $request){
        $sqlQuery = "SELECT 
        CONCAT(u.primer_nombre, ' ', u.segundo_nombre,' ',u.primer_apellido,' ',u.segundo_apellido) as 'Nombre Completo', 
        u.email as email,
        r.name as rol,
        u.created_at as Creado
        FROM users as u 
        inner join role_user on role_user.user_id=u.id 
        inner join roles as r on role_user.role_id=r.id
        WHERE u.created_at >= '".$_REQUEST['fechaInicio']." 00:00:00' AND u.created_at <='".$_REQUEST['fechaFin']." 23:59:59';";
        $usuarios = DB::select(DB::raw($sqlQuery));
        return response($usuarios);
    }


    public function materia_prima_P3()
    {
        return view('estrategico.materia_prima_P3');
    }

    public function ajaxRequestMateria_Prima_P3E(Request $request){
        $sqlQuery = "SELECT 
        CONCAT(u.primer_nombre, ' ', u.segundo_nombre,' ',u.primer_apellido,' ',u.segundo_apellido) as 'Nombre Completo', 
        u.email as email,
        r.name as rol,
        u.created_at as Creado
        FROM users as u 
        inner join role_user on role_user.user_id=u.id 
        inner join roles as r on role_user.role_id=r.id
        WHERE u.created_at >= '".$_REQUEST['fechaInicio']." 00:00:00' AND u.created_at <='".$_REQUEST['fechaFin']." 23:59:59';";
        $usuarios = DB::select(DB::raw($sqlQuery));
        return response($usuarios);
    }


    public function clientes_P4()
    {
        return view('estrategico.clientes_P4');
    }
    public function ajaxRequestClientes_P4E(Request $request){
        $sqlQuery = "SELECT 
        CONCAT(u.primer_nombre, ' ', u.segundo_nombre,' ',u.primer_apellido,' ',u.segundo_apellido) as 'Nombre Completo', 
        u.email as email,
        r.name as rol,
        u.created_at as Creado
        FROM users as u 
        inner join role_user on role_user.user_id=u.id 
        inner join roles as r on role_user.role_id=r.id
        WHERE u.created_at >= '".$_REQUEST['fechaInicio']." 00:00:00' AND u.created_at <='".$_REQUEST['fechaFin']." 23:59:59';";
        $usuarios = DB::select(DB::raw($sqlQuery));
        return response($usuarios);
    }

    public function clientes_P5()
    {
        return view('estrategico.clientes_P5');
    }

    public function ajaxRequestClientes_P5E(Request $request){
        $sqlQuery = "SELECT 
        CONCAT(u.primer_nombre, ' ', u.segundo_nombre,' ',u.primer_apellido,' ',u.segundo_apellido) as 'Nombre Completo', 
        u.email as email,
        r.name as rol,
        u.created_at as Creado
        FROM users as u 
        inner join role_user on role_user.user_id=u.id 
        inner join roles as r on role_user.role_id=r.id
        WHERE u.created_at >= '".$_REQUEST['fechaInicio']." 00:00:00' AND u.created_at <='".$_REQUEST['fechaFin']." 23:59:59';";
        $usuarios = DB::select(DB::raw($sqlQuery));
        return response($usuarios);
    }

}
