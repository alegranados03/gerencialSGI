<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\User;
use Excel;
use PDF;
use App\Exports\Export;
class TacticoController extends Controller
{
    /* metodo de reordenación de resultados de un sql */
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

    /* Sección de Reporte de Ingresos por venta por producto. */
    public function producto_P1()
    {   //Registro en bitacora
        $comentario="Accedió a la pantalla de Reporte de Ingresos por venta por producto.";
        $this->registrarEnBitacora(Auth::user()->id,$comentario);
        //fin
        return view('tactico.producto_P1');
    }

    public function ajaxRequestProducto_P1T(Request $request){
        //Registro en bitacora
        $comentario="Solicitó generar un Reporte de Ingresos por venta por producto desde
        ".$_REQUEST['fechaInicio']." hasta ".$_REQUEST['fechaFin'].".";
        $this->registrarEnBitacora(Auth::user()->id,$comentario);
        //fin

        $sqlQuery="SELECT IFNULL(r.nombre,'Total') as 'Nombre del producto', 
        sum(r.ventas)
        as 'Cantidad Vendida', sum(r.ingresos) as Ingresos FROM (

        SELECT nombre_producto as nombre, 0 as ventas, 0 as ingresos FROM 
        gerencial_producto
        UNION
        SELECT
        p.nombre_producto as nombre,
        sum(d.cantidad_producto) as ventas,
        sum(d.total_parcial) as ingresos
        FROM
        gerencial_producto as p 
        JOIN gerencial_detalle_orden as d on p.id=d.producto_id
        WHERE DATE(d.fecha_registro) 
        BETWEEN '".$_REQUEST['fechaInicio']."' AND '".$_REQUEST['fechaFin']."'


        GROUP BY p.nombre_producto WITH ROLLUP) AS r

        GROUP BY r.nombre ORDER BY Ingresos DESC;";

        $respuesta = DB::select(DB::raw($sqlQuery));
        $productos= $this->reordenar($respuesta);
        return response($productos);
    }

