<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use Excel;
use PDF;
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

    public function generarPDF_P1($json,$fechaInicio,$fechaFin){
        $datos = json_decode($json);
        $pdf = PDF::loadView('tactico.reportePDF_P1',compact('datos','fechaInicio','fechaFin'));
        $pdf->setPaper('A4','Portrait');
        return $pdf->stream();
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
    public function generarPDF_P2($json,$fechaInicio,$fechaFin){
        $datos = json_decode($json);
        $pdf = PDF::loadView('tactico.reportePDF_P2',compact('datos','fechaInicio','fechaFin'));
        $pdf->setPaper('A4','Portrait');
        return $pdf->stream();
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

    public function generarPDF_P3($json,$fechaInicio,$fechaFin){
        $datos = json_decode($json);
        $pdf = PDF::loadView('tactico.reportePDF_P3',compact('datos','fechaInicio','fechaFin'));
        $pdf->setPaper('A4','Portrait');
        return $pdf->stream();
    }

    public function producto_P4()
    {
        return view('tactico.producto_P4');
    }

    public function ajaxRequestProducto_P4T(Request $request){
        if($_REQUEST["intervalos"] == 1){

            $sqlQuery="SELECT IFNULL(r1.hora,24) as hora,
            IFNULL(CASE
            WHEN (r1.hora = 0) THEN '0:00:00-0:59:59' 
            WHEN (r1.hora= 1) THEN '1:00:00-1:59:59'
            WHEN (r1.hora= 2) THEN '2:00:00-2:59:59'
            WHEN (r1.hora= 3) THEN '3:00:00-3:59:59'
            WHEN (r1.hora= 4) THEN '4:00:00-4:59:59'
            WHEN (r1.hora= 5) THEN '5:00:00-5:59:59'
            WHEN (r1.hora= 6) THEN '6:00:00-6:59:59'
            WHEN (r1.hora= 7) THEN '7:00:00-7:59:59'
            WHEN (r1.hora= 8) THEN '8:00:00-8:59:59'
            WHEN (r1.hora= 9) THEN '9:00:00-9:59:59' 
            WHEN (r1.hora= 10) THEN '10:00:00-10:59:59'
            WHEN (r1.hora= 11) THEN '11:00:00-11:59:59'
            WHEN (r1.hora= 12) THEN '12:00:00-12:59:59'
            WHEN (r1.hora= 13) THEN '13:00:00-13:59:59'
            WHEN (r1.hora= 14) THEN '14:00:00-14:59:59'
            WHEN (r1.hora= 15) THEN '15:00:00-15:59:59'
            WHEN (r1.hora= 16) THEN '16:00:00-16:59:59'
            WHEN (r1.hora= 17) THEN '17:00:00-17:59:59'
            WHEN (r1.hora= 18) THEN '18:00:00-18:59:59'
            WHEN (r1.hora= 19) THEN '19:00:00-19:59:59'
            WHEN (r1.hora= 20) THEN '20:00:00-20:59:59'
            WHEN (r1.hora= 21) THEN '21:00:00-21:59:59'
            WHEN (r1.hora= 22) THEN '22:00:00-22:59:59'
            WHEN (r1.hora= 23) THEN '23:00:00-23:59:59' 
            END,'Total') as rango,
            SUM(IF(r1.ventas=0,0,1)) as ventas, sum(r1.monto) as monto FROM
            (SELECT 0 as hora, 0 as ventas, 0 as monto 
            UNION SELECT 1 as hora, 0 as ventas, 0 as monto
            UNION SELECT 2 as hora, 0 as ventas, 0 as monto
            UNION SELECT 3 as hora, 0 as ventas, 0 as monto
            UNION SELECT 4 as hora, 0 as ventas, 0 as monto
            UNION SELECT 5 as hora, 0 as ventas, 0 as monto
            UNION SELECT 6 as hora, 0 as ventas, 0 as monto
            UNION SELECT 7 as hora, 0 as ventas, 0 as monto
            UNION SELECT 8 as hora, 0 as ventas, 0 as monto
            UNION SELECT 9 as hora, 0 as ventas, 0 as monto
            UNION SELECT 10 as hora, 0 as ventas, 0 as monto
            UNION SELECT 11 as hora, 0 as ventas, 0 as monto
            UNION SELECT 12 as hora, 0 as ventas, 0 as monto
            UNION SELECT 13 as hora, 0 as ventas, 0 as monto
            UNION SELECT 14 as hora, 0 as ventas, 0 as monto
            UNION SELECT 15 as hora, 0 as ventas, 0 as monto
            UNION SELECT 16 as hora, 0 as ventas, 0 as monto
            UNION SELECT 17 as hora, 0 as ventas, 0 as monto
            UNION SELECT 18 as hora, 0 as ventas, 0 as monto
            UNION SELECT 19 as hora, 0 as ventas, 0 as monto
            UNION SELECT 20 as hora, 0 as ventas, 0 as monto
            UNION SELECT 21 as hora, 0 as ventas, 0 as monto
            UNION SELECT 22 as hora, 0 as ventas, 0 as monto
            UNION SELECT 23 as hora, 0 as ventas, 0 as monto
            UNION SELECT HOUR(p.fecha_pago) as hora, p.id as ventas, p.total_cancelar as monto 
            FROM gerencial_pago as p
            WHERE DATE(p.fecha_pago) BETWEEN '"
            .$_REQUEST["fechaInicio"]."' AND '".$_REQUEST["fechaFin"]."') as r1 GROUP BY hora WITH ROLLUP;";

        }elseif ($_REQUEST["intervalos"] == 2) {
            
            $sqlQuery="SELECT IFNULL(CASE
        WHEN (r2.hora>=0 and r2.hora<2) THEN 1
        WHEN (r2.hora>=2 and r2.hora<4) THEN 2
        WHEN (r2.hora>=4 and r2.hora<6) THEN 3
        WHEN (r2.hora>=6 and r2.hora<8) THEN 4
        WHEN (r2.hora>=8 and r2.hora<10)THEN 5
        WHEN (r2.hora>=10 and r2.hora<12)THEN 6
        WHEN (r2.hora>=12 and r2.hora<14)THEN 7 
        WHEN (r2.hora>=14 and r2.hora<16)THEN 8
        WHEN (r2.hora>=16 and r2.hora<18)THEN 9 
        WHEN (r2.hora>=18 and r2.hora<20)THEN 10 
        WHEN (r2.hora>=20 and r2.hora<22)THEN 11 
        WHEN (r2.hora>=22 and r2.hora<24)THEN 12
        END,13) as intervalo,
        IFNULL(CASE
        WHEN (r2.hora>=0 and r2.hora<2) THEN '0:00:00-1:59:59' 
        WHEN (r2.hora>=2 and r2.hora<4) THEN '2:00:00-3:59:59'
        WHEN (r2.hora>=4 and r2.hora<6) THEN '4:00:00-5:59:59' 
        WHEN (r2.hora>=6 and r2.hora<8) THEN '6:00:00-7:59:59' 
        WHEN (r2.hora>=8 and r2.hora<10)THEN '8:00:00-9:59:59' 
        WHEN (r2.hora>=10 and r2.hora<12)THEN'10:00:00-11:59:59' 
        WHEN (r2.hora>=12 and r2.hora<14)THEN'12:00:00-13:59:59' 
        WHEN (r2.hora>=14 and r2.hora<16)THEN'14:00:00-15:59:59' 
        WHEN (r2.hora>=16 and r2.hora<18)THEN'16:00:00-17:59:59' 
        WHEN (r2.hora>=18 and r2.hora<20)THEN'18:00:00-19:59:59' 
        WHEN (r2.hora>=20 and r2.hora<22)THEN'20:00:00-21:59:59' 
        WHEN (r2.hora>=22 and r2.hora<24)THEN'22:00:00-23:59:59' 
        END,'Total') as rango,SUM(r2.ventas) as ventas,SUM(r2.monto) as monto 
        FROM 
        (SELECT r1.hora as hora, SUM(IF(r1.ventas=0,0,1)) as ventas, sum(r1.monto) as monto 
        FROM
        (SELECT 0 as hora, 0 as ventas, 0 as monto 
        UNION SELECT 1 as hora, 0 as ventas, 0 as monto
        UNION SELECT 2 as hora, 0 as ventas, 0 as monto
        UNION SELECT 3 as hora, 0 as ventas, 0 as monto
        UNION SELECT 4 as hora, 0 as ventas, 0 as monto
        UNION SELECT 5 as hora, 0 as ventas, 0 as monto
        UNION SELECT 6 as hora, 0 as ventas, 0 as monto
        UNION SELECT 7 as hora, 0 as ventas, 0 as monto
        UNION SELECT 8 as hora, 0 as ventas, 0 as monto
        UNION SELECT 9 as hora, 0 as ventas, 0 as monto
        UNION SELECT 10 as hora, 0 as ventas, 0 as monto
        UNION SELECT 11 as hora, 0 as ventas, 0 as monto
        UNION SELECT 12 as hora, 0 as ventas, 0 as monto
        UNION SELECT 13 as hora, 0 as ventas, 0 as monto
        UNION SELECT 14 as hora, 0 as ventas, 0 as monto
        UNION SELECT 15 as hora, 0 as ventas, 0 as monto
        UNION SELECT 16 as hora, 0 as ventas, 0 as monto
        UNION SELECT 17 as hora, 0 as ventas, 0 as monto
        UNION SELECT 18 as hora, 0 as ventas, 0 as monto
        UNION SELECT 19 as hora, 0 as ventas, 0 as monto
        UNION SELECT 20 as hora, 0 as ventas, 0 as monto
        UNION SELECT 21 as hora, 0 as ventas, 0 as monto
        UNION SELECT 22 as hora, 0 as ventas, 0 as monto
        UNION SELECT 23 as hora, 0 as ventas, 0 as monto
        UNION SELECT HOUR(p.fecha_pago) as hora, p.id as ventas, p.total_cancelar as monto 
        FROM gerencial_pago as p
        WHERE DATE(p.fecha_pago) BETWEEN '"
        .$_REQUEST["fechaInicio"]."' AND '".$_REQUEST["fechaFin"]
        ."') as r1 GROUP BY hora WITH ROLLUP) as r2  GROUP BY rango,intervalo ORDER BY intervalo;";

        }elseif ($_REQUEST["intervalos"] == 3) {
            
            $sqlQuery="";

        }elseif ($_REQUEST["intervalos"] == 4) {
            
            $sqlQuery="";

        }elseif ($_REQUEST["intervalos"] == 6) {
            
            $sqlQuery="";

        }elseif ($_REQUEST["intervalos"] == 8) {
            
            $sqlQuery="";

        }elseif ($_REQUEST["intervalos"] == 12) {
            
            $sqlQuery="";

        }
        $ventas = DB::select(DB::raw($sqlQuery));
        return response($ventas);
    }

    public function generarPDF_P4($json,$fechaInicio,$fechaFin){
        $datos = json_decode($json);
        $pdf = PDF::loadView('tactico.reportePDF_P4',compact('datos','fechaInicio','fechaFin'));
        $pdf->setPaper('A4','Portrait');
        return $pdf->stream();
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

    public function generarPDF_P5($json,$fechaInicio,$fechaFin){
        $datos = json_decode($json);
        $pdf = PDF::loadView('tactico.reportePDF_P5',compact('datos','fechaInicio','fechaFin'));
        $pdf->setPaper('A4','Portrait');
        return $pdf->stream();
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

    public function generarPDF_P6($json,$fechaInicio,$fechaFin){
        $datos = json_decode($json);
        $pdf = PDF::loadView('tactico.reportePDF_P6',compact('datos','fechaInicio','fechaFin'));
        $pdf->setPaper('A4','Portrait');
        return $pdf->stream();
    }

    public function generarExcel($json){
        return Excel::download(new Export(json_decode($json)),'usuarios_excel.xlsx');
    }

}
