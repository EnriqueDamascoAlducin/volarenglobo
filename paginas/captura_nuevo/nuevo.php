<style type="text/css">
	#desglozado{
		position: fixed;
		bottom: -40%;
		height:45%;
		left: 0;
		max-height:45%;
		width: 50%;
		max-width: 50%;
		background: #3F729B;
		margin-left:23%;
		margin-right:  23%;
		border-top-right-radius:  20px;
		border-top-left-radius: 20px;
		color:white;
		z-index: 1;
		text-align: center;
	}
	#desglozado div{
		margin-top: 5px;
		margin-bottom: 5px;
		height: 85%;
		max-height: 85%;
		overflow-y: auto;
		width: 33%;
		max-width: 33%;
		float: left;
		border:1px solid;
		background: red;
	}
	#desglozado:hover{
		bottom: 0;
	}
</style>
<?php
session_start();
include_once "../../css/log/c/conexion.php";
include "../../crud/fin_session.php";
$idusu=$_SESSION['id'];
$_SESSION['tabla']="temp_volar";
$datos="";
$servicios=$cons->consultas("*","servicios_volar","status=1","");
if(!isset($_POST['id'])){
	$idtemp=$cons->consultas("iFNULL(max(id_temp),0) as id_temp","temp_volar","","");
	$idtemp=$idtemp[0]->id_temp+1;
	echo "<div style='display:none'>";
		$cons->consultas("idusu_temp","temp_volar",$idusu,"insert");
		foreach ($servicios as $servicio) {
			//Para agregar servicio con precio
			$cons->consultas("idtemp_sv,idservi_sv,tipo_sv,cantidad_sv","servicios_vuelo_temp",$idtemp.",".$servicio->id_servicio.",1,0","insert");
			//agregar servico de cortesia (tipo=2)
			$cons->consultas("idtemp_sv,idservi_sv,tipo_sv,cantidad_sv","servicios_vuelo_temp",$idtemp.",".$servicio->id_servicio.",2,0","insert");
		}
	echo	"</div>";
}else{
	$idtemp=$_POST['id'];
	$datos=$cons->consultas("*","temp_volar","status<>0 and id_temp=".$idtemp,"");
}

/// valores para select dinamicos

$procedencia=["nombre_extra as text,id_extra as value","extras_volar","status=1 and clasificacion_extra='estados'"];
$tarifas=["nombre_extra as text,id_extra as value","extras_volar","status=1 and clasificacion_extra='tarifas'"];
$motivo=["nombre_extra as text,id_extra as value","extras_volar","status=1 and clasificacion_extra='motivos'"];
///

/////////////->>>>Valores Generador de Campos
////tipos   ----> 1= input text; 2= input number; 3=select estatico; 4 = select dinamico; 5=textarea; 6=input file; 7= input date; 8=date-timelocal; 9=input email
include "../../dinamicos/inputs.php";
///<<<<-------------
$tipos=$cons->consultas("nombre_extra,abrev_extra,id_extra","extras_volar","status=1 and clasificacion_extra='tiposv'","");
$hoteles=["nombre_hotel as text, id_hotel as value","hoteles_volar","status=1"];
$con=$cons->getconect();
$stmt=$con->prepare("select * from vueloscat_volar where status=1 and tipo_vc= :tipo");
$array=["nombre_temp","apellidos_temp","mail_temp","telfijo_temp","telcelular_temp","procedencia_temp","pasajerosa_temp","pasajerosn_temp","motivo_temp"];
$array2=["fechavuelo_temp","tarifa_temp"];
$array3=["comentario_temp","otroscar1_temp","precio1_temp","otroscar2_temp","precio2_temp"];
$array4=["hotel_temp","habitacion_temp","checkin_temp","checkout_temp"];
$type=[1,1,1,1,1,9,2,2,4,2,2,4,1,7,4,4,3,7,7,5,1,2,1,2];
$options=["1","2","3","4","5","6","7","8",$procedencia,"10","",$motivo,"","",$tarifas,$hoteles,array(),"","","","","","",""];
$extraprop=["","","","","","","","","","","","","","","","","","","","","","","",""];
$size=[1,1,1,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,12,3,3,3,3,3];
?>