    public function generarPDF_P1(Request $request){
        $this->validate($request,[
            'fechaInicio2'=>'required|date|before:today',
            'fechaFin2'=>'required|date|after:fechaInicio2'
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
        $pdf = PDF::loadView('tactico.reportePDF_P1',compact('datos','fechaInicio','fechaFin','tituloReporte','pdf'));
        $pdf->setPaper('A4','Portrait');
        return $pdf->stream($tituloReporte.'.pdf');
    }

    /* Fin Sección de Reporte de Ingresos por venta por producto. */

    /* Sección de Reporte de ventas hechas en local por intervalos de monto. */
    public function producto_P2()
    {  //Registro en bitacora
        $comentario="Accedió a la pantalla de Reporte de ventas hechas en local por intervalos de monto.";
        $this->registrarEnBitacora(Auth::user()->id,$comentario);
        //fin
        return view('tactico.producto_P2');
    }

    public function ajaxRequestProducto_P2T(Request $request){
         //Registro en bitacora
         $comentario="Solicitó generar un Reporte de ventas hechas en local por intervalos de monto desde
         ".$_REQUEST['fechaInicio']." hasta ".$_REQUEST['fechaFin'].".";
         $this->registrarEnBitacora(Auth::user()->id,$comentario);
         //fin
        $intervalos=$this->generarIntervalos($_REQUEST["numeroIntervalos"],$_REQUEST["rangoEntreIntervalos"]);
        $inicio="SELECT (CASE (r.rango) ";
        $correlativos=$this->correlativos($intervalos);
        $inicio2=" END) as id,IFNULL(r.rango,'Total') as rango, sum(r.cantidad) as cantidad, sum(r.ingreso) as ingresos
        FROM ( ";
        $intervalos_vacios=$this->generarRangosACero($intervalos);
        $intermedio="
        SELECT sum(p.total_cancelar) as ingreso, count(*) as cantidad,
        (CASE ";
        $case=$this->generarRangosCase($intervalos);
        $fin=" END)
        as rango
        FROM gerencial_orden as o INNER JOIN gerencial_pago as p
        ON o.id=p.orden_id
        WHERE DATE(p.fecha_pago) 
        BETWEEN '".$_REQUEST['fechaInicio']."' AND '".$_REQUEST['fechaFin']."'
        AND o.tipo_orden='LOCAL'
        GROUP BY rango WITH ROLLUP) AS r
        GROUP BY rango ORDER BY id;";

        $sqlQuery=$inicio.$correlativos.$inicio2.$intervalos_vacios.$intermedio.$case.$fin;
        $ventas = DB::select(DB::raw($sqlQuery));
        return response($ventas);
    }

    public function generarPDF_P2(Request $request){
        $this->validate($request,[
            'fechaInicio2'=>'required|date|before:today',
            'fechaFin2'=>'required|date|after:fechaInicio2'
              ]);
        $datos = json_decode($request->json);
        $fechaInicio = $request->fechaInicio2;
        $fechaFin = $request->fechaFin2;
        $tituloReporte = $request->tituloReporte;
        //registro en bitacora
        $comentario="Solicitó generar un Reporte en pdf de ventas hechas en linea por intervalos de monto desde
        ".$fechaInicio." hasta ".$fechaFin.".";
        $this->registrarEnBitacora(Auth::user()->id,$comentario);
        //fin
        $pdf = PDF::loadView('tactico.reportePDF_P2',compact('datos','fechaInicio','fechaFin','tituloReporte','pdf'));
        $pdf->setPaper('A4','Portrait');
        return $pdf->stream($tituloReporte.'.pdf');
    }

        /*Fin Sección de Reporte de ventas hechas en local por intervalos de monto. */


        /* Sección de Reporte de ventas hechas en linea por intervalos de monto. */
    public function producto_P3()
    {   //Registro en bitacora
        $comentario="Accedió a la pantalla de Reporte de ventas hechas en linea por intervalos de monto.";
        $this->registrarEnBitacora(Auth::user()->id,$comentario);
        //fin
        return view('tactico.producto_P3');
    }

    public function ajaxRequestProducto_P3T(Request $request){
        //Registro en bitacora
        $comentario="Solicitó generar un Reporte de ventas hechas en linea por intervalos de monto desde
        ".$_REQUEST['fechaInicio']." hasta ".$_REQUEST['fechaFin'].".";
        $this->registrarEnBitacora(Auth::user()->id,$comentario);
        //fin
        $intervalos=$this->generarIntervalos($_REQUEST["numeroIntervalos"],$_REQUEST["rangoEntreIntervalos"]);


        $inicio="SELECT (CASE (r.rango) ";
        $correlativos=$this->correlativos($intervalos);
        $inicio2=" END) as id,IFNULL(r.rango,'Total') as rango, sum(r.cantidad) as cantidad, sum(r.ingreso) as ingresos
        FROM ( ";
        $intervalos_vacios=$this->generarRangosACero($intervalos);
        $intermedio="
        SELECT sum(p.total_cancelar) as ingreso, count(*) as cantidad,
        (CASE ";
       $case=$this->generarRangosCase($intervalos);
       $fin=" END)
        as rango
        FROM gerencial_orden as o INNER JOIN gerencial_pago as p
        ON o.id=p.orden_id
        WHERE DATE(p.fecha_pago) 
        BETWEEN '".$_REQUEST['fechaInicio']."' AND '".$_REQUEST['fechaFin']."'
        AND o.tipo_orden='EN LINEA'
        GROUP BY rango WITH ROLLUP) AS r
        GROUP BY rango ORDER BY id;";


        $sqlQuery=$inicio.$correlativos.$inicio2.$intervalos_vacios.$intermedio.$case.$fin;
        $ventas = DB::select(DB::raw($sqlQuery));
        return response($ventas);
    }

    public function generarPDF_P3(Request $request){
        $this->validate($request,[
            'fechaInicio2'=>'required|date|before:today',
            'fechaFin2'=>'required|date|after:fechaInicio2'
              ]);
        $datos = json_decode($request->json);
        $fechaInicio = $request->fechaInicio2;
        $fechaFin = $request->fechaFin2;
        $tituloReporte = $request->tituloReporte;

                 //registro en bitacora
                 $comentario="Solicitó generar un Reporte en pdf de ventas hechas en linea por intervalos de monto desde
                 ".$fechaInicio." hasta ".$fechaFin.".";
                 $this->registrarEnBitacora(Auth::user()->id,$comentario);
                 //fin
        $pdf = PDF::loadView('tactico.reportePDF_P3',compact('datos','fechaInicio','fechaFin','tituloReporte','pdf'));
        $pdf->setPaper('A4','Portrait');
        return $pdf->stream($tituloReporte.'.pdf');
    }
    /* Fin Sección de Reporte de ventas hechas en linea por intervalos de monto. */

    /* Sección de Reporte de ingresos de venta por intervalos de horas. */
    
    public function producto_P4()
    {  //Registro en bitacora
        $comentario="Accedió a la pantalla de Reporte de ingresos de venta por intervalos de horas.";
        $this->registrarEnBitacora(Auth::user()->id,$comentario);
        //fin
        return view('tactico.producto_P4');
    }

    public function ajaxRequestProducto_P4T(Request $request){
          //Registro en bitacora
          $comentario="Solicitó generar un Reporte de ingresos de venta por intervalos de horas desde
          ".$_REQUEST['fechaInicio']." hasta ".$_REQUEST['fechaFin'].".";
          $this->registrarEnBitacora(Auth::user()->id,$comentario);
          //fin
            //consulta especial, caso: todas las horas
            $especial="SELECT IFNULL(r1.hora,24) as hora,
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



        //parte general de la consulta con intervalos mayores a una hora
        $tabla="SUM(r2.ventas) as ventas,SUM(r2.monto) as monto
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


        //caso: intervalo de '$sizeIntervalo' horas de tamaño
        $sizeIntervalo=$_REQUEST["intervalos"];

        if($sizeIntervalo == 12){
            $cases="SELECT IFNULL(CASE
            WHEN (r2.hora>=0 and r2.hora<12) THEN 1
             WHEN (r2.hora>=12 and r2.hora<24) THEN 2
             END,3) as intervalo,
             IFNULL(CASE
             WHEN (r2.hora>=0 and r2.hora<12) THEN '0:00:00-11:59:59'
             WHEN (r2.hora>=12 and r2.hora<24) THEN '12:00:00-23:59:59'
             END,'Total') as rango,";

            $sqlQuery=$cases.$tabla;

        }elseif($sizeIntervalo == 8){
            $cases="SELECT IFNULL(CASE
            WHEN (r2.hora>=0 and r2.hora<8) THEN 1
             WHEN (r2.hora>=8 and r2.hora<16) THEN 2
             WHEN (r2.hora>=16 and r2.hora<24) THEN 3
             END,4) as intervalo,
             IFNULL(CASE
             WHEN (r2.hora>=0 and r2.hora<8) THEN '0:00:00-7:59:59'
             WHEN (r2.hora>=8 and r2.hora<16) THEN '8:00:00-17:59:59'
             WHEN (r2.hora>=16 and r2.hora<24) THEN '16:00:00-23:59:59'
             END,'Total') as rango,";
             $sqlQuery=$cases.$tabla;

        }elseif($sizeIntervalo == 4){
            $cases="SELECT IFNULL(CASE
            WHEN (r2.hora>=0 and r2.hora<4) THEN 1
             WHEN (r2.hora>=4 and r2.hora<8) THEN 2
             WHEN (r2.hora>=8 and r2.hora<12) THEN 3
             WHEN (r2.hora>=12 and r2.hora<16) THEN 4
             WHEN (r2.hora>=16 and r2.hora<20)THEN 5
             WHEN (r2.hora>=20 and r2.hora<24)THEN 6
             END,7) as intervalo,
             IFNULL(CASE
             WHEN (r2.hora>=0 and r2.hora<4) THEN '0:00:00-3:59:59'
             WHEN (r2.hora>=4 and r2.hora<8) THEN '4:00:00-7:59:59'
             WHEN (r2.hora>=8 and r2.hora<12) THEN '8:00:00-11:59:59'
             WHEN (r2.hora>=12 and r2.hora<16) THEN '12:00:00-15:59:59'
             WHEN (r2.hora>=16 and r2.hora<20)THEN '16:00:00-19:59:59'
             WHEN (r2.hora>=20 and r2.hora<24)THEN'20:00:00-23:59:59'
             END,'Total') as rango,";
             $sqlQuery=$cases.$tabla;

        }elseif($sizeIntervalo == 6){
            $cases="SELECT IFNULL(CASE
            WHEN (r2.hora>=0 and r2.hora<6) THEN 1
             WHEN (r2.hora>=6 and r2.hora<12) THEN 2
             WHEN (r2.hora>=12 and r2.hora<18) THEN 3
             WHEN (r2.hora>=18 and r2.hora<24) THEN 4
             END,5) as intervalo,
             IFNULL(CASE
             WHEN (r2.hora>=0 and r2.hora<6) THEN '0:00:00-5:59:59'
             WHEN (r2.hora>=6 and r2.hora<12) THEN '6:00:00-11:59:59'
             WHEN (r2.hora>=12 and r2.hora<18) THEN '12:00:00-17:59:59'
             WHEN (r2.hora>=18 and r2.hora<24) THEN '18:00:00-23:59:59'
             END,'Total') as rango,";
             $sqlQuery=$cases.$tabla;

        }elseif($sizeIntervalo == 3){
            $cases="SELECT IFNULL(CASE
            WHEN (r2.hora>=0 and r2.hora<3) THEN 1
             WHEN (r2.hora>=3 and r2.hora<6) THEN 2
             WHEN (r2.hora>=6 and r2.hora<9) THEN 3
             WHEN (r2.hora>=9 and r2.hora<12) THEN 4
             WHEN (r2.hora>=12 and r2.hora<15)THEN 5
         WHEN (r2.hora>=15 and r2.hora<18)THEN 6
         WHEN (r2.hora>=18 and r2.hora<21)THEN 7
         WHEN (r2.hora>=21 and r2.hora<24)THEN 8
             END,9) as intervalo,
             IFNULL(CASE
             WHEN (r2.hora>=0 and r2.hora<3) THEN '0:00:00-2:59:59'
             WHEN (r2.hora>=3 and r2.hora<6) THEN '3:00:00-5:59:59'
             WHEN (r2.hora>=6 and r2.hora<9) THEN '6:00:00-8:59:59'
             WHEN (r2.hora>=9 and r2.hora<12) THEN '9:00:00-11:59:59'
             WHEN (r2.hora>=12 and r2.hora<15)THEN '12:00:00-14:59:59'
             WHEN (r2.hora>=15 and r2.hora<18)THEN'15:00:00-17:59:59'
             WHEN (r2.hora>=18 and r2.hora<21)THEN'18:00:00-20:59:59'
             WHEN (r2.hora>=21 and r2.hora<24)THEN'21:00:00-23:59:59'
             END,'Total') as rango,";

             $sqlQuery=$cases.$tabla;

        }elseif($sizeIntervalo == 2){
            $cases="SELECT IFNULL(CASE
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
        END,'Total') as rango,";
        $sqlQuery=$cases.$tabla;
        }elseif($sizeIntervalo == 1){
            $sqlQuery=$especial;
        }

        $ventas = DB::select(DB::raw($sqlQuery));
        return response($ventas);
    }

    public function generarPDF_P4(Request $request){
        $this->validate($request,[
            'fechaInicio2'=>'required|date|before:today',
            'fechaFin2'=>'required|date|after:fechaInicio2'
              ]);
        $datos = json_decode($request->json);
        $fechaInicio = $request->fechaInicio2;
        $fechaFin = $request->fechaFin2;
        $tituloReporte = $request->tituloReporte;
        //registro en bitacora
        $comentario="Solicitó generar un Reporte en pdf de ingresos de venta por intervalos de horas desde
        ".$fechaInicio." hasta ".$fechaFin.".";
        $this->registrarEnBitacora(Auth::user()->id,$comentario);
        //fin
        $pdf = PDF::loadView('tactico.reportePDF_P4',compact('datos','fechaInicio','fechaFin','tituloReporte','pdf'));
        $pdf->setPaper('A4','Portrait');
        return $pdf->stream($tituloReporte.'.pdf');
    } 
    /* Fin Sección de Reporte de ingresos de venta por intervalos de horas. */

    /* Sección de Reporte de costos de adquisicion de materia prima. */
    public function materia_prima_P5()
    {  //Registro en bitacora
        $comentario="Accedió a la pantalla de Reporte de costos de adquisicion de materia prima.";
        $this->registrarEnBitacora(Auth::user()->id,$comentario);
        //fin
        return view('tactico.materia_prima_P5');
    }

    public function ajaxRequestMateria_Prima_P5T(Request $request){
         //Registro en bitacora
         $comentario="Solicitó generar un Reporte de costos de adquisicion de materia prima desde
         ".$_REQUEST['fechaInicio']." hasta ".$_REQUEST['fechaFin'].".";
         $this->registrarEnBitacora(Auth::user()->id,$comentario);
         //fin
        $sqlQuery="SELECT IFNULL(r.nombre,'Total') AS materia_prima, 
        sum(r.cantidad) AS cantidad_compras, 
        sum(r.costos) as costos FROM (
            SELECT nombre_materia as nombre, 0 as cantidad, 0 as costos 
            FROM gerencial_materia_prima
            UNION
            SELECT mp.nombre_materia as nombre, count(c.id) as cantidad, 
            sum(c.costo_compra) as costos
            FROM `gerencial_materia_prima` as mp
            INNER JOIN gerencial_compra as c ON mp.id=c.materia_prima_id
            WHERE DATE(c.fecha_compra) 
            BETWEEN '".$_REQUEST['fechaInicio']."' AND '".$_REQUEST['fechaFin']."'
            GROUP BY mp.nombre_materia WITH ROLLUP ) as r

            GROUP BY r.nombre ORDER BY costos DESC;";
        $materia_prima = DB::select(DB::raw($sqlQuery));

        $materia_prima= $this->reordenar($materia_prima);
        return response($materia_prima);
    }

    public function generarPDF_P5(Request $request){
        $this->validate($request,[
            'fechaInicio2'=>'required|date|before:today',
            'fechaFin2'=>'required|date|after:fechaInicio2'
              ]);
        $datos = json_decode($request->json);
        $fechaInicio = $request->fechaInicio2;
        $fechaFin = $request->fechaFin2;
        $tituloReporte = $request->tituloReporte;

          //registro en bitacora
          $comentario="Solicitó generar un Reporte en pdf de costos de adquisicion de materia prima desde
          ".$fechaInicio." hasta ".$fechaFin.".";
          $this->registrarEnBitacora(Auth::user()->id,$comentario);
          //fin

        $pdf = PDF::loadView('tactico.reportePDF_P5',compact('datos','fechaInicio','fechaFin','tituloReporte','pdf'));
        $pdf->setPaper('A4','Portrait');
        return $pdf->stream($tituloReporte.'.pdf');
    }
    /* Fin Sección de Reporte de costos de adquisicion de materia prima. */

    /* Sección de Reporte de personas que mas compran en la tienda en linea. */
    public function clientes_P6()
    { //Registro en bitacora
        $comentario="Accedió a la pantalla de Reporte de personas que mas compran en la tienda en linea.";
        $this->registrarEnBitacora(Auth::user()->id,$comentario);
        //fin
        return view('tactico.clientes_P6');
    }

    public function ajaxRequestClientes_P6T(Request $request){
                 //Registro en bitacora
                 $comentario="Solicitó generar un Reporte de personas que mas compran en la tienda en linea desde
                 ".$_REQUEST['fechaInicio']." hasta ".$_REQUEST['fechaFin'].".";
                 $this->registrarEnBitacora(Auth::user()->id,$comentario);
                 //fin
        $sqlQuery="SELECT IFNULL(r2.usuario,'Total') as usuario, 
        r2.cantidad as 'Cantidad de compras', r2.ingresos FROM (
            SELECT r.usuario as usuario, sum(r.cantidad) as cantidad, 
            sum(r.ingresos) as ingresos FROM(
            SELECT u.username as usuario, count(o.id) as cantidad,
             sum(p.total_cancelar) as ingresos
            FROM gerencial_usuario as u 
            INNER JOIN gerencial_orden as o ON u.id=o.user_id
            INNER JOIN gerencial_pago as p ON p.orden_id=o.id
            WHERE u.es_cliente=1 AND
            DATE(o.fecha_creacion) 
            BETWEEN '".$_REQUEST['fechaInicio']."' AND '".$_REQUEST['fechaFin']."'
            GROUP BY usuario ORDER BY ingresos DESC LIMIT ".floor($_REQUEST["top"])." ) as r


            GROUP BY usuario WITH ROLLUP ) as r2

            ORDER BY r2.ingresos DESC;
            ";

        $usuarios = DB::select(DB::raw($sqlQuery));
        if(sizeof($usuarios)>2){
            $usuarios=$this->reordenar($usuarios);
        }

        return response($usuarios);
    }

    public function generarPDF_P6(Request $request){
        $this->validate($request,[
            'fechaInicio2'=>'required|date|before:today',
            'fechaFin2'=>'required|date|after:fechaInicio2'
              ]);
        $datos = json_decode($request->json);
        $fechaInicio = $request->fechaInicio2;
        $fechaFin = $request->fechaFin2;
        $tituloReporte = $request->tituloReporte;

          //registro en bitacora
          $comentario="Solicitó generar un Reporte en pdf de personas que mas compran en la tienda en linea desde
          ".$fechaInicio." hasta ".$fechaFin.".";
          $this->registrarEnBitacora(Auth::user()->id,$comentario);
          //fin

        $pdf = PDF::loadView('tactico.reportePDF_P6',compact('datos','fechaInicio','fechaFin','tituloReporte','pdf'));
        $pdf->setPaper('A4','Portrait');
        return $pdf->stream($tituloReporte.'.pdf');
    }
    /* Fin Sección de Reporte de personas que mas compran en la tienda en linea. */
    
    /* Función para generar Excel */
    public function generarExcel(Request $request){
        $json= $request->jsonExcel;
        $headers= $request->keys;
        $titulo= $request->tituloExcel;
        $titulo=$titulo.'.xlsx';

        //registro en bitacora
        $comentario="Solicitó generar un archivo de nombre ".$titulo;
        $this->registrarEnBitacora(Auth::user()->id,$comentario);
        //fin
        return Excel::download(new Export(json_decode($json),explode(',',$headers),substr($request->tituloExcel,10,31))
        ,$titulo);
    }

        /* funciones para reportes 2 y 3 */

        /* Esta función genera los intervalos en un arreglo
        guardando cada par de números para asignarlos luego a los intervalos dentro de la consulta SQL
        en las funciones generarRangosACero y generarRangosCase, los tamaños de rango con más de 2
        decimales serán redondeados a números con 2 decimales.
        */
    public function generarIntervalos($cantidad,$rango): Array {
        $inicio=0.01;
        $rango=round($rango,2);
        $fin=$rango;

        $intervalos=array();

        for($i=0;$i<floor($cantidad)-1;$i++){
            $intervalos[]=[$inicio,$fin];
            $inicio+=$rango;
            $fin+=$rango;
            }
        $intervalos[]=[$inicio];
        return $intervalos;
    }
    
       /* Esta función genera los rangos de ingresos con un total de cero en las otras casillas con el fin
       de mantener todos los rangos posibles dentro de la consulta, incluso si no hay compras realizadas
       con montos dentro de esos rangos y los une a la consulta en los métodos principales que las invocan
        que son ajaxRequestProducto_P2T y ajaxRequestProducto_P3T.
       */
    public function generarRangosACero(Array $intervalos): String {

        $cadena='';

        for ($i=0;$i<sizeof($intervalos)-1;$i++){
            $cadena=$cadena."SELECT 0 as ingreso, 0 as cantidad,
             '$".$intervalos[$i][0]."-$".$this->concatDeCeros($intervalos[$i][1])." as rango UNION ";
                }

        $rangos_a_cero=$cadena."SELECT 0 as ingreso, 0 as cantidad,
         'MAYOR QUE $".$intervalos[sizeof($intervalos)-1][0]."'
         as rango UNION ";

        return $rangos_a_cero;
    }

        /* Esta función genera los rangos de ingresos para realizar el conteo de las compras realizadas
        solo el resultado, concatenado a la sentencia SQL en las funciones principales
         solo muestra aquellos intervalos que tienen una o más compras dentro de sí, se unen a la consultas
         dentro de las funciones ajaxRequestProducto_P2T y ajaxRequestProducto_P3T
       */
    public function generarRangosCase(Array $intervalos): String {
        $cadena='';
        for ($i=0;$i<sizeof($intervalos)-1;$i++){
        $cadena=$cadena." WHEN (p.total_cancelar BETWEEN ".$intervalos[$i][0]." AND ".$intervalos[$i][1].")
        THEN '$".$intervalos[$i][0]."-$".$this->concatDeCeros($intervalos[$i][1])."";
                }

        $rangos_case=$cadena." WHEN (p.total_cancelar > ".$intervalos[sizeof($intervalos)-1][0].")
        THEN 'MAYOR QUE $".$intervalos[sizeof($intervalos)-1][0]."'";
        return $rangos_case;
    }

        /* Genera un correlativo en los rangos para mantener el orden correcto en el resultado de la consulta 
        en ajaxRequestProducto_P2T y ajaxRequestProducto_P3T 
        */
    public function correlativos(Array $intervalos): String {

        $cadena='';
        for($i=0;$i<sizeof($intervalos)-1;$i++){
            $index=$i+1;
            $cadena=$cadena." WHEN '$".$intervalos[$i][0]."-$".
            $this->concatDeCeros($intervalos[$i][1])."
             THEN ".$index;
        }
        $index=$index+1;

        $cadena=$cadena." WHEN 'MAYOR QUE $".
        $intervalos[sizeof($intervalos)-1][0]."' THEN ".$index;
        $index=$index+1;
        $cadena=$cadena." ELSE ".$index;
        return $cadena;
    }

        /* Concatena ceros a cada extremo derecho de los intervalos, dependiendo de la cantidad de números 
        que tenga después del punto decimal 
        */

    public function concatDeCeros($numero): String{
        $arr=explode('.',$numero);
        $tamano=sizeof($arr);
     if ($tamano==2 && strlen($arr[1])<2) { return $numero."0'";}        
     else if($tamano==2){ return $numero."'";
            }else{
                return $numero.".00'";
            }
    }

        /* fin funciones para reportes 2 y 3 */


}
