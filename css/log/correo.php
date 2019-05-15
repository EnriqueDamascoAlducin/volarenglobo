<?php
	$id=$_POST['id'];
	session_start();
	include_once "c/conexion.php";
	$principales=$cons->consultas("*","temp_volar","status<>0 and id_temp=".$id,"");
	$campos=$cons->consultas("show full columns","temp_volar","","");
	$servicios_suma=$cons->consultas("nombre_servicio,precio_servicio,tipo_sv,cantidad_sv","servicios_vuelo_temp svt ,servicios_volar sv","id_servicio=idservi_sv and cantidad_sv>0 and idtemp_sv=".$id,"");
	if($principales[0]->habitacion_temp!=NULL && $principales[0]->habitacion_temp!="" && $principales[0]->habitacion_temp !="0"){
		$direccion=" CONCAT ('Calle: ',ifnull(calle_hotel,'NA'),', No. int.',ifnull(noint_hotel,'NA'),', No. ext.',ifnull(noext_hotel,'NA'),', Colonia:', ifnull(colonia_hotel,'NA'),', Municipio:', ifnull(municipio_hotel,'NA'),', ' ,(SELECT nombre_extra from extras_volar where id_extra=estado_hotel),', CP:', ifnull(cp_hotel,'NA') ) as direccion";
		$habitaciones=$cons->consultas("nombre_habitacion as habitacion, precio_habitacion as precio, capacidad_habitacion as capacidad, descripcion_habitacion as descripcion,nombre_hotel as hotel,".$direccion,"hoteles_volar hv, habitaciones_volar h","idhotel_habitacion=id_hotel and id_habitacion=".$principales[0]->habitacion_temp,"");
	}
	$tipo_vuelo=$cons->consultas("*","vueloscat_volar","id_vc=".$principales[0]->tipo_temp,"");

	$precionino=$tipo_vuelo[0]->precion_vc;
	$precioadulto=$tipo_vuelo[0]->precioa_vc;
	$totalpn=$precionino*$principales[0]->pasajerosn_temp;
	$totalpa=$precioadulto*$principales[0]->pasajerosa_temp;
	$totalvoletos=$totalpa+$totalpn;
	$preciototal=$totalvoletos;
	$servicios=$cons->consultas("nombre_cat as nombre","cat_servicios_volar csv,rel_catvuelos_volar rcv"," rcv.status=1 and csv.status=1 and id_cat=idcat_rel and idvc_rel=".$principales[0]->tipo_temp,"");
	$empleado=$cons->consultas("CONCAT(ifnull(nombre_usu,''),' ',ifnull(apellidop_usu,''),' ',ifnull(apellidom_usu,'') )as nombre, telefono_usu,correo_usu","volar_usuarios","id_usu=".$principales[0]->idusu_temp,"");

if( $principales[0]->fechavuelo_temp=="0000-00-00" ||  $principales[0]->fechavuelo_temp==null){
	$fecha="No Asignada";
}else{
	$fecha= $principales[0]->fechavuelo_temp;
}

$correo_envia=[$_SESSION['correo'],$_SESSION['nombre_completo']];
$correos=[array($principales[0]->mail_temp,$principales[0]->nombre_temp." ".$principales[0]->apellidos_temp)];
$asunto="Cotización del Vuelo ".$id;

$cuerpo='<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../css/boot/bootstrap.min.css">
	<script type="text/javascript" src="../js/jquery.min.js"></script>
	<script type="text/javascript" src="../js/boot/bootstrap.min.js"></script>
	<style type="text/css">
	.tdtitulo{
		background: #7986cb ;
		text-align: center;
		vertical-align: middle;
		color: white;	
	}
	.tdseparador{
		background: #2BBBAD ;
		text-align: center;
		vertical-align: middle;
		color: white;	
	}
	.tdtotal{
		background: #9933CC ;
		text-align: center;
		vertical-align: middle;
		color: white;	
	}
	.tddesc{
		background: #c51162 ;
		text-align: center;
		vertical-align: middle;
		color: white;	
	}

	</style>

</head>
<body>
Estimado(a) '.$principales[0]->nombre_temp.' '.$principales[0]->apellidos_temp.'
La cotización de su viaje en globo es el siguiente:
<table class="tabla" style="max-width: 100%;width:100%; border-color: #673ab7 " border="3" id="tablareservacion" >
	<thead>
		<tr>
			<th colspan="2" style="text-align: center;">Reserva No.'. $principales[0]->id_temp .'</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td class="tdtitulo">Fecha de Vuelo</td>
			<td>'.$fecha.'</td>
		</tr>
		<tr>
			<td class="tdtitulo">Nombre</td>
			<td>'.( $principales[0]->nombre_temp." ".$principales[0]->apellidos_temp).'</td>
		</tr>
		<tr>
			<td class="tdtitulo">Correo</td>
			<td>'. (  $principales[0]->mail_temp). '</td>
		</tr>
		<tr>
			<td class="tdtitulo">Telefono Fijo - Telefono Celular</td>
			<td>'.$principales[0]->telfijo_temp.' - '.$principales[0]->telcelular_temp.'
		</tr>
		<tr>
			<td class="tdtitulo">Tipo de Vuelo</td>
			<td>'.( $tipo_vuelo[0]->nombre_vc) .'<br>Adultos($'.number_format($precioadulto, 2, ".", ",").')'. ', Niños ($'.number_format($precionino, 2, ".", ",").') 
			</td>
		</tr>
		<tr>
			<td class="tdtitulo">Pasajeros</td>
			<td> Adultos '.$principales[0]->pasajerosa_temp.' - Niños '. $principales[0]->pasajerosn_temp.'<br>($'.number_format($totalvoletos, 2, '.', ',').') </td>
		</tr>
';
if(!is_null($principales[0]->otroscar1_temp ) && $principales[0]->otroscar1_temp!='') {
	$cuerpo.='<tr>
				<td  class="tdtitulo"> Otros Cargos </td>
				<td>'.$principales[0]->otroscar1_temp .' ($'.number_format($principales[0]->precio1_temp, 2, '.', ','). ') </td>
			</tr>';
	$preciototal=$preciototal+$principales[0]->precio1_temp; 
} 
if(!is_null($principales[0]->otroscar2_temp ) && $principales[0]->otroscar2_temp!='') {
	$cuerpo.='<tr>
				<td  class="tdtitulo"> Otros Cargos </td>
				<td>'.$principales[0]->otroscar2_temp .' ($'.number_format($principales[0]->precio2_temp, 2, '.', ','). ') </td>
			</tr>';
	$preciototal=$preciototal+$principales[0]->precio2_temp; 
} 
/*$cuerpo.='<tr>
			<td class="tdtitulo">Servicios Solicitados</td>
			<td> $'.number_format($suma[0]->total, 2, '.', ','). '</td>
		</tr>';
		$preciototal=$preciototal+$suma[0]->total;*/ 


if(sizeof($servicios_suma)>0){
	$cuerpo.='<tr>
					<td class="tdseparador" colspan="2">Servicios Solicitados	</td>
			</tr>';
	
		foreach ($servicios_suma as $servicio_suma) {
			if($servicio_suma->tipo_sv==1){
			$cuerpo.= "<tr >";
				$cuerpo.= "<td class='tdtitulo'>".$servicio_suma->nombre_servicio."</td>";
				$cuerpo.= "<td>".$servicio_suma->precio_servicio."*".$servicio_suma->cantidad_sv."</td>";
			$cuerpo.= "</tr>";
			$preciototal=$preciototal+($servicio_suma->precio_servicio*$servicio_suma->cantidad_sv);
		}else{
			$cuerpo.= "<tr>";
				$cuerpo.= "<td class='tdtitulo'>".$servicio_suma->nombre_servicio."</td>";
				$cuerpo.= "<td>Cortesia * ".$servicio_suma->cantidad_sv."</td>";
			$cuerpo.= "</tr>";
		}
		}
	if (isset($habitaciones)){
		$cuerpo.='<tr>
					<td colspan="2"  class="tdseparador">Hospedaje</td>
				</tr>';
				foreach ($habitaciones as $habitacion) {
					$cuerpo.= "<tr>";
						$cuerpo.= "<td  class='tdtitulo'>Hotel</td>";
						$cuerpo.= "<td  >".$habitacion->hotel."</td>";
					$cuerpo.= "</tr>";
					$cuerpo.= "<tr>";
						$cuerpo.= "<td colspan='2' >".utf8_encode($habitacion->direccion)."</td>";
					$cuerpo.= "</tr>";
					$cuerpo.= "<tr>";
						$cuerpo.= "<td  class='tdtitulo'>Habitacion</td>";
						$cuerpo.= "<td  >".utf8_encode($habitacion->habitacion)."</td>";
					$cuerpo.= "</tr>";
					$cuerpo.= "<tr>";
						$cuerpo.= "<td  class='tdtitulo'>Capacidad</td>";
						$cuerpo.= "<td  >".$habitacion->capacidad."</td>";
					$cuerpo.= "</tr>";
					$cuerpo.= "<tr>";
						$cuerpo.= "<td  class='tdtitulo'>Descripción</td>";
						$cuerpo.= "<td  >". utf8_encode($habitacion->descripcion)."</td>";
					$cuerpo.= "</tr>";
					$cuerpo.= "<tr>";
						$cuerpo.= "<td  class='tdtitulo'>Precio/Noche</td>";
						$cuerpo.= "<td  >". $habitacion->precio."</td>";
					$cuerpo.= "</tr>";
					$cuerpo.= "<tr>";
						$cuerpo.= "<td  class='tdtitulo'>Estadia</td>";
						$inicio = new DateTime($principales[0]->checkin_temp);
						$final = new DateTime($principales[0]->checkout_temp);
						$diff = $inicio->diff($final);
						$cuerpo.= "<td  >".$diff->days." días (".$principales[0]->checkin_temp." a ".$principales[0]->checkout_temp.")->".$habitacion->precio*$diff->days."</td>";
						
						$preciototal=$preciototal+($habitacion->precio*$diff->days);
					$cuerpo.= "</tr>";
				}
	}
}		
$cuerpo.='<tr>
			<td class="tdtitulo">Sub Total</td>
			<td> $'.number_format($preciototal, 2, '.', ',') . '</td>
		</tr>';