<center>
<div id="contenido_cn" class="col-sm-12 col-lg-12 col-md-12 col-xs-12">
	<div class="col-lg-12 col-md-12 col-sm-2">
		<label><b>Captura de Nueva Cotización	</b></label>	
	</div>
	<div id="datogenerales" class="col-sm-12 col-xs-12 col-lg-12 col-md-12" style="background: #3674B2;color:white">
		Datos Generales
	</div>

	<!----Aqui empieza Datos Generales -->
	<?php $cont=0; foreach ($campos as $campo) {
		if(in_array($campo->Field, $array)){
			campos($type[$cont],$campo->Comment,$campo->Field,$size[$cont],$options[$cont],$datos,$extraprop[$cont],$cons);
		}
		$cont++;
	} ?>
	<div class="col-sm-6 col-xs-6 col-lg-3 col-lg-3">
		<div class="form-group">
		    <label for="tipo">Tipo de Vuelo:</label>
		    <select name="tipo" id="tipo" class="form-control">
				<option value='0'>Selecciona un tipo</option>
				<?php 
				foreach ($tipos as $tipo) {
				?>
					<optgroup label="<?php echo $tipo->nombre_extra; ?>">
						<?php
						$stmt->bindParam(":tipo",$tipo->id_extra,PDO::PARAM_STR);
						$stmt->execute();
						$resultado=$stmt->fetchALL (PDO::FETCH_OBJ);
						foreach ($resultado as $data) { 
							$attr="";
							if(isset($datos) ){
								if($datos[0]->tipo_temp==$data->id_vc){
									$attr="selected";
								}
							}
							echo "<option $attr value='".$data->id_vc."'>".utf8_encode( $data->nombre_vc ). "</option>";
						} ?>
					</optgroup>
				<?php  } ?>
			</select>
		</div>
	</div>
	<?php $cont=0; foreach ($campos as $campo) {
		if(in_array($campo->Field, $array2)){
			campos($type[$cont],$campo->Comment,$campo->Field,$size[$cont],$options[$cont],$datos,$extraprop[$cont],$cons);
		}
		$cont++;
	} ?>
	<!----Aqui Termina Datos Generales -->


	<div class="col-sm-12 col-xs-12 col-lg-12 col-md-12" style="background: #3674B2;color:white">
		Hospedaje
	</div>
	<?php $cont=0; foreach ($campos as $campo) {
		if(in_array($campo->Field, $array4)){
			campos($type[$cont],$campo->Comment,$campo->Field,$size[$cont],$options[$cont],$datos,$extraprop[$cont],$cons);
		}
		$cont++;
	} ?>



	<div id="servicios">
		<?php include "servicios.php"; ?>
	</div>

	<div class="col-sm-12 col-lg-12 col-md-12 col-xs-12" style="background-color: #3674B2;color: white">
		Otros
	</div>
	<?php $cont=0; foreach ($campos as $campo) {
		if(in_array($campo->Field, $array3)){
			campos($type[$cont],$campo->Comment,$campo->Field,$size[$cont],$options[$cont],$datos,$extraprop[$cont],$cons);
		}
		$cont++;
	} ?>
	<div id="tipo_descuento">
		<?php include "descuento1.php"; ?>
	</div>	
		<!--<div class="col-sm-12 col-lg-12 col-md-12 col-xs-12" style="background-color: #3674B2;color: white">
			Cuentas Bancarias
		</div>-->



	<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12" style="margin-top: 4%;margin-bottom: 4%">
	<?php if(!isset($datos[0]->status) ||$datos[0]->status==2 || $datos==""){ ?>
		<button class="btn btn-success"  data-toggle="modal" data-target="#modal-confirmacion" onclick="validar_datos('Cotización del vuelo <?php echo $idtemp; ?>',<?php echo $idtemp; ?>)"> Cotizar</button>
	<?php } else { ?>
		<?php if($datos[0]->status==3 || $datos[0]->status==4) {?>
			<button class="btn btn-primary"  data-toggle="modal" data-target="#modal-confirmacion" onclick="validar_datos('Cotización del vuelo <?php echo $idtemp; ?>',<?php echo $idtemp; ?>)">Reenviar Cotizacion</button>
			
		<?php } else if($datos[0]->status==5){ ?>

		<?php } ?>
	<?php } ?>
	</div>
