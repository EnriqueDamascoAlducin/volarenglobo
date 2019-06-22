<?php 

	include_once "../../css/log/c/conexion.php";
	$nombres = $_POST['nombres'];
	$valores = $_POST['valores'];
	$indice = 0;
	$venta=$cons->consultas("id_venta as id","ventas_volar","status = 1 order by register desc limit 1");
	foreach ($nombres as $nombre) {
		$servicios = split("_",$nombre);
		$sql = $cons->consultas("idserv_vsv,idventa_vsv,cantidad_vsv","ventas_serv",$servicios[1] . ',' . $venta[0]->id . ',' . $valores[$indice]);
		$indice++;
	}
?>