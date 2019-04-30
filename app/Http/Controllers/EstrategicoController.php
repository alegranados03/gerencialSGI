<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use PDF;
class EstrategicoController extends Controller
{   
    // metodo de reordenación de resultados de un sql
    public function reordenar(Array $respuesta): Array {
        $respuesta[]=array_shift($respuesta);
        return $respuesta;

    }

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
        


        $sqlQuery="SELECT IFNULL(r.nombre,'Total') as nombre, sum(r.ingresos) as ingresos FROM (

            SELECT nombre_categoria as nombre, 0 as ingresos FROM gerencial_categoria
            UNION
            SELECT c.nombre_categoria as nombre,sum(d.total_parcial) as ingresos FROM gerencial_detalle_orden d 
            INNER JOIN gerencial_producto p
            ON d.producto_id=p.id 
            INNER JOIN gerencial_categoria c 
            ON p.categoria_id=c.id
            WHERE DATE(d.fecha_registro) BETWEEN '".$_REQUEST['fechaInicio']."' AND '".$_REQUEST['fechaFin']."'
            GROUP BY c.nombre_categoria WITH ROLLUP) as r
            
            GROUP BY nombre ORDER BY ingresos DESC;";

        $categorias = DB::select(DB::raw($sqlQuery));
        $categorias= $this->reordenar($categorias);
        
        return response($categorias);
    }

    public function generarPDF_P1($json,$fechaInicio,$fechaFin,$tituloReporte){
        $datos = json_decode($json);
        $pdf = PDF::loadView('estrategico.reportePDF_P1',compact('datos','fechaInicio','fechaFin','tituloReporte'));
        $pdf->setPaper('A4','Portrait');
        return $pdf->stream();
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

    public function generarPDF_P2($json,$fechaInicio,$fechaFin,$tituloReporte){
        $datos = json_decode($json);
        $pdf = PDF::loadView('estrategico.reportePDF_P2',compact('datos','fechaInicio','fechaFin','tituloReporte'));
        $pdf->setPaper('A4','Portrait');
        return $pdf->stream();
    }

    public function materia_prima_P3()
    {
        return view('estrategico.materia_prima_P3');
    }

    public function ajaxRequestMateria_Prima_P3E(Request $request){
        $sqlQuery = "SELECT IFNULL(r.nombre,'Total') as nombre,
         sum(r.cantidad) as cantidad,
         sum(r.costos) as costos FROM (

            SELECT nombre_proveedor as nombre, 0 as cantidad, 0 as costos FROM gerencial_proveedor
            UNION
            SELECT p.nombre_proveedor as nombre,count(c.id) as cantidad, sum(c.costo_compra) as costos FROM 
            gerencial_compra as c 
            INNER JOIN gerencial_proveedor as p 
            ON c.proveedor_id=p.id
            WHERE DATE(c.fecha_compra) BETWEEN '".$_REQUEST['fechaInicio']."' AND '".$_REQUEST['fechaFin']."'
            GROUP BY nombre WITH ROLLUP) as r 
            
            GROUP BY r.nombre ORDER BY costos DESC;";

        $proveedores = DB::select(DB::raw($sqlQuery));
        $proveedores= $this->reordenar($proveedores);
        return response($proveedores);
    }

    public function generarPDF_P3($json,$fechaInicio,$fechaFin,$tituloReporte){
        $datos = json_decode($json);
        $pdf = PDF::loadView('estrategico.reportePDF_P3',compact('datos','fechaInicio','fechaFin','tituloReporte'));
        $pdf->setPaper('A4','Portrait');
        return $pdf->stream();
    }


    public function clientes_P4()
    {
        return view('estrategico.clientes_P4');
    }
    public function ajaxRequestClientes_P4E(Request $request){
        $sqlQuery = "SELECT IFNULL(tipo_pago,'Total') as tipo,
        count(*) as cantidad,
        sum(total_cancelar) as ingresos 
        
        FROM gerencial_pago
        WHERE DATE(fecha_pago) BETWEEN '".$_REQUEST['fechaInicio']."' AND '".$_REQUEST['fechaFin']."'
        GROUP BY tipo_pago WITH ROLLUP;";
        $pagos = DB::select(DB::raw($sqlQuery));
        return response($pagos);
    }

    public function generarPDF_P4($json,$fechaInicio,$fechaFin,$tituloReporte){
        $datos = json_decode($json);
        $pdf = PDF::loadView('estrategico.reportePDF_P4',compact('datos','fechaInicio','fechaFin','tituloReporte'));
        $pdf->setPaper('A4','Portrait');
        return $pdf->stream();
    }

    public function clientes_P5()
    {
        return view('estrategico.clientes_P5');
    }

    public function ajaxRequestClientes_P5E(Request $request){
        $sqlQuery="SELECT IFNULL((CASE
        WHEN u.sexo='M' THEN 'Masculino'
        WHEN u.sexo='F' THEN 'Femenino' END),'Total') as sexo, 
        count(o.id) as cantidad,
        sum(p.total_cancelar) as ingresos        
        FROM gerencial_usuario as u 
        INNER JOIN gerencial_orden as o ON u.id=o.user_id 
        INNER JOIN gerencial_pago as p ON o.id=p.orden_id
        WHERE DATE(p.fecha_pago) BETWEEN '".$_REQUEST['fechaInicio']."' AND '".$_REQUEST['fechaFin']."'
        AND u.es_cliente=TRUE
        AND o.tipo_orden='EN LINEA'
        GROUP BY sexo WITH ROLLUP;";
        
        $usuarios = DB::select(DB::raw($sqlQuery));
        return response($usuarios);
    }

    public function generarPDF_P5($json,$fechaInicio,$fechaFin,$tituloReporte){
        $datos = json_decode($json);
        $pdf = PDF::loadView('estrategico.reportePDF_P5',compact('datos','fechaInicio','fechaFin','tituloReporte'));
        $pdf->setPaper('A4','Portrait');
        return $pdf->stream();
    }

}
