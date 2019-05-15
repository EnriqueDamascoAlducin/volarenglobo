<?php
	session_start();
	include_once"../css/log/c/conexion.php";
	$tabla=$_SESSION['tabla'];
	$clave=$cons->consultas("show full columns",$tabla,"Comment='Llave Primaria'","");
	$clave= explode("_",$clave[0]->Field);
	$clave=$clave[1];
	
	if(!isset($_POST['status'])){
		$names=array_keys($_POST);
		$i=0;
		$campos="";
		if(!isset($_POST['id'])){
			/////////////////////Nombres de los campos
			foreach ($names as $name) {
				$campos.=$name."_".$clave.",";
			}
			$filtro="";
			foreach ($_POST as $val) { 
				if($val==""){
					$filtro.="null,";
				}else{
					$filtro.= "'".utf8_decode($val)."',";
				}
			}
			$campos=substr($campos,0,-1). "\n";
			$filtro=substr($filtro,0,-1);
			$tipo="insert";
		}else{
			foreach ($_POST as $val) {
				$name=$names[$i]."_".$clave;
					if ($name!='id') {
						if($val==""){
							$campos.=$name."=null,";
						}else{
							$campos.=$name."='".$val."',";
						}
						
					}
				$i++;
			}
			$campos=substr($campos, 0,-1);
			$filtro="id_".$clave."=".$_POST['id'];
			$tipo="update";
		}
	}else{
		$campos="status=".$_POST['status'];
		$filtro="id_".$clave."=".$_POST['id'];
		$tipo="update";

	}
	$cons->consultas($campos,$tabla,$filtro,$tipo);

	if(isset($_SESSION['extraquery']) && $_SESSION['extraquery']!=""){
		include_once $_SESSION['extraquery'];
	}
?>