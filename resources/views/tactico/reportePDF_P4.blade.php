<!DOCTYPE html>
<html>
<head>
	<title>{{$tituloReporte}}</title>
</head>
<body>
	<div class="container">
		<h2 align="center">
			<img src="{{public_path('css/Free_Sample2_By_Wix.png')}}" width="10%" style="margin-top: 2%">
			@include('layouts.nombreEmpresa')
		</h2>
		<h3 align="center">Unidad de Ventas</h3>
		<div class="float-md-left" style="margin-left: 10%">
			<label>
				@php
					$hoy = getdate();
					print_r("Fecha de Generacion: ".$hoy['mday']."/".$hoy['mon']."/".$hoy['year']);
				@endphp
			</label>
			<label style="margin-left: 20%">
				Generado Por: {{Auth::user()->primer_nombre}} {{Auth::user()->primer_apellido}}
			</label>
		</div>
		<h3 align="center">{{$tituloReporte}}</h3>
		<div class="float-md-left" style="margin-left: 10%">
			<label>
				@php
					$date=date_create($fechaInicio);
					$aux= date_format($date,"d/m/Y");
				@endphp
				Desde: {{$aux}}
			</label>
			<label style="margin-left: 34%">
				@php
					$date=date_create($fechaFin);
					$aux= date_format($date,"d/m/Y");
				@endphp
				Hasta: {{$aux}}
			</label>
		</div>
		<br/>
		<table class="table table-responsive table-hovered" width="100%" border="1pt">
			<tr>
				<th>Rango</th>
				<th>Cantidad de Ventas</th>
				<th>Monto</th>
			</tr>
				@foreach($datos as $row)
					<tr>
						<td>{{$row->rango }}</td>
						<td>{{$row->ventas}}</td>
						<td>{{$row->monto}}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<script type="text/php">
	    if ( isset($pdf) ) {
	        $pdf->page_text(500, 800, "Pagina: {PAGE_NUM} de {PAGE_COUNT}", 'serif', 10, array(0,0,0));
	    }
	</script>
</body>
</html>