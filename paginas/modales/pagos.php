<?php
  if(!isset($_SESSION['id'])){
    session_start();  
  }
	$id=$_POST['id'];
	$titulo=explode("|",$_POST['titulo']);
  $opcion=$titulo[1];
	include_once "../../css/log/c/conexion.php";
  include "../../crud/fin_session.php";
  $_SESSION['tabla']="bitpagos_volar";
  $_SESSION['extraquery']="";

?>
<div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="titulo_modal"><?php echo $titulo[0]; ?></h4>
      </div>
      <div class="modal-body " id="cuerpo_modal" >
      	<form name="formularioext" id="formularioext" method="POST" style="margin-bottom: 10%">
          <?php //2 es para conciliar 12 para agregar pagos 13 es para mostrar bitacora
            if($opcion==2 || $opcion==12 || $opcion==13){
              if($opcion==12){
                $_SESSION['extraquery']="../paginas/captura_nuevo/queries/solcitar_conciliacion.php";
              }
              $pagos=$cons->consultas("*",$_SESSION['tabla'],"status<>0 and idres_bp=".$id,"");
              if($opcion==13){
                $pagado=$cons->consultas("sum(cantidad_bp) as pagado","bitpagos_volar","(status=3 || status=1) and idres_bp=".$id,"");
                $deuda=$cons->consultas("total_temp","temp_volar","status<>0 and id_temp=".$id,"");
                echo '<table style="width:100%;max-width:100%">';
                  echo '<tr><th>Total</th><th>Pagado</th><th>Por Pagar</th></tr>';
                  echo '<tr><td style="background:#33b5e5">'.$deuda[0]->total_temp.'</td>';
                  echo'<td style="background:#33b5e5">'.$pagado[0]->pagado.'</td>';
                  echo '<td style="background:#33b5e5">'.($deuda[0]->total_temp-$pagado[0]->pagado).'</td>';
                  echo '</tr>';
                echo '</table>';
              }
              if($opcion==12){
                echo "<input type='hidden' value='".$_SESSION['id']."' name='idreg' id='idreg'>";
                echo "<input type='hidden' value='".$id."' name='idres' id='idres'>";
                /////////////->>>>Valores Generador de Campos
                
                ////tipos   ----> 1= input text; 2= input number; 3=select estatico; 4 = select dinamico; 5=textarea; 6=input file; 7= input date; 8=date-timelocal; 9=input email
                $size=[3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3];
                $type=[1,1,1,4,4,1,2,7,4,2,7,4,1,7,4,4];
                $banco=["id_extra as value,nombre_extra as text","extras_volar","status=1 and clasificacion_extra='cuentasvolar'"];
                $metodopago=["id_extra as value, nombre_extra as text","extras_volar","status=1 and clasificacion_extra='metodopago'"];
                $options=["1","2","3",$metodopago,$banco,"6","7","8","","10","","12","","",15];
                $extraprop=["required","required","required","required","required","required","required","required","","","","","","","","","",""];
                $datos="";
                $array=["id_bp","idres_bp","idreg_bp","register","status","idconc_bp","fechaconc_bp"];
                include "../../dinamicos/inputs.php";
                $cont=0; 
                foreach ($campos as $campo) {
                  if(!in_array($campo->Field, $array)){
                    campos($type[$cont],$campo->Comment,$campo->Field,$size[$cont],$options[$cont],$datos,$extraprop[$cont],$cons);
                  }
                  $cont++;
                }
              }
              echo "<table class='DataTable table display' >";
              ?>
              <thead>
                <tr>
                  <th>Método</th>
                  <th>Referencia</th>
                  <th>Cantidad</th>
                  <?php if ($opcion==13) { ?>
                  <th>Registrado por:</th> 
                  <th>Conciliado por:</th> 
                  <?php } ?>
                  <th>Status</th>
                  <?php if ($opcion!=13) { ?>
                  <th>Acciones</th>
                  <?php } ?>
                </tr>
              </thead>
              <?php
              foreach ($pagos as $pago) {
                $metodo=$cons->consultas("nombre_extra","extras_volar","id_extra=".$pago->metodo_bp,"");
                $met="Otro";
                if(sizeof($metodo)>0){
                  $met=$metodo[0]->nombre_extra;
                }
                echo "<tr>";
                echo"<td>".$met."</td>";
                echo"<td>".$pago->referencia_bp."</td>";
                echo"<td>".$pago->cantidad_bp."</td>";
                if ($opcion==13) { ?>
                  <td><?php 
                    $usuario=$cons->consultas("CONCAT(nombre_usu,' ',ifnull(apellidop_usu,''),' ',ifnull(apellidom_usu,'') ) as nombre","volar_usuarios","id_usu=".$pago->idreg_bp,"");
                    echo $usuario[0]->nombre;
                  ?></td> 
                  <td><?php
                    if($pago->idconc_bp!=NULL && $pago->idconc_bp !=""){
                      $usuario=$cons->consultas("CONCAT(nombre_usu,' ',ifnull(apellidop_usu,''),' ',ifnull(apellidom_usu,'') ) as nombre","volar_usuarios","id_usu=".$pago->idconc_bp,"");
                      echo $usuario[0]->nombre;
                    }else{
                      echo "Sin Conciliar";
                    }
                  ?></td> 
                <?php }
                if($pago->status==1){
                  $stat="Conciliado";
                  $class="primary";
                }else if($pago->status==2){
                  $stat="Esperando Conciliación";
                  $class="info";
                }else if($pago->status==3){
                  $stat="Confirmación Enviada";
                  $class="success";
                }else {
                  $stat="Status Desconocido";
                  $class="danger";
                }
                ?>
                <td>
                  <div class="progress" style="max-width: 100%">
                    <div class="progress-bar progress-bar-<?php echo $class; ?>" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%;max-width: 100%;">
                      <?php echo $stat; ?>
                    </div>
                  </div>
                </td>
                <?php
                if($pago->status==2 && $opcion==12){
                  echo  
                    "<td>
                      <span id='trash_".$pago->id_bp."' class='glyphicon glyphicon-trash' style='color:red' onclick='confirmar_icon(this.id,1)' >
                      </span>
                      <div  style='display:none'>
                          <span class='glyphicon glyphicon-ok-circle' data-dismiss='modal'  style='color:#00C851;font-size:16px' onclick=actualizar_status(0,".$pago->id_bp. ",'".$_SESSION['modulo']."',".$_SESSION['idpagina'].")></span>
                        <span class='glyphicon glyphicon-remove-circle' style='color:#ffbb33;font-size:16px' id='opc_".$pago->id_bp."' onclick='confirmar_icon(this.id,0)'></span>
                      </div>
                    </td>";
                }else if($pago->status==1 && $opcion==12) {

                  echo
                    "<td>
                      <span id='trash_".$pago->id_bp."' class='glyphicon glyphicon-envelope' style='color:#2BBBAD' onclick='confirmar_icon(this.id,1)' ></span>
                      <div  style='display:none'>
                        <span class='glyphicon glyphicon-ok-circle' data-dismiss='modal'  style='color:#00C851;font-size:16px' onclick=actualizar_status(3,".$pago->id_bp. ",'".$_SESSION['modulo']."',".$_SESSION['idpagina'].")></span>
                        <span class='glyphicon glyphicon-remove-circle' style='color:#ffbb33;font-size:16px' id='opc_".$pago->id_bp."' onclick='confirmar_icon(this.id,0)'></span>
                      </div>
                    </td>";
                }else if($pago->status==2 && $opcion==2) {
                  $_SESSION['extraquery']="../paginas/captura_nuevo/queries/extraquery.php";
                  echo
                    "<td>
                      <span id='trash_".$pago->id_bp."' class='glyphicon glyphicon-thumbs-up' style='color:#2BBBAD' onclick='confirmar_icon(this.id,1)' ></span>
                      <div  style='display:none'>
                        <span class='glyphicon glyphicon-ok-circle' data-dismiss='modal'  style='color:#00C851;font-size:16px' onclick=actualizar_status(1,".$pago->id_bp. ",'".$_SESSION['modulo']."',".$_SESSION['idpagina'].")></span>
                        <span class='glyphicon glyphicon-remove-circle' style='color:#ffbb33;font-size:16px' id='opc_".$pago->id_bp."' onclick='confirmar_icon(this.id,0)'></span>
                      </div>
                    </td>";
                }else if($opcion!=13){
                  echo"<td></td>";
                }
                echo "</tr>";
              }
              echo "</table>";
            }
            
          ?>
         
          
      	</form>
      </div>
      <div class="modal-footer">
            <?php if($opcion!=2 && $opcion!=13){ ?>
              <button type="button" class="btn btn-primary"   onclick="save_extra(<?php echo "'".$_SESSION['modulo']."'".",".$_SESSION['idpagina']; ?>,<?php echo "'".$_POST['titulo']."',".$id.",'pagos.php'"; ?>)" >Enviar</button>
            <?php } ?>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>