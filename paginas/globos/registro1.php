<?php 

	include_once "../../css/log/c/conexion.php";
	$idsp=$_POST['modulo'];
	$usuario=$_POST['usuario'];
	$names=array_keys($_POST);
	$valores="";
	$actualizar=$cons->consultas("status=0","permisosusuarios_volar","idusu_puv=".$usuario." and idsp_puv in( select id_sp from subpermisos_volar where permiso_sp=".$_POST["modulo"].") ","update");
	foreach ($names as $name) {
		if($name!="modulo" && $name!="usuario" ){
			echo $name;
			$verificar=$cons->consultas("id_puv","permisosusuarios_volar","idusu_puv=".$usuario." and idsp_puv=".$_POST[$name]." and status=1","");
			if(sizeof($verificar)==0){
				$verificar1=$cons->consultas("id_puv","permisosusuarios_volar","idusu_puv=".$usuario." and idsp_puv=".$_POST[$name]." and status=0","");
				if(sizeof($verificar1)==0){
					$agregar=$cons->consultas("idusu_puv,idsp_puv","permisosusuarios_volar",$usuario.",".$_POST[$name],"insert");
				}else{
					$actualizar=$cons->consultas("status=1","permisosusuarios_volar","idusu_puv=".$usuario." and idsp_puv=".$_POST[$name]." and status=0","update");
				}
			}
			
		}
	}
?>