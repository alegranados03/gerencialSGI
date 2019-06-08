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
    /* método que registra la acción hecha por el usuario
      en el historial de actividades */
    public function registrarEnBitacora($idUser,$accion) {
        $fecha = new \DateTime('now');
        DB::table('historial_actividad')
        ->insert(['user_id' => $idUser ,
                  'created_at'=>$fecha->format( 'Y-m-d H:i:s'),
                  'comentario_de_actividad'=>$accion
                                       ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     /* Sección de Reporte de ingresos por venta por categoria. */
    public function producto_P1()
    {  //Registro en bitacora
        $comentario="Accedió a la pantalla de Reporte de ingresos por venta por categoria.";
        $this->registrarEnBitacora(Auth::user()->id,$comentario);
        //fin
        return view('estrategico.producto_P1');
    }

    public function ajaxRequestProducto_P1E(Request $request){
        //Registro en bitacora
        $comentario="Solicitó generar un Reporte de ingresos por venta por categoria desde
        ".$_REQUEST['fechaInicio']." hasta ".$_REQUEST['fechaFin'].".";
        $this->registrarEnBitacora(Auth::user()->id,$comentario);
        //fin
        $sqlQuery="SELECT IFNULL(r.nombre,'Total') as nombre, sum(r.ingresos) 
        as ingresos FROM (

            SELECT nombre_categoria as nombre, 0 as ingresos FROM gerencial_categoria
            UNION
            SELECT c.nombre_categoria as nombre,sum(d.total_parcial) as ingresos 
            FROM gerencial_detalle_orden d
            INNER JOIN gerencial_producto p
            ON d.producto_id=p.id
            INNER JOIN gerencial_categoria c
            ON p.categoria_id=c.id
            WHERE DATE(d.fecha_registro) 
            BETWEEN '".$_REQUEST['fechaInicio']."' AND '".$_REQUEST['fechaFin']."'
            GROUP BY c.nombre_categoria WITH ROLLUP) as r
            GROUP BY nombre ORDER BY ingresos DESC;";

        $categorias = DB::select(DB::raw($sqlQuery));
        $categorias= $this->reordenar($categorias);

        return response($categorias);
    }
    // Función para generar PDF
    public function generarPDF_P1(Request $request){

        $this->validate($request,[
            'fechaInicio2'=>'required|date|before:today',
            'fechaFin2'=>'required|date|before:today|after:fechaInicio2'
              ]);
        $datos = json_decode($request->json);
        $fechaInicio = $request->fechaInicio2;
        $fechaFin = $request->fechaFin2;
        $tituloReporte = $request->tituloReporte;

        //registro en bitacora
        $comentario="Solicitó generar un Reporte en pdf de ingresos por venta por categoria desde
        ".$fechaInicio." hasta ".$fechaFin.".";
        $this->registrarEnBitacora(Auth::user()->id,$comentario);
        //fin

        $pdf = PDF::loadView('estrategico.reportePDF_P1',compact('datos','fechaInicio','fechaFin','tituloReporte'));
        $pdf->setPaper('A4','Portrait');
        return $pdf->stream($tituloReporte.'.pdf');
    }
    /* Fin Sección de Reporte de ingresos por venta por categoria. */

    /* Sección de Reporte de ganancia bruta por categoria. */
    public function producto_P2()
    {   //Registro en bitacora
        $comentario="Accedió a la pantalla de Reporte de ganancia bruta por categoria.";
        $this->registrarEnBitacora(Auth::user()->id,$comentario);
        //fin
        return view('estrategico.producto_P2');
    }

    public function ajaxRequestProducto_P2E(Request $request){
        //Registro en bitacora
        $comentario="Solicitó generar un Reporte de ganancia bruta por categoria desde
         ".$_REQUEST['fechaInicio']." hasta ".$_REQUEST['fechaFin'].".";
        $this->registrarEnBitacora(Auth::user()->id,$comentario);
         //fin
        $sqlQuery="SELECT IFNULL(g.nombre_categoria,'Total') as categoria,
        SUM((t_ingresos.ingresos-t_costos.costos)) as ganancia FROM (
            SELECT r.id,r.nombre as nombre, SUM(r.ingresos) AS ingresos,
             r.categoria_id FROM(
            SELECT id,nombre_producto AS nombre, 0 AS ingresos,categoria_id 
            FROM gerencial_producto
            UNION
            SELECT p.id,
            p.nombre_producto AS nombre,
            sum(d.total_parcial) AS ingresos,
            p.categoria_id
            FROM
            gerencial_producto AS p 
            INNER JOIN gerencial_detalle_orden as d on p.id=d.producto_id
            WHERE DATE(d.fecha_registro) 
            BETWEEN '".$_REQUEST['fechaInicio']."' AND '".$_REQUEST['fechaFin']."'
            GROUP BY nombre) AS r

            GROUP BY nombre ORDER BY ingresos DESC

            ) AS t_ingresos

            INNER JOIN (

            SELECT r.id,r.nombre as nombre, SUM(r.total_costo) AS costos,categoria_id FROM(
            SELECT id,nombre_producto as nombre ,0 as total_costo,categoria_id 
            FROM gerencial_producto
            UNION
            SELECT
            p.id as id,
            p.nombre_producto as nombre,
            SUM(l.total) as total_costo,
            p.categoria_id

            from gerencial_lote as l INNER JOIN gerencial_producto as p
            ON p.id=l.producto_id
            WHERE DATE(l.fecha_registro) 
            BETWEEN '".$_REQUEST['fechaInicio']."' AND '".$_REQUEST['fechaFin']."'
            GROUP BY nombre) AS r

            GROUP BY nombre

            ) AS t_costos

            ON t_costos.id=t_ingresos.id

            INNER JOIN gerencial_categoria AS g
            ON t_ingresos.categoria_id=g.id

            GROUP BY g.nombre_categoria WITH ROLLUP ;";


        $categorias = DB::select(DB::raw($sqlQuery));
        return response($categorias);
    }
    // Función para generar PDF
    public function generarPDF_P2(Request $request){
        $this->validate($request,[
            'fechaInicio2'=>'required|date|before:today',
            'fechaFin2'=>'required|date|before:today|after:fechaInicio2'
              ]);
        $datos = json_decode($request->json);
        $fechaInicio = $request->fechaInicio2;
        $fechaFin = $request->fechaFin2;
        $tituloReporte = $request->tituloReporte;

        //registro en bitacora
        $comentario="Solicitó generar un Reporte en pdf de ganancia bruta por categoria desde
        ".$fechaInicio." hasta ".$fechaFin.".";
        $this->registrarEnBitacora(Auth::user()->id,$comentario);
        //fin

        $pdf = PDF::loadView('estrategico.reportePDF_P2',compact('datos','fechaInicio','fechaFin','tituloReporte'));
        $pdf->setPaper('A4','Portrait');
        return $pdf->stream($tituloReporte.'.pdf');
    }
    /* Fin Sección de Reporte de ganancia bruta por categoria. */
    
    /*Sección de Reporte de Costos de Materia Prima por Proveedor. */
    public function materia_prima_P3()
    {   //Registro en bitacora
        $comentario="Accedió a la pantalla de Reporte de Costos de Materia Prima por Proveedor.";
        $this->registrarEnBitacora(Auth::user()->id,$comentario);
        //fin
        return view('estrategico.materia_prima_P3');
    }

    public function ajaxRequestMateria_Prima_P3E(Request $request){
       //Registro en bitacora
       $comentario="Solicitó generar un Reporte de Costos de Materia Prima por Proveedor desde
       ".$_REQUEST['fechaInicio']." hasta ".$_REQUEST['fechaFin'].".";
       $this->registrarEnBitacora(Auth::user()->id,$comentario);
       //fin

       $sqlQuery = "SELECT IFNULL(r.nombre,'Total') as nombre,
         sum(r.cantidad) as cantidad,
         sum(r.costos) as costos FROM (

            SELECT nombre_proveedor as nombre, 0 as cantidad, 0 as costos 
            FROM gerencial_proveedor
            UNION
            SELECT p.nombre_proveedor as nombre,count(c.id) as cantidad, 
            sum(c.costo_compra) as costos FROM
            gerencial_compra as c
            INNER JOIN gerencial_proveedor as p
            ON c.proveedor_id=p.id
            WHERE DATE(c.fecha_compra) 
            BETWEEN '".$_REQUEST['fechaInicio']."' AND '".$_REQUEST['fechaFin']."'
            GROUP BY nombre WITH ROLLUP) as r

            GROUP BY r.nombre ORDER BY costos DESC;";

        $proveedores = DB::select(DB::raw($sqlQuery));
        $proveedores= $this->reordenar($proveedores);
        return response($proveedores);
    }

    // Función para generar PDF
    public function generarPDF_P3(Request $request){

        $this->validate($request,[
            'fechaInicio2'=>'required|date|before:today',
            'fechaFin2'=>'required|date|before:today|after:fechaInicio2'
              ]);
        $datos = json_decode($request->json);
        $fechaInicio = $request->fechaInicio2;
        $fechaFin = $request->fechaFin2;
        $tituloReporte = $request->tituloReporte;

        //registro en bitacora
        $comentario="Solicitó generar un Reporte en pdf de Ingresos por venta por producto desde
        ".$fechaInicio." hasta ".$fechaFin.".";
        $this->registrarEnBitacora(Auth::user()->id,$comentario);
        //fin

        $pdf = PDF::loadView('estrategico.reportePDF_P3',compact('datos','fechaInicio','fechaFin','tituloReporte'));
        $pdf->setPaper('A4','Portrait');
        return $pdf->stream($tituloReporte.'.pdf');
    }
    /*Fin Sección de Reporte de Costos de Materia Prima por Proveedor. */

    /*Sección de Reporte de Preferencia de pago de los clientes. */
    public function clientes_P4()
    {  //Registro en bitacora
        $comentario="Accedió a la pantalla de Reporte de Preferencia de pago de los clientes.";
        $this->registrarEnBitacora(Auth::user()->id,$comentario);
        //fin
        return view('estrategico.clientes_P4');
    }
    public function ajaxRequestClientes_P4E(Request $request){
         //Registro en bitacora
         $comentario="Solicitó generar un Reporte de Preferencia de pago de los clientes desde
         ".$_REQUEST['fechaInicio']." hasta ".$_REQUEST['fechaFin'].".";
         $this->registrarEnBitacora(Auth::user()->id,$comentario);
         //fin
        $sqlQuery = "SELECT IFNULL(tipo_pago,'Total') as tipo,
        count(*) as cantidad,
        sum(total_cancelar) as ingresos

        FROM gerencial_pago
        WHERE DATE(fecha_pago) 
        BETWEEN '".$_REQUEST['fechaInicio']."' AND '".$_REQUEST['fechaFin']."'
        GROUP BY tipo_pago WITH ROLLUP;";
        $pagos = DB::select(DB::raw($sqlQuery));
        return response($pagos);
    }
    
    // Función para generar PDF
    public function generarPDF_P4(Request $request){
        $this->validate($request,[
            'fechaInicio2'=>'required|date|before:today',
            'fechaFin2'=>'required|date|before:today|after:fechaInicio2'
              ]);
        $datos = json_decode($request->json);
        $fechaInicio = $request->fechaInicio2;
        $fechaFin = $request->fechaFin2;
        $tituloReporte = $request->tituloReporte;

        //registro en bitacora
          $comentario="Solicitó generar un Reporte en pdf de Preferencia de pago de los clientes desde
          ".$fechaInicio." hasta ".$fechaFin.".";
          $this->registrarEnBitacora(Auth::user()->id,$comentario);
         //fin

        $pdf = PDF::loadView('estrategico.reportePDF_P4',compact('datos','fechaInicio','fechaFin','tituloReporte'));
        $pdf->setPaper('A4','Portrait');
        return $pdf->stream($tituloReporte.'.pdf');
    }
     /*Fin Sección de Reporte de Preferencia de pago de los clientes. */

      /*Sección de Reporte de ventas realizadas en la tienda en linea agrupados por genero. */
    public function clientes_P5()
    {   //Registro en bitacora
        $comentario="Accedió a la pantalla de Reporte de ventas realizadas en la tienda en linea agrupados por genero.";
        $this->registrarEnBitacora(Auth::user()->id,$comentario);
        //fin
        return view('estrategico.clientes_P5');
    }

    public function ajaxRequestClientes_P5E(Request $request){
         //Registro en bitacora
         $comentario="Solicitó generar un Reporte de ventas realizadas en la tienda en linea agrupados por genero desde
         ".$_REQUEST['fechaInicio']." hasta ".$_REQUEST['fechaFin'].".";
         $this->registrarEnBitacora(Auth::user()->id,$comentario);
         //fin

        $sqlQuery="SELECT IFNULL((CASE
        WHEN u.sexo='M' THEN 'Masculino'
        WHEN u.sexo='F' THEN 'Femenino' END),'Total') as sexo,
        count(o.id) as cantidad,
        sum(p.total_cancelar) as ingresos
        FROM gerencial_usuario as u
        INNER JOIN gerencial_orden as o ON u.id=o.user_id
        INNER JOIN gerencial_pago as p ON o.id=p.orden_id
        WHERE DATE(p.fecha_pago) 
        BETWEEN '".$_REQUEST['fechaInicio']."' AND '".$_REQUEST['fechaFin']."'
        AND o.tipo_orden='EN LINEA'
        GROUP BY sexo WITH ROLLUP;";

        $usuarios = DB::select(DB::raw($sqlQuery));
        return response($usuarios);
    }

    // Función para generar PDF
    public function generarPDF_P5(Request $request){
        $this->validate($request,[
            'fechaInicio2'=>'required|date|before:today',
            'fechaFin2'=>'required|date|before:today|after:fechaInicio2'
              ]);
        $datos = json_decode($request->json);
        $fechaInicio = $request->fechaInicio2;
        $fechaFin = $request->fechaFin2;
        $tituloReporte = $request->tituloReporte;

         //registro en bitacora
        $comentario="Solicitó generar un Reporte en pdf de ventas realizadas en la tienda en linea agrupados por genero desde
        ".$fechaInicio." hasta ".$fechaFin.".";
        $this->registrarEnBitacora(Auth::user()->id,$comentario);
        //fin

        $pdf = PDF::loadView('estrategico.reportePDF_P5',compact('datos','fechaInicio','fechaFin','tituloReporte'));
        $pdf->setPaper('A4','Portrait');
        return $pdf->stream($tituloReporte.'.pdf');
    }
    /*Fin Sección de Reporte de ventas realizadas en la tienda en linea agrupados por genero. */
}
