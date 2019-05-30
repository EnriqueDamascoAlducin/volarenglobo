<?php
$correos=[];
if(!isset($_POST['status'])){ ////para crear nueva solicitud
	$id=$_POST['idres'];
	$pasajeros=$cons->consultas("CONCAT(ifnull(nombre_temp,''),' ',ifnull(apellidos_temp,'')) as nombre, id_temp as vuelo,cantidad_bp as cantidad, referencia_bp as referencia, ifnull(fecha_bp,'') as fecha, nombre_extra as banco,mail_temp as correo, idusu_temp as vendedor","temp_volar tv,bitpagos_volar bv, extras_volar ev","ev.id_extra=bv.banco_bp and  idres_bp=id_temp  and idres_bp=".$id. "  ORDER by bv.register desc limit 1" ,"");
}else if($_POST['status']==3){ //// Para Mnadar Confirmaci'on de Pago Al cliente
	$id=$_POST['id'];
	$cliente=0;
	$select="CONCAT(ifnull(nombre_temp,''),' ',ifnull(apellidos_temp,'')) as nombre, id_temp as vuelo,ifnull(cantidad_bp,'0') as cantidad, referencia_bp as referencia, ifnull(fecha_bp,'') as fecha, nombre_extra as banco,mail_temp as correo, idusu_temp as vendedor, CONCAT (ifnull(telfijo_temp,''), ' ', ifnull(telcelular_temp,'')) as telefonos, fechavuelo_temp as fechavuelo, nombre_vc as tipovuelo, (SELECT ifnull(sum(cantidad_bp),'0') FROM  bitpagos_volar pagos WHERE pagos.idres_bp=bv.idres_bp) as sumaactual , ifnull(pasajerosa_temp,'0') as adultos, ifnull(pasajerosn_temp,'0') as ninos,total_temp as total,tdescuento_temp as tdescuento, cantdescuento_temp as cantdescuento";
	$pasajeros=$cons->consultas($select,"temp_volar tv,bitpagos_volar bv, extras_volar ev, vueloscat_volar vv","ev.id_extra=bv.banco_bp and  idres_bp=id_temp and tipo_temp = id_vc  and id_bp=".$id. " and bv.status<>0" ,"");
	$servicios=$cons->consultas("nombre_servicio as nombre ,precio_servicio as precio ,tipo_sv,cantidad_sv as cantidad","servicios_vuelo_temp svp inner join servicios_volar sv on idservi_sv=id_servicio inner join temp_volar tv on idtemp_sv = id_temp","id_temp=".$pasajeros[0]->vuelo." and svp.status<>0 and cantidad_sv<>0","");
}	
	
if(!isset($_POST['status'])){
	$contadores=$cons->consultas("CONCAT( ifnull(nombre_usu,''),' ',ifnull(apellidop_usu,''),' ',ifnull(apellidom_usu,'') ) as nombre,correo_usu as correo ","volar_usuarios","status<>0 and puesto_usu=3","");
	foreach ($contadores as $contador) {
		$correo=$contador->correo;
		$nombre=$contador->nombre;
		array_push($correos, array($correo,$nombre));
	}
}else{
	$correos=[array($pasajeros[0]->correo,$pasajeros[0]->nombre)];

}
$correo_envia=[$_SESSION['correo'],$_SESSION['nombre_completo']];
if(!isset($_POST['status']) ){
	$asunto="Nueva Solicitud de Conciliación";
	$titulo="Solicitud de Conciliación para Reserva ".$pasajeros[0]->vuelo;
	
	
}else{
	$asunto="Confirmación de Pago";
	$titulo="Su id de Pago es: ".$id;
}

include"../correos/solicitud_conciliacion.php.";
echo ". Correo enviado";
?>