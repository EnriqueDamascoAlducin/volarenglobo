<?php 

	include_once "../../css/log/c/conexion.php";
	$idsp=$_POST['modulo'];
	$usuario=$_POST['usuario'];
	$permiso=$_POST['permiso'];
	$valores="";

	$valid_permiso=$cons->consultas("id_puv,status","permisosusuarios_volar","idsp_puv=".$permiso." and idusu_puv=".$usuario,"");

	if(sizeof($valid_permiso)>0){
		if($valid_permiso[0]->status==0){
			$actualizar_permiso=$cons->consultas("status=1","permisosusuarios_volar","id_puv=".$valid_permiso[0]->id_puv,"update");
		}else{
			$actualizar_permiso=$cons->consultas("status=0","permisosusuarios_volar","id_puv=".$valid_permiso[0]->id_puv,"update");
		}
		
	}else{
		$insertar_permiso=$cons->consultas("idusu_puv,idsp_puv","permisosusuarios_volar",$usuario.",".$permiso,"");
	}
	
?>