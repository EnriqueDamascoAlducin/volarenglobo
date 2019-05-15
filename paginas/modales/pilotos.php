
<?php
	include_once "../../css/log/c/conexion.php";
	session_start();
  $_SESSION['extraquery']="../paginas/captura_nuevo/queries/asignacion_vuelo.php";
  include "../../crud/fin_session.php";
	$_SESSION['tabla']="temp_volar";
	$id=$_POST['id'];
	$titulo=$_POST['titulo'];
  $pilotos=["CONCAT(ifnull(nombre_usu,''),' ',ifnull(apellidop_usu,''),' ',ifnull(apellidom_usu,'')) as text, id_usu as value ","volar_usuarios","status<>0 and puesto_usu=2"];
  $globos=["nombre_globo as text, id_globo as value","globos_volar","status<>0"];
	$datos="";
  $datos=$cons->consultas("piloto_temp,globo_temp,hora_temp,kg_temp","temp_volar","id_temp=".$id,"");
	$size=[3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,1,1,1,1,1,1,1,1,1,1,3,3,3,3,3];
  $type=[1,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,1,1,1,1,1,1,1,1,1,1,0,4,4,12,2];
 	$options=["1","2","3","2","","6","7","8","","10","","12","","","","","","","","","","","","","",$pilotos,$globos,$pilotos,$globos,"","","","",""];
	$extraprop=["required","required","required","required","required","required","required","required","","","","","","","","","","","","","","","","","","","","","","","","","",""];
 	$array=["piloto_temp","globo_temp","hora_temp","kg_temp"];
	include "../../dinamicos/inputs.php";
?>

<div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="titulo_modal"><?php echo $titulo; ?></h4>
      </div>
      <div class="modal-body cuerpo_modal" id="cuerpo_modal" style=''>
      		<form name="formularioext" id="formularioext" method="POST" style="margin-bottom: 10%">
      			<?php
      			echo "<input type='hidden' name='id' value='".$id."'>";
      			$cont=0; 
                foreach ($campos as $campo) {
                  if(in_array($campo->Field, $array)){
                    campos($type[$cont],$campo->Comment,$campo->Field,$size[$cont],$options[$cont],$datos,$extraprop[$cont],$cons);
                  }
                  $cont++;
                }

      			?>

      		</form>
      		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary"   onclick="save_extra(<?php echo "'".$_SESSION['modulo']."'".",".$_SESSION['idpagina']; ?>,<?php echo "'".$_POST['titulo']."',".$id.",'pilotos.php'"; ?>)" >Asignar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>