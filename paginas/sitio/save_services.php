<?php 

	include_once "../../css/log/c/conexion.php";
	if(isset($_POST['nombres'])){
		$nombres = $_POST['nombres'];
		$valores = $_POST['valores'];
		$indice = 0;
		$venta=$cons->consultas("id_venta as id","ventas_volar","status = 1 order by register desc limit 1","");
		foreach ($nombres as $nombre) {
			$servicios = explode("_", $nombre);
			echo "insert into ventas_serv (idserv_vsv,idventa_vsv,cantidad_vsv) values " . $servicios[1] . ',' . $venta[0]->id . ',' . $valores[$indice];
			$sql = $cons->consultas("idserv_vsv,idventa_vsv,cantidad_vsv","ventasserv_volar",$servicios[1] . ',' . $venta[0]->id . ',' . $valores[$indice],"insert");
			$indice++;
		}
	}
	
?>