<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use Excel;
use App\Exports\Export;
class TacticoController extends Controller
{
    //
    public function producto_P1()
    {
        return view('tactico.producto_P1');
    }

    public function ajaxRequestProducto_P1T(Request $request){
        $sqlQuery = "SELECT p.nombre_producto as 'Nombre del producto', sum(d.cantidad_producto) as 'Cantidad Vendida',
         sum(d.total_parcial) as Ingresos FROM gerencial_producto as p JOIN gerencial_detalle_orden as d 
         on p.id=d.producto_id WHERE DATE(d.fecha_registro) BETWEEN '".$_REQUEST['fechaInicio']."' AND '".$_REQUEST['fechaFin']."'
         GROUP BY p.nombre_producto;";
        $usuarios = DB::select(DB::raw($sqlQuery));
        return response($usuarios);
    }

    public function producto_P2()
    {
        return view('tactico.producto_P2');
    }

    public function ajaxRequestProducto_P2T(Request $request){
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

    public function producto_P3()
    {
        return view('tactico.producto_P3');
    }

    public function ajaxRequestProducto_P3T(Request $request){
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

    public function producto_P4()
    {
        return view('tactico.producto_P4');
    }

    public function ajaxRequestProducto_P4T(Request $request){
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

    public function materia_prima_P5()
    {
        return view('tactico.materia_prima_P5');
    }

    public function ajaxRequestMateria_Prima_P5T(Request $request){
        $sqlQuery = "
        SELECT IFNULL(mp.nombre_materia,'Total') AS materia_prima,COUNT(c.id) AS cantidad_compras,SUM(c.costo_compra) as 'costos' 
        FROM gerencial_materia_prima as mp INNER JOIN gerencial_compra as c on mp.id=c.materia_prima_id 
        WHERE DATE(c.fecha_compra) BETWEEN '".$_REQUEST['fechaInicio']."' AND '".$_REQUEST['fechaFin']."'
        GROUP BY mp.nombre_materia WITH ROLLUP;";
        $materia_prima = DB::select(DB::raw($sqlQuery));
        return response($materia_prima);
    }

    public function generarExcel($json){
        return Excel::download(new Export(json_decode($json)),'usuarios_excel.xlsx');
    }

    public function clientes_P6()
    {
        return view('tactico.clientes_P6');
    }

    public function ajaxRequestClientes_P6T(Request $request){
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
