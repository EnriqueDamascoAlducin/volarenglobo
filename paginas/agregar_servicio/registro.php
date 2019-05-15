<?php 
include_once"../../css/log/c/conexion.php";
$servicio=$_POST['servicio'];
$imagen="../img/".$_POST['imagen'];
$precio=$_POST['precio'];
$cortesia=$_POST['cortesia'];


$campos="nombre_servicio,precio_servicio,img_servicio,cortesia_servicio";
$valores="'".$servicio."','".$precio."','".$imagen."',".$cortesia;
$registro=$cons->consultas($campos,"servicios_volar",$valores,"insert");
?>