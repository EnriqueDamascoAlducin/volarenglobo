<?php 

	include_once "../../css/log/c/conexion.php";
	$consulta=$cons->consultas("nombre_cat","cat_servicios_volar","'".utf8_encode( $_POST['nombre'])."'","insert");
?>