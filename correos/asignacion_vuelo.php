<?php
$id=$_POST['id'];
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
			#direccionvga{
				background:#aa66cc;
				width:100%;
				height:35px;
				color:white;

			}
			#direccionvga:hover{
				background:#9933CC;

			}


			</style>

		</head>
		<body>';
		$cuerpo.='<h3>Estimado '.$datos[0]->cliente.' </h3>';
		$cuerpo.='<p>Envío de confirmación de vuelo. No olvides imprimir tu confirmación y llevarlo contigo el día de tu vuelo.</p>';
		$cuerpo.='El día de tu vuelo deberás presentarte con nuestro anfitrión en la recepción para que registre tu asistencia y te reciba el pago del restante. Recuerda estar a tiempo en el lugar de la cita para no retrasar tu vuelo ni el de los demás. Te aconsejamos traer ropa cómoda, tal como si fueras a un día de campo: gorra, bufanda, guantes, bloqueador solar, cámara fotográfica o de video.';

		$cuerpo.='<table class="tabla" style="max-width: 100%;width:100%; border-color: #673ab7 " border="3" id="tablareservacion" >
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
			</tr>';
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
				<td class="tdtotal">Sub Total</td>
				<td> $'.number_format($preciototal, 2, '.', ',') . '</td>
			</tr>';
		if(!is_null($principales[0]->tdescuento ) && $principales[0]->cantdescuento>0) {
		$cuerpo.='<tr>
					<td class="tddesc">Descuento</td>';
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
				<td class="tdtotal">Total</td>
				<td>$'. number_format($preciototal, 2, '.', ',') .'</td>
			</tr>';
	$cuerpo.='<tr>';
	$cuerpo.='<td colspan="2">Los esperamos el día <b>'.$fecha.'</b> partir de las <b>'.$datos[0]->hora.'</b> horas en nuestra recepción, sin embargo esta hora sera <b><i>CONFIRMADA UN DIA ANTES</i></b> de acuerdo a la logística de operación del día o a las condiciones meteorológicas, te pido estés al tanto ya que recibirás una llamada para confirmar horario.</td>';
	$cuerpo.='</tr>';
	$cuerpo.='<tr>';
		$cuerpo.='<td colspan="2" class="tdseparador">PUNTO DE REUNION:</td>';
	$cuerpo.='</tr>';
	$cuerpo.='<tr>';
		$cuerpo.='<td  colspan="2">Recepción Volar en Globo, Aventura y Publicidad SA de CV. Esquina Francisco Villa con Carretera Libre Mexico- Tulancingo (132) C.P. 55850.</td>';
	$cuerpo.='</tr>';
	$cuerpo.='<tr>';
		$cuerpo.='<td colspan="2">';
			$cuerpo.='<ol type="1">
<li>Que incluye tu vuelo:</li>
<ul>
<li>Tiempo de vuelo de 45 minutos aproximadamente.</li>
<li>Coffee Break.</li>
<li>Transporte local durante toda la actividad (Teotihuacan).</li>
<li>Seguro de Viajero.</li>
<li>Certificado personalizado.</li>
<li>Brindis tradicional con vino blanco espumoso durante o después del vuelo dependiendo del tipo de vuelo contratado.</li>
</ul>
<li>Restricciones:</li>
<ul>
<li>Niños menores a 4 años.</li>
<li>Si ha padecido del corazón.</li>
<li>Si tiene una cirugia reciente.</li>
<li>Lastimada de la columna.</li>
<li>Mujeres embarazadas.</li>
<li>No se puede abordar en estado de ebriedad.</li>
</ul>
<li>Restricciones para los vuelos:</li>
<ul>
<li>Cuando las condiciones climatológicas no lo permita (Vientos mayor a 20 Km.).</li>
<li>Lluvia.</li>
<li>Exceso de neblina.</li>
<li>En caso de alguna de estas causas se reprogramara el vuelo en acuerdo mutuo.</li>
</ul>
<li>Cambio de fecha de vuelo o cancelaciones:</li>
<ul>
<li>En caso de no poder asistir a la cita por circunstancias adversas e imprevistas, se debera cancelar y confirmar la cancelacion via telefonica con al menos 36 horas de anticipación para que se te haga una reprogramacion de tu vuelo sin cargo alguno, si la cancelación se hace dentro del periodo de las 36 a 12 horas previo a la realizacion del vuelo, se podra reprogramar el vuelo con un cargo adicional al precio total del 35% por gastos de administración y operación. Si no existe cancelacion y confirmacion de cancelacion o no se presentara el pasajero perderá el derecho a reembolso alguno.</li>
<li>En caso de que se requiera posponer un vuelo; es responsabilidad del pasajero reprogramar en un período no mayor a 12 meses de lo contrario se perderá el derecho al vuelo.</li>
<li>Recuerda estar a tiempo en el lugar de la cita para no perder tu vuelo.</li>
<li>El tiempo estimado de vuelo es hasta de una hora pero si las condiciones no lo permiten, la empresa lo deja a consideración del piloto. Así que no habrá reembolso alguno por vuelos con duración menor a una hora.</li>
</ul>
</ol>';
		$cuerpo.='</td>';
	$cuerpo.='</tr>';
	$cuerpo.='<tr><td colspan="2" class="tdseparador">Direccion y Como Llegar:</td></tr>';
	$cuerpo.='<tr>';
		$cuerpo.='<td colspan="2">';
			$cuerpo.='Tomar insurgentes hacia Pachuca numero de autopistá 132-D en cuanto llegues a las casetas tomar las del lado derecho mas con dirección a pirámides - Tulancingo, ( extremo derecho ), ahí pagaras una caseta de $75.00, INMEDIATAMENTE PEGARTE A LADO DERECHO Y SEGUIR LOS SEÑALAMIENTOS HACIA PIRAMIDES seguir sobre la autopista en el Km. 17 y pasandoÂ  la gasolinera tomar la desviación hacia pirámidesÂ y continuar hasta la desviación a Tulancingo continuas sobre esta carretera donde a tu mano izquierda vas a encontrar una Estación de Policía Federal, un poco más adelante encontraras una salida a mano izquierda antes del puente, debes girar a la izquierda nuevamente y allí encontraras nuestra recepción.
				<hr>
				<a href="https://www.google.com.mx/maps/place/VOLAR+EN+GLOBO/@19.694916,-98.823688,19z/data=!3m1!4b1!4m2!3m1!1s0x0000000000000000:0xff4f4587c24e2324">
				<button type="button" id="direccionvga">Ver Dirección</button></a>
				<hr>
				Sin más por el momento quedo a sus órdenes para cualquier duda o aclaración respecto al servicio contratado.';
		$cuerpo.='</td>';
	$cuerpo.='</tr>';
	$cuerpo.='</tbody>
	</table>';	


	$cuerpo.="<div class='col-sm-12 col-md-12 col-lg-12 ' style='background:blue-gradient; border-color:#01579b; border-width:10px;border-style:double;vertical-align:middle'>";
	$cuerpo.=" <div class='col-sm-1 col-md-1 col-lg-1' style='vertical-align:middle' >";
		//$cuerpo.="<img src='../img/loguito.png' style='height:200%;max-height:200%;'>";
	$cuerpo.="</div>";
	$cuerpo.=" <div class='col-sm-11 col-md-11 col-lg-11' >";
	$cuerpo.="<h3>Gracias por pensar en nosotros.</h3>";
		$cuerpo.="<p style='font-size:14px'>Para mas información por favor contactate con tu vendedor</p>";
		$cuerpo.="<p style='font-size:13px'><span class='glyphicon glyphicon-user'></span>".$empleado[0]->nombre."</p><p> <span class='glyphicon glyphicon-phone'></span>".$empleado[0]->telefono_usu."/<span class='glyphicon glyphicon-envelope'></span> ".$empleado[0]->correo_usu."</p>";

	$cuerpo.="</div>";
	$cuerpo.="</div>";
	
	$cuerpo.='</body></html>';
	include "../mails/mail.php";
?>