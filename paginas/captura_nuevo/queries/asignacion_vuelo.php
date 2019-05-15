<?php 
	$correos=[];
	$datos=$cons->consultas("(select CONCAT(ifnull(nombre_usu,''),' ',ifnull(apellidop_usu,''),' ',ifnull(apellidom_usu,'') )  FROM volar_usuarios WHERE id_usu=piloto_temp ) as piloto, mail_temp as correo, CONCAT(ifnull(nombre_temp,''),' ',ifnull(apellidos_temp,'')) as cliente,id_temp, (select correo_usu from volar_usuarios where id_usu=idusu_temp) as correov, (select CONCAT(nombre_usu, ' ', ifnull(apellidop_usu,''),' ',ifnull(apellidom_usu,''))  from volar_usuarios where id_usu=idusu_temp) as vendedor,hora_temp as hora","temp_volar","id_temp=".$_POST['id'],"");
	foreach ($datos as $dato) {
		$correo=$dato->correo;
		$nombre=$dato->cliente;
		$correov=$dato->correov;
		$nombrev=$dato->vendedor;
		array_push($correos, array($correo,$nombre));
		array_push($correos, array($correov,$nombrev));
	}
	$asunto="Asignación de Vuelo";
	$titulo="Se ha asignado correctamente el piloto y el globo";
	$correo_envia=[$_SESSION['correo'],$_SESSION['nombre_completo']];
	include"../correos/asignacion_vuelo.php.";
?>