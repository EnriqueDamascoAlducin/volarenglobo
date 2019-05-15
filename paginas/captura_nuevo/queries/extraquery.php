<?php 
	$correos=[];
	$query=$cons->consultas("idconc_bp=".$_SESSION['id'].",fechaconc_bp=CURRENT_TIMESTAMP","bitpagos_volar","id_bp=".$_POST['id'],"update");
	$update_status=$cons->consultas("*","bitpagos_volar","id_bp=".$_POST['id'],"");
	$query=$cons->consultas("status=4","temp_volar","id_temp=".$update_status[0]->idres_bp,"update");
	$pasajeros=$cons->consultas("CONCAT(ifnull(nombre_temp,''),' ',ifnull(apellidos_temp,'')) as nombre, id_temp as vuelo,cantidad_bp as cantidad, referencia_bp as referencia, fecha_bp as fecha, nombre_extra as banco","temp_volar tv,bitpagos_volar bv, extras_volar ev","ev.id_extra=bv.banco_bp and  idres_bp=id_temp and id_temp=".$update_status[0]->idres_bp." and id_bp=".$_POST['id'],"");
	$datos_solicitante=$cons->consultas("CONCAT( ifnull(nombre_usu,''),' ',ifnull(apellidop_usu,''),' ',ifnull(apellidom_usu,'') ) as nombre,correo_usu as correo ","volar_usuarios","status<>0 and id_usu=".$update_status[0]->idreg_bp,"");
	//$actual_usuario=$cons->consultas("CONCAT( ifnull(nombre_usu,''),' ',ifnull(apellidop_usu,''),' ',ifnull(apellidom_usu,'') ) as nombre,correo_usu as correo ","volar_usuarios","status<>0 and id_usu=".$_SESSION['id'],"");
	foreach ($datos_solicitante as $solicitante) {
		$correo=$solicitante->correo;
		$nombre=$solicitante->nombre;
		array_push($correos, array($correo,$nombre));
	}
	$proceso=0;
	$asunto="Solicitud de Conciliación Atendida";
	$titulo="Solicitud de Conciliación Atendida por ".$_SESSION['nombre_completo'];
	$correo_envia=[$_SESSION['correo'],$_SESSION['nombre_completo']];
	include"../correos/solicitud_conciliacion.php.";
?>