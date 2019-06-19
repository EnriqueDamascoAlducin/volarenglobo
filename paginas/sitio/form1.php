<?php 
  
  include "../../crud/fin_session.php";
  $_SESSION['tabla']="ventas_volar";
  include_once "../../css/log/c/conexion.php";
  $datos="";
  if(isset($_POST['id'])){
    $datos=$cons->consultas("*",$_SESSION['tabla'],"id_venta=".$_POST['id'],"");
  } 
  ////tipos   ----> 1= input text; 2= input number; 3=select estatico; 4 = select dinamico; 5=textarea; 6=input file; 7= input date; 8=date-timelocal; 9=input email;10=input telefono
  $query=["(nombre_extra) as text, id_extra as value","extras_volar","status=1 and clasificacion_extra='deptousu'"];
  $valores=[''];
  
  $servicios=$cons->consultas("*","servicios_volar","status=1","");
  $cont=0;
  include "../../dinamicos/inputs.php";
  $array=["comentario_venta","otroscargos_venta","precio_venta"];
  $array2=["cantdesc_venta","pagoefectivo_venta","pagotarjeta_venta"];
  $size=[1,12,3,3,3,3,3,3,3,3,3,3,1,4];
  $type=[5,5,1,2,1,2,2,2,2,10,10,9,6,1];
  $gastos=["id_extra as value, nombre_extra as text","extras_volar","clasificacion_extra='tipogastos' and status=1"];
  $options=["","",$gastos,"","","","","","","","","","",""];
  $req=["required","required","required","","","required","","","","","","","",""];
?>

<div class="row">
<?php foreach ($servicios as $servicio) { ?>

  <div class="col-sm-2 col-md-2 col-lg-1 col-xs-6" style="border-style: groove; border-width: 5px;height: 160px;max-height: 160px;">
        <div class="pull-left" style="border-style: groove;border-width: 3px;max-height: 100%;height: 100%;width:98%;max-width:98%; ">
          <label for="precio_<?php echo $servicio->id_servicio ?>"  style="width:100%;max-width:100%;margin:0;height: 40%;max-height: 40%;color:black">
            <img src="<?php echo $servicio->img_servicio ?>" title="<?php echo $servicio->nombre_servicio.'('.$servicio->precio_servicio.')' ?>" alt="<?php echo $servicio->nombre_servicio ?>" style="margin:0;height: 100%;max-height: 100%;width: 90%;max-width: 90%;"> 
            <small class="text-warning"><?php echo substr($servicio->nombre_servicio, 0,8) .'<br>('.$servicio->precio_servicio.')' ?></small>
          </label>
           
          <input type="number" style="width: 100%;" name="precio_<?php echo $servicio->id_servicio ?>" id="precio_<?php echo $servicio->id_servicio ?>" value="<?php if(isset($res->cantidad_sv)){ echo $res->cantidad_sv;}else {echo 0;} ?>"> 
        </div>
      
  </div>

<?php } ?>
</div>

<form name="formulario" id="formulario" onsubmit="enviar_crud(event,'<?php echo $_SESSION['modulo'] ?>',<?php echo $_SESSION['idpagina'] ?>);">
  <?php 
  if(isset($_POST['id'])){
    echo "<input type='hidden' name='id' id='id' value='".$_POST['id']."'>";
  }
  ?>
  <?php foreach ($campos as $campo) {
    if(in_array($campo->Field, $array)){
    campos($type[$cont],$campo->Comment,$campo->Field,$size[$cont],$options[$cont],$datos,$req[$cont],$cons);
    }
    $cont++;
  } ?>
  <?php $tamano=3;
   $campo="metodo";
   $color="black";
   $comentario="Tipo de descuento: "; ?>





  <div class="col-sm-<?php echo $tamano; ?> col-md-<?php echo $tamano; ?> col-lg-<?php echo $tamano; ?> col-xs-6" id="div_<?php echo $campo; ?>">
      <div class="form-group">
        <label for="<?php echo $campo; ?>" <?php echo $color; ?>><?php echo utf8_encode($comentario); ?></label>
        <select class="form-control" id="<?php echo $campo; ?>" name="<?php echo $campo; ?>">
          <option value=""><?php echo "Selecciona un ". utf8_encode($comentario); ?></option>
          <option value="1">Pesos</option>
          <option value="2">Porcentaje</option>
        </select>
      </div>
    </div>
    <?php $cont=0; foreach ($campos as $campo) {
    if(in_array($campo->Field, $array2)){
    campos($type[$cont],$campo->Comment,$campo->Field,$size[$cont],$options[$cont],$datos,$req[$cont],$cons);
    }
    $cont++;
  } ?>

    <div id="div_botones" class="col-sm-12 col-xs-12 col-lg-12 col-md-12">
    <?php if(!isset($_POST['id'])){ ?>
      <button type="button" onclick="enviarVenta();" class="btn btn-success">Guardar</button>
    <?php }else{ ?>
      <button type="submit" class="btn btn-primary">Actualizar</button>
    <?php } ?>
    </div>
</form>

<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12" id="<?php echo 'div_'.$idtemp;?>" style="background: #3674B2;color:white">
  Servicios 
</div>
<script type="text/javascript">
  function enviarVenta(){
      servicios = $("input[name^='precio_']");
      servicesName = [];
      servicesValue = [];
      $.each(servicios,function(index){
        if(servicios[index].value>0){
          servicesName.push(servicios[index].id);
          servicesValue.push(servicios[index].value);
        }
      });
      alert(servicesName.length);
  }
</script>