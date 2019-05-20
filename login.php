<?php 
	session_start();
	if(isset($_SESSION['id'])){
		session_destroy();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/botones-device.css">
	<title>Iniciar Sesión</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body class="cuerpo">
<div class="limiter">
		<div class="container-login100" style="background-image: url('img/globos.png');">
			<div class="wrap-login100 p-t-30 p-b-50" >
				<span class="login100-form-title p-b-41" >
					Sistema de Administración de Volar en Globo
				</span>
				<form id="loginform"  class="login100-form validate-form p-b-33 p-t-5" style="background: transparent;"   onsubmit=" mandar_datos(event);">

					<div class="wrap-input100 validate-input" style="background: transparent ;" data-validate = "Ingresa tu Usuario">
						<input autocomplete="off" style="background: transparent ;color:white" class="input100" type="text" name="user" id="user" placeholder="Usuario" autofocus="">
						<span class="focus-input100" data-placeholder="&#xe82a;" ></span> 
					</div>
					<div class="wrap-input100 validate-input" data-validate="Ingresa tu Contraseña">
						<input autocomplete="off" style="background: transparent ;color:white" class="input100" type="password" name="pass" id="pass" placeholder="Contraseña">
						<span class="focus-input100" data-placeholder="&#xe80f;"></span>
					</div>

					<div class="container-login100-form-btn m-t-32">
						<button class="login100-form-btn" type="submit">
								Iniciar Sesión 
						</button>
					</div>

				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/login.js"></script>

	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

	<?php
		if(isset($_GET['s'])){
	?>
			<script type="text/javascript">
				alert("Fin de Sessión");
			</script>
	<?php
		}
	?>
</body>
</html>	
