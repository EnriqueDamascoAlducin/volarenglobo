<?php
	include_once "c/conexion.php";
	$usuario=$_POST["user"];
	$pass=md5($_POST["pass"]);
	$consulta=$cons->consultas("*","volar_usuarios","status=1 and (id_usu='".$usuario."' or usuario_usu='".$usuario."') and contrasena_usu='".$pass."'","");
	if(sizeof($consulta)>0){
		include_once '../../crud/fin_session.php';
		$_SESSION['nombre']=$consulta[0]->nombre_usu;
		$_SESSION['apellidop']=$consulta[0]->apellidop_usu;
		$_SESSION['nombre_completo']=$consulta[0]->nombre_usu. " ".$consulta[0]->apellidop_usu." ".$consulta[0]->apellidom_usu ;
		$_SESSION['apellido']=$consulta[0]->apellidop_usu." ".$consulta[0]->apellidom_usu;
		$_SESSION['correo']=$consulta[0]->correo_usu;
		$_SESSION['contrasena']=$consulta[0]->contrasena_usu;
		$_SESSION['id']=$consulta[0]->id_usu;
		$_SESSION['nivel']=$consulta[0]->apellidop_usu;
		echo "Bienvenido ". $consulta[0]->nombre_usu." ".$consulta[0]->apellidop_usu." ".$consulta[0]->apellidom_usu;
		//900 segundos de timepo ==15min
		$_SESSION['max-tiempo']=60*15;
		$_SESSION[ 'ULTIMA_ACTIVIDAD' ] = time();
	}else{
		echo "No existe el usuario. \nFavor de ingresa bien el usuario.";
	}
?>