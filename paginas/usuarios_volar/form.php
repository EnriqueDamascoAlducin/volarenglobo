<?php 
	
	include "../../crud/fin_session.php";
	$_SESSION['tabla']="volar_usuarios";
	include_once "../../css/log/c/conexion.php";
	$_SESSION['extraquery']="";
	$datos="";
	if(isset($_POST['id'])){
		$datos=$cons->consultas("*",$_SESSION['tabla'],"id_usu=".$_POST['id'],"");
	}
	$size=[3,3,3,3,3,3,3,3];
	/*
		conexion a base de datos
		select * from tabla where ....
		ejecutar cada resultaod

	*/
	////tipos   ----> 1= input text; 2= input number; 3=select estatico; 4 = select dinamico; 5=textarea; 6=input file; 7= input date; 8=date-timelocal; 9=input email;10=input telefono
	$tipo=[1,1,1,4,3,9,10,1];
	$query=["(nombre_extra) as text, id_extra as value","extras_volar","status=1 and clasificacion_extra='deptousu'"];
	$valores=[''];
	$options=["","","",$query,$valores,"","",""];
	$req=["required","required","","required onchange='mostrar_puestos();'","required ","","required","required"];
	$cont=0;
	include "../../dinamicos/inputs.php";
	//$array=["id_usu","contrasena_usu","register","status"];
	$array=["nombre_usu","apellidop_usu","apellidom_usu","depto_usu","puesto_usu","correo_usu","telefono_usu","usuario_usu"];

?>
<form name="formulario" id="formulario" onsubmit="enviar_crud(event,'<?php echo $_SESSION['modulo'] ?>',<?php echo $_SESSION['idpagina'] ?>);">
	<?php 
	if(isset($_POST['id'])){
		echo "<input type='hidden' name='id' id='id' value='".$_POST['id']."'>";
	}
	?>
	<?php foreach ($campos as $campo) {
		if(in_array($campo->Field, $array)){
		campos($tipo[$cont],$campo->Comment,$campo->Field,$size[$cont],$options[$cont],$datos,$req[$cont],$cons);
		$cont++;
		}
	} ?>
	<?php if(!isset($_POST['bloqueado'])){ ?>
		<div id="div_botones" class="col-sm-12 col-xs-12 col-lg-12 col-md-12">
		<?php if(!isset($_POST['id'])){ ?>
			<button type="submit" class="btn btn-success">Guardar</button>
		<?php }else{ ?>
			<button type="submit" class="btn btn-primary">Actualizar</button>
		<?php } ?>
		</div>
	<?php } ?>
</form>
<script type="text/javascript">
	function mostrar_puestos(){

		depto=$("#depto").val();
		if(depto==""){
			abrir_alert("warning","Debe Seleccionar un departamento");
			$("#depto").focus();
			return false;
		}
		url='../css/log/c/query_json.php'; 
        parametros={var1:"nombre_puesto,id_puesto",var2:"puestos_volar",var3:"status=1 and depto_puesto="+depto};
      	$("#puesto").empty().append("<option value=''>Selecciona un Puesto </option>");
	    $.ajax({
	      data: parametros,
	      dataType:"json",
	      url:url,
	      type:"POST",
	      success: function(data){	
	        $.each( data, function( key, value ) {
			  text=value.nombre_puesto;
			  val=value.id_puesto;
			  attr="";
			  if(val==puesto){
			  	attr="selected";
			  }
			  $("#puesto").append("<option value='"+val+"' "+attr+">"+text+"</option>");
			});
	      },
	      error:function(){
	      	abrir_alert("danger","dsa");
	      }

	    }); 
	}
	puesto="";
	<?php if(isset($datos[0]->depto_usu)){ ?>
		puesto=<?php echo $datos[0]->puesto_usu ?>;
		mostrar_puestos();
	<?php } ?>
</script>