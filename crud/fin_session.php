<?php
@session_start();
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