if(!is_null($principales[0]->tdescuento_temp)) {
	$cuerpo.='<tr>
				<td class="tdtitulo">Descuento</td>';
	if  ($principales[0]->tdescuento_temp==1){
		$cuerpo.='<td>'.$principales[0]->cantdescuento_temp.'% </td>';
		$pesosdesc=$preciototal*($principales[0]->cantdescuento_temp/100);
		$preciototal=$preciototal-$pesosdesc;
	}else{
		$cuerpo.='<td> $'.number_format($principales[0]->cantdescuento_temp, 2, '.', ',').'</td>';
		$preciototal=$preciototal- $principales[0]->cantdescuento_temp;
	}

	$cuerpo.='</tr>';
}
$cuerpo.='<tr>
			<td class="tdtitulo">Total</td>
			<td>$'. number_format($preciototal, 2, '.', ',') .'</td>
		</tr>';
/*		<tr>
			<td class="tdtitulo" colspan="2">Servicios Incluidos	</td>
		</tr>' ;
foreach ($servicios as $servicio) { 
	$cuerpo.='<tr>
		<td colspan="2">'.$servicio->nombre.'</td>
	</tr>';
}
*/
$cuerpo.='</tbody>
</table>';		
$cuerpo.="<div class='col-sm-12 col-md-12 col-lg-12 ' style='background:blue-gradient; border-color:#01579b; border-width:10px;border-style:double;vertical-align:middle'>";
$cuerpo.=" <div class='col-sm-1 col-md-1 col-lg-1' style='vertical-align:middlw' >";
	$cuerpo.="<img src='../img/loguito.png' style='height:200%;max-height:200%;'>";
$cuerpo.="</div>";
$cuerpo.=" <div class='col-sm-11 col-md-11 col-lg-11' >";
$cuerpo.="<h3>Gracias por pensar en nosotros.</h3>";
	$cuerpo.="<p style='font-size:14px'>Para mas información por favor contactate con tu vendedor</p>";
	$cuerpo.="<p style='font-size:13px'><span class='glyphicon glyphicon-user'></span>".$empleado[0]->nombre."</p><p> <span class='glyphicon glyphicon-phone'></span>".$empleado[0]->telefono_usu."/<span class='glyphicon glyphicon-envelope'></span> ".$empleado[0]->correo_usu."</p>";

$cuerpo.="</div>";
$cuerpo.="</div>";
$cuerpo.='</body></html>';
include_once "../../mails/mail.php";

$setter=$cons->consultas("id_bp","bitpagos_volar","idres_bp=".$id,"");
if(sizeof($setter)==0){

$actualizacion=$cons->consultas("status=3,total_temp='".$preciototal."'","temp_volar","id_temp=".$id,"update");	
}else{
	$actualizacion=$cons->consultas("total_temp='".$preciototal."'","temp_volar","id_temp=".$id,"update");
}
?>
