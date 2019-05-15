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
		$cuerpo="<style>.td{background:#33b5e5;}</style>";
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
		$cuerpo='<h3>Estimado '.$pasajeros[0]->nombre.' </h3>';
		$cuerpo.='<h4>Le agradecemos por su pago de '.$pasajeros[0]->cantidad.'. '.$titulo.'.</h4>';
		$vendedor=get_salerinfo(1,$cons);
		$cuerpo.='<h5>Para cualquier aclaración favor de ponerse en contacto con '.$vendedor[0].'</h5>';
		$cuerpo.='<p>Correo: '.$vendedor[1].'<br>Teléfono: '.$vendedor[2].'</p>';
	}
	include "../mails/mail.php";
?>