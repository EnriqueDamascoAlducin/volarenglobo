<?php
$correos=[];
if(!isset($_POST['status'])){ ////para crear nueva solicitud
	$id=$_POST['idres'];
	$pasajeros=$cons->consultas("CONCAT(ifnull(nombre_temp,''),' ',ifnull(apellidos_temp,'')) as nombre, id_temp as vuelo,cantidad_bp as cantidad, referencia_bp as referencia, ifnull(fecha_bp,'') as fecha, nombre_extra as banco,mail_temp as correo, idusu_temp as vendedor","temp_volar tv,bitpagos_volar bv, extras_volar ev","ev.id_extra=bv.banco_bp and  idres_bp=id_temp  and idres_bp=".$id. "  ORDER by bv.register desc limit 1" ,"");
}else if($_POST['status']==3){ //// Para Mnadar Confirmaci'on de Pago Al cliente
	$id=$_POST['id'];
	$cliente=0;
	$pasajeros=$cons->consultas("CONCAT(ifnull(nombre_temp,''),' ',ifnull(apellidos_temp,'')) as nombre, id_temp as vuelo,cantidad_bp as cantidad, referencia_bp as referencia, ifnull(fecha_bp,'') as fecha, nombre_extra as banco,mail_temp as correo, idusu_temp as vendedor","temp_volar tv,bitpagos_volar bv, extras_volar ev","ev.id_extra=bv.banco_bp and  idres_bp=id_temp  and id_bp=".$id. " " ,"");
}	
	$algo=$cons->consultas("*","volar_usuarios",'status<>0',"");
	
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
echo "correo enviar";
?>