</div>
</center>
<center>
<!-- 	<div class="col-sm-4 col-md-12 col-lg-4 col-xs-4" id="desglozado">
		Ver Desglose<hr>
		<div id="desglose_generales">
			<?php if(isset($datos[0]->nombre_temp)){
				echo "<label style='color:white'>Gracias Por Reservar </label>";
			} ?>
		</div>
		<div id="desglose_tvuelo">
		</div>
		<div id="desglose_hospedaje">
		</div>
	</div> -->
</center>
<script type="text/javascript" src="captura_nuevo/cargar_nuevo.js"></script>
<script type="text/javascript">

        puesto="";
	function validar_datos(text,id){
		if($("#mail").val()==""){
			text="Error, debe de cargar un correo electronico";
			id="";
		}
		if($("#tipo").val()=="0"){
			text="Error, debe de cargar un Tipo de Vuelo";
			id="";
		}
		if($("#telcelular").val()==""){
				text="Error, debe de cargar un Teléfono Celular";
				id="";
		}
		if($("#fechavuelo").val()==""){
				text="Error, debe de cargar una Fecha de Vuelo";
				id="";
		}
		if($("#habitacion").val()!=""){
			
			if($("#checkin").val()==""){
				text="Error, debe de cargar un Checkin";
				id="";
			}if($("#checkout").val()==""){
				text="Error, debe de cargar un Checkout";
				id="";
			}
		}
		abrir_modal(text,id,"cotizacion.php");
	}
	act_temp=<?php echo $idtemp ?>;
	<?php if((isset($datos[0]->status) && $datos[0]->status==2) || $datos==""){ ?>
			tipo=1;
	<?php } else { ?>
			tipo=2;
	<?php } ?>	
	tipo=1;

	<?php if(isset($_POST['tipo'])){ ?>
		$("input").attr("disabled","disabled");
		$("select").attr("disabled","disabled");
		$("button").not("#total_temp").prop("disabled","disabled");
		$("textarea").attr("disabled","disabled");
	<?php } ?>
	$("#hotel").on("change",function(){
			mostrar_habitacion();
	});
	<?php if(isset($datos[0]->hotel_temp)){ ?>
		mostrar_habitacion();
		<?php if(isset($datos[0]->habitacion_temp)){ ?>
			puesto=<?php echo $datos[0]->habitacion_temp?>;
		<?php } ?>
	<?php } ?>
	function mostrar_habitacion(){
		hotel=$("#hotel").val();
		if(hotel==""){
			return false;
		}
		var1="id_habitacion as value, nombre_habitacion as text";
		var2="habitaciones_volar";
		var3="status<>0 AND idhotel_habitacion="+hotel;
        parametros={var1:var1,var2:var2,var3:var3};
      	$("#habitacion").empty().append("<option value=''>Selecciona un Puesto </option>");
	    $.ajax({
	      data: parametros,
	      dataType:"json",
	      url:'../css/log/c/query_json.php',
	      type:"POST",
	      success: function(data){	
	        $.each( data, function( key, value ) {
			  text=value.text;
			  val=value.value;
			  attr="";
			  if(val==puesto){
			  	attr="selected";
			  }
			  $("#habitacion").append("<option value='"+val+"' "+attr+">"+text+"</option>");
			});
	      },
	      error:function(){
	      	alert("dangerdsa");
	      }

	    }); 
	}
</script>