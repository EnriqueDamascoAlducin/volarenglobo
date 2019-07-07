<?php
echo "algo";
function get_salerinfo($id,$cons){
	$vendedor=$cons->consultas("CONCAT(ifnull(nombre_usu,''),' ',ifnull(apellidop_usu,''),' ',ifnull(apellidom_usu,'')) as nombre,correo_usu,telefono_usu","volar_usuarios","id_usu=".$id,"");
	$salename=$vendedor[0]->nombre;
	$salemail=$vendedor[0]->correo_usu;
	$salephone=$vendedor[0]->telefono_usu;
	$saleinfo=[$salename,$salemail,$salephone];
	return $saleinfo;
}
	if(!isset($cliente)){
		$cuerpo="<style>
		.td{
			background:#33b5e5;
			color:white;
			text-align:center;
		}
		</style>";
		$cuerpo.="<table border='2' style='width:100%;max-width:100%'>";
		$cuerpo.="<thead><tr><th style='background:#2BBBAD' colspan='2'><h3>".$titulo."</h3></th></tr></thead>";
		$cuerpo.="<tbody>";

		$cuerpo.="<tr>";
		$cuerpo.="<th class='td'>Pasajero:</th>";
		$cuerpo.="<td>".$pasajeros[0]->nombre."</td>";
		$cuerpo.="</tr>";

		$cuerpo.="<tr>";
		$cuerpo.="<th class='td'>Vuelo:</th>";
		$cuerpo.="<td>".$pasajeros[0]->vuelo."</td>";
		$cuerpo.="</tr>";

		$cuerpo.="<tr>";
		$cuerpo.="<th class='td'>Cantidad:</th>";
		$cuerpo.="<td>".$pasajeros[0]->cantidad."</td>";
		$cuerpo.="</tr>";

		$cuerpo.="<tr>";
		$cuerpo.="<th class='td'>Cuenta:</th>";
		$cuerpo.="<td>".$pasajeros[0]->banco."</td>";
		$cuerpo.="</tr>";

		$cuerpo.="<tr>";
		$cuerpo.="<th class='td'>Referencia:</th>";
		$cuerpo.="<td>".$pasajeros[0]->referencia."</td>";
		$cuerpo.="</tr>";
		if(isset($proceso)){
			$cuerpo.="<tr>";
			$cuerpo.="<th class='td'>Fecha de Conciliación:</th>";
			$cuerpo.="<td>".$pasajeros[0]->fecha."</td>";
			$cuerpo.="</tr>";
		}
		$cuerpo.="<tr>";
		$cuerpo.="<th class='td'>Fecha de Pago:</th>";
		$cuerpo.="<td>".$pasajeros[0]->fecha."</td>";
		$cuerpo.="</tr>";

		$cuerpo.="</tbody>";
		$cuerpo.="</table>";
	}else{
		$vendedor=get_salerinfo($pasajeros[0]->vendedor,$cons);
		$total=0;
		$signo="";
		$cuerpo="<style>
		.tdtitulo{
			background:#33b5e5;
			color:white;
			text-align:center;
		}
		.direccionvga{
				background:#aa66cc;
				width:100%;
				height:35px;
				color:white;

			}
		.direccionvga:hover{
			background:#9933CC;

		}
			
		</style>";
		$cuerpo .= '<img src="http://volarenglobo.com.mx/admin/imgs/bannersito.png" style="width:100%; 100%;" alt="Confirmación de Vuelo">';
		$cuerpo .= ' Hola!!! '.$pasajeros[0]->nombre.'. Te enviamos la confirmación de tu vuelo, no olvides tu confirmación de vuelo de forma digital. 
			<br>
			Registro y Pago: El día de tu vuelo deberás presentarte con nuestro anfitrión en la recepción para que registre tu asistencia y te reciba el pago del restante. Recuerda estar a tiempo en el lugar de la cita para no retrasar tu vuelo ni el de los demás. Te aconsejamos traer ropa cómoda, tal como si fueras a un día de campo: gorra, bufanda, guantes, bloqueador solar, cámara fotográfica o de video';

		$cuerpo.= ' <table style="width:100%;max-width:100%;">';
			$cuerpo.= ' <thead><tr><th class="tdtitulo" style="background:#0099CC" colspan="2">Datos del vuelo </th></tr></thead>';
			$cuerpo.= '<tbody>';
				$cuerpo .= ' <tr>';
					$cuerpo .= '<td class="tdtitulo">Referencia</td>';
					$cuerpo .= '<td > '.$pasajeros[0]->vuelo.'</td>';
				$cuerpo .= ' </tr>';
				$cuerpo .= ' <tr>';
					$cuerpo .= '<td class="tdtitulo">Nombre</td>';
					$cuerpo .= '<td > '.$pasajeros[0]->nombre.'</td>';
				$cuerpo .= ' </tr>';
				$cuerpo .= ' <tr>';
					$cuerpo .= '<td class="tdtitulo">Teléfono</td>';
					$cuerpo .= '<td > '.$pasajeros[0]->telefonos.'</td>';
				$cuerpo .= ' </tr>';
				$cuerpo .= ' <tr>';
					$cuerpo .= '<td class="tdtitulo">Fecha de Vuelo</td>';
					$cuerpo .= '<td > '.$pasajeros[0]->fechavuelo.'</td>';
				$cuerpo .= ' </tr>';
				$cuerpo .= ' <tr>';
					$cuerpo .= '<td class="tdtitulo">Tipo de Vuelo</td>';
					$cuerpo .= '<td > '.$pasajeros[0]->tipovuelo.'</td>';
				$cuerpo .= ' </tr>';
				$cuerpo .= ' <tr>';
					$cuerpo .= '<td class="tdtitulo">Adultos</td>';
					$cuerpo .= '<td > '.$pasajeros[0]->adultos.'</td>';
				$cuerpo .= ' </tr>';
				$cuerpo .= ' <tr>';
					$cuerpo .= '<td class="tdtitulo">Niños</td>';
					$cuerpo .= '<td > '.$pasajeros[0]->ninos.'</td>';
				$cuerpo .= ' </tr>';
				$cuerpo .= ' <tr>';
					$cuerpo .= '<td class="tdtitulo" colspan="2">Servicios</td>';
				$cuerpo .= ' </tr>';
				foreach ($servicios as $servicio) {
					$cuerpo .= ' <tr>';
						$cuerpo .= '<td class="tdtitulo">'.$servicio->nombre.'</td>';
						if($servicio->tipo_sv==1){
							$cuerpo .= '<td > ('.$servicio->cantidad.'*'.$servicio->precio.')'.($servicio->cantidad*$servicio->precio).'</td>';
							$total += ($servicio->cantidad*$servicio->precio);
						}else{
							$cuerpo .= '<td > Cortesia ('.$servicio->cantidad.')</td>';
						}

					$cuerpo .= ' </tr>';
				}
				$total=$pasajeros[0]->total;
				if(!is_null($principales[0]->tdescuento ) && $principales[0]->cantdescuento>0) {
					if($pasajeros[0]->tdescuento==1){
						$signo="$" . $pasajeros[0]->cantdescuento;
						$total= $pasajeros[0]->total - $pasajeros[0]->cantdescuento;
						$total=  "$ ".$total;
					}else{
						$signo=$pasajeros[0]->cantdescuento."%";
						$total=$pasajeros[0]->total -($pasajeros[0]->total * ($pasajeros[0]->cantdescuento / 100 ));
						$total = $total . " " . $signo;
					}
				}
				$cuerpo .= ' <tr>';
					$cuerpo .= '<td class="tdtitulo">Subtotal</td>';
					$cuerpo .= '<td > '.$total.'</td>';
				$cuerpo .= ' </tr>';
				///////////////
				if(!is_null($principales[0]->tdescuento ) && $principales[0]->cantdescuento>0) {
					$cuerpo .= ' <tr>';
						$cuerpo .= '<td class="tdtitulo">Descuentossss</td>';
						$cuerpo .= '<td > '.$signo.'</td>';
					$cuerpo .= ' </tr>';
				}
				////////////////

				$cuerpo .= ' <tr>';
					$cuerpo .= '<td class="tdtitulo">Total</td>';
					$cuerpo .= '<td > '.$pasajeros[0]->total.'</td>';
				$cuerpo .= ' </tr>';
				$cuerpo .= ' <tr>';
					$cuerpo .= '<td class="tdtitulo">Pago Actual</td>';
					$cuerpo .= '<td > '.$pasajeros[0]->cantidad.'</td>';
				$cuerpo .= ' </tr>';
				$cuerpo .= ' <tr>';
					$cuerpo .= '<td class="tdtitulo">Anticipo</td>';
					$cuerpo .= '<td > '.$pasajeros[0]->sumaactual.'</td>';
				$cuerpo .= ' </tr>';
				$cuerpo .= ' <tr>';
					$cuerpo .= '<td class="tdtitulo">Por Pagar</td>';
					$cuerpo .= '<td > '. ($pasajeros[0]->total - $pasajeros[0]->sumaactual).'</td>';
					if($datos[0]->hora!=""){
						$datos[0]->hora= " a partir de las <b>". $datos[0]->hora. "</b> horas";
					}
				$cuerpo .= ' </tr>';$cuerpo.='<td colspan="2">Los esperamos el día <b>'.$pasajeros[0]->fechavuelo.'</b> '. $datos[0]->hora.' en nuestra recepción, sin embargo esta hora sera <b><i>CONFIRMADA UN DIA ANTES</i></b> de acuerdo a la logística de operación del día o a las condiciones meteorológicas, te pido estés al tanto ya que recibirás una llamada para confirmar horario.</td>';
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
				<a href="https://www.google.com/maps/place//data=!4m2!3m1!1s0x85d1c03008c08e6d:0x2cd1a4cc8c3f3d5c?utm_source=mstt_1&utm_medium=mstt_2">
				<button type="button" id="direccionvga" class="direccionvga">Ver Dirección</button></a>
				<hr>
				Sin más por el momento quedo a sus órdenes para cualquier duda o aclaración respecto al servicio contratado.';
		$cuerpo.='</td>';
	$cuerpo.='</tr>';
	$cuerpo.='</tbody>
	</table>';	


		//$cuerpo.='<h4>Le agradecemos por su pago de '.$pasajeros[0]->cantidad.'. '.$titulo.'.</h4>';
		/*$vendedor=get_salerinfo(1,$cons);
		$cuerpo.='<h5>Para cualquier aclaración favor de ponerse en contacto con '.$vendedor[0].'</h5>';*/
		$cuerpo.='<p>Correo: '.$vendedor[1].'<br>Teléfono: '.$vendedor[2].'</p>';
	}
	include "../mails/mail.php";
?>
