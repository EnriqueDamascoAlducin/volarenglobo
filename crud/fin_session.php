<?php
$status = session_status();
if($status == PHP_SESSION_NONE){
    //There is no active session
    session_start();
}else
if($status == PHP_SESSION_DISABLED){
    //Sessions are not available
    
    session_start();
}else
if($status == PHP_SESSION_ACTIVE){
    //Destroy current and start new one
    //session_destroy();
}
if ( isset( $_SESSION[ 'ULTIMA_ACTIVIDAD' ] ) && 
( time() - $_SESSION[ 'ULTIMA_ACTIVIDAD' ] > $_SESSION['max-tiempo'] ) ) {

// Si ha pasado el tiempo sobre el limite destruye la session
?>
	<script type="text/javascript">
		window.location.replace("../login.php?s=0");
	</script>
<?php
}
$_SESSION[ 'ULTIMA_ACTIVIDAD' ] = time();

?>