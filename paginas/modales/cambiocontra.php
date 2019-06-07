
<?php
  include_once '../../crud/fin_session.php';
	include_once "../../css/log/c/conexion.php";
	

  $_SESSION['extraquery']="";
	$_SESSION['tabla']="volar_usuarios";
  $_SESSION['idpagina']=0;
	$id=$_POST['id'];
  $titulo=$_POST['titulo'];
	$datos="";
  if (isset($_POST['id'])) {
    $datos=$cons->consultas("usuario_usu","volar_usuarios","id_usu=".$id,"");
  }
	$size=[3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,1,1,1,1,1,1,1,1,1,1,3,3,3,3,3];
  $type=[13,1,3,3,3,3,3,3,3,3,3,3,13,3,3,3,1,1,1,1,1,1,1,1,1,1,0,4,4,12,2];
 	$options=["1","2","3","2"];
	$extraprop=["required","required","required","required","required","required","required","required","","","","","","","","","","","","","","","","","","","","","","","","","",""];
  $array=["contrasena_usu","usuario_usu"];
  $array2=["contrasena_usu"];
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
      			<input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
            <?php $cont=0; foreach ($campos as $campo) {
              if(in_array($campo->Field, $array)){
              campos($type[$cont],$campo->Comment,$campo->Field,$size[$cont],$options[$cont],$datos,$extraprop[$cont],$cons);
              $cont++;
              }
            } ?>


            <div class="col-sm-3 col-md-3 col-lg-3 col-xs-6" id="div_confirmarcontra">
                <div class="form-group">
                  <label for="confirmar_contrasena" >Confirmar Contraseña</label>
                  <input type="password" autocomplete="false" title="Confirmar Contraseña" required class="form-control" id="confirmar_contrasena" placeholder="Confirmar Contraseña" >
                </div>
            </div>

      		</form>
      		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary"  id="asignarcontras" onclick="save_extra(<?php echo "'".$_SESSION['modulo']."login.php'".",".$_SESSION['idpagina']; ?>,<?php echo "'".$_POST['titulo']."',".$id.",'cambiocontra.php'"; ?>)" disabled >Asignar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>

  <script type="text/javascript">
    $("input:password").on("keyup",function(){
      
      if(this.id=="contrasena"){
        if(this.value==$("#confirmar_contrasena").val()){
          $("#asignarcontras").prop("disabled",false);
          $("#confirmar_contrasena").css("border-color","black");
        }else{
          $("#asignarcontras").prop("disabled",true);
          $("#confirmar_contrasena").css("border-color","red");
        }
      }else if(this.id=="confirmar_contrasena"){

        if(this.value==$("#contrasena").val()){
          $("#confirmar_contrasena").css("border-color","black");
          $("#asignarcontras").prop("disabled",false);
        }else{
          $("#asignarcontras").prop("disabled",true);
          $("#confirmar_contrasena").css("border-color","red");
        }
      }
    });
  </script>