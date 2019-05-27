<?php
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
		$cuerpo="<style>
		.tdtitulo{
			background:#33b5e5;
			color:white;
			text-align:center;
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
						}else{
							$cuerpo .= '<td > Cortesia ('.$servicio->cantidad.')</td>';
						}

					$cuerpo .= ' </tr>';
				}
						
				$cuerpo .= ' <tr>';
					$cuerpo .= '<td class="tdtitulo">Vendedor</td>';
					$cuerpo .= '<td > '.$vendedor[0].'</td>';
				$cuerpo .= ' </tr>';
			$cuerpo .= '</tbody>';
		$cuerpo .= '</table>';


		//$cuerpo.='<h4>Le agradecemos por su pago de '.$pasajeros[0]->cantidad.'. '.$titulo.'.</h4>';
		/*$vendedor=get_salerinfo(1,$cons);
		$cuerpo.='<h5>Para cualquier aclaración favor de ponerse en contacto con '.$vendedor[0].'</h5>';*/
		$cuerpo.='<p>Correo: '.$vendedor[1].'<br>Teléfono: '.$vendedor[2].'</p>';
	}
	include "../mails/mail.php";
?>
