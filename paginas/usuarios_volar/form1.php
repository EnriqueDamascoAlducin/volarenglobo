<?php
  
  include "../../crud/fin_session.php";
  include_once "../../css/log/c/conexion.php";
	$id=$_POST['id'];
  $permisos=$cons->consultas("*","permisos_volar","status=1","");
  $nombre=$cons->consultas("CONCAT(ifnull(nombre_usu,''),' ', ifnull(apellidop_usu,'') )as nombre","volar_usuarios","id_usu=".$id,"");
?>
<nav class="navbar navbar-light bg-info">
  <div class="pull-left" style="margin-left: 5%;margin-top: 1%"> 
    <label ><span class="glyphicon glyphicon-plus" style="color: #3F729B"></span>&nbsp;Cargar Permisos para <?php echo $nombre[0]->nombre ?></label>
  </div>
</nav>
<?php
  foreach ($permisos as $permiso) {
?>

<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2" data-toggle="modal" data-target="#modal-confirmacion" onclick="abrir_modal('Permisos para <?php echo utf8_encode( $permiso->nombre_per).'|'.$id; ?>',<?php echo $permiso->id_per ?>,'permisos.php');">        
  <img src="<?php echo $permiso->img_per ?>" style="max-width: 100%;width: 100%" class="img-circle" alt="<?php echo $permiso->nombre_per ?>">  
  <br>
  <small><?php echo utf8_encode( $permiso->nombre_per); ?></small>  
</div>

<?php } ?>

