<?php 
include_once"../../css/log/c/conexion.php";
	if(!isset($_POST['id'])){
	$clasificacion=$_POST['clasificacion'];
	$nombre=$_POST['nombre'];
	$abrev=$_POST['abrev'];
	$registro=$cons->consultas("nombre_extra,abrev_extra,clasificacion_extra","extras_volar","'".$nombre."','".$abrev."','".$_POST['clasificacion']."'","insert");
	}else{
		$id=$_POST['id'];
		$registro=$cons->consultas("status=0","estado_volar","id_estado=".$id,"update");
	}

?>