<?php


include_once "../../css/log/c/conexion.php";
if(isset($_POST['precioa']) || isset($_POST['campo'])){
		$tabla="vueloscat_volar";
	if(!isset($_POST['campo'])){
		$filtro="";
		if(isset($_POST['id'])){
			$campos="nombre_vc='".utf8_decode($_POST['nombre'])."', tipo_vc='".$_POST['tipo']."',precioa_vc='".$_POST['precioa']."',precion_vc='".$_POST['precion']."'";
			$filtro="id_vc=".$_POST['id'];
			$tipo="update";
		}else{
			$tipo="insert";
			$campos="nombre_vc,tipo_vc,precioa_vc,precion_vc";
			$filtro="'".utf8_decode($_POST['nombre'])."','".$_POST['tipo']."','".$_POST['precioa']."','".$_POST['precion']."'";
		}
	}
	else{
		$campos="status=0";
		$filtro="id_vc=".$_POST['id'];
		$tipo="update";
		$data=$cons->consultas("status=0","rel_catvuelos_volar","idvc_rel=".$_POST['id'],$tipo);
	}
}else{
		$tabla="rel_catvuelos_volar";
	if(!isset($_POST['status'])){
		$campos="idcat_rel,idvc_rel";
		$filtro=$_POST['cat'].",".$_POST['idvc'];
		$tipo="insert";
	}
	else{
		$campos="status=0";
		$filtro="idvc_rel=".$_POST['idvc']. " and idcat_rel=".$_POST['status'] ;
		$tipo="update";
	}
	
}
$data=$cons->consultas($campos,$tabla,$filtro,$tipo);
?>