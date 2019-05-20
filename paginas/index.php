<?php 
session_start();
include_once "../css/log/c/conexion.php";
date_default_timezone_set("America/Mexico_City");
if(!isset($_SESSION['id'])){
	header("Location: ../login.php");
}
if(!isset($_SESSION['modulo'])){
	$_SESSION['modulo']="/";
}
if(!isset($_SESSION['idpagina'])){
	$_SESSION['idpagina']="";
}
$id=$_SESSION['id'];
$date = date('d/m/Y ', time());
$campos=" Distinct modulo.nombre_per,modulo.id_per,modulo.img_per,modulo.ruta_per";
$tablas="permisos_volar modulo, subpermisos_volar sub, permisosusuarios_volar per ";
$filtro="modulo.id_per=sub.permiso_sp and per.idsp_puv=sub.id_sp and per.idusu_puv=".$_SESSION['id']." and modulo.status=1 and per.status=1 and sub.status=1";
$permisos=$cons->consultas($campos,$tablas,$filtro,"");

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<style type="text/css">
		div .form-control{
			text-align:center;
		}
	</style>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/index.css">
	<link rel="stylesheet" type="text/css" href="../css/botones.css">
	<link rel="stylesheet" type="text/css" href="../css/botones-device.css">
	<link rel="stylesheet" type="text/css" href="../css/boot/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/jquery.dataTables.min.css">
	<meta name="author" content="Enrique Damasco Alducin/Verenice Gomez Martinez" >
	<meta name="keywords" content="SAV, VOLAR EN GLOBO S.A. de C.V.">
	<meta name="description" content="Sistema de Administracion SAV">
	<link rel="icon" href="../img/logo1.jpg">
	<script type="text/javascript" src="../js/jquery.min.js"></script>
	<script type="text/javascript" src="../js/boot/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/jquery.dataTables.min.js"></script>
	<title>Inicio</title>
</head>
<body>
	<table style="width: 100%;max-width: 100%">
		<tr style="max-height: 1px">
			<td style="width: 30%;max-width: 30%;background-color: #3674B2;color: white;text-align: right;" height="1">
				<div class="pull-left" style="">
					<span id="simbolo" style="color: white" onclick="ocultar('menu',0)" class="glyphicon glyphicon-menu-left "> 
				<?PHP echo $_SESSION['nombre']." ".$_SESSION['apellidop'] ?>
				</span>
				</div>
			</td>
			
			<td style="width: 10%;max-width: 10%;background-color: #FFFF00;" height="1">
				<label class="copy" style="color: black"> <?PHP echo $date ?> </label> 
			</td>
			<td style="width: 10%;max-width: 10%;background-color: #FF6633;color: white;" height="1"></td>
			<td style="width: 10%;max-width: 10%;background-color: #FF0000;color: white;" height="1"></td>
			<td style="width: 10%;max-width: 10%;background-color: #660000;color: white;" height="1" ></td>
			<td style="width: 30%;max-width: 30%;background-color: #3674B2;color: white;text-align: right;"onclick='window.location.replace("../login.php");'>
			<span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbsp;&nbsp;Salir&nbsp;&nbsp;
			</td>
		</tr>
	</table>
	
	<div id="menu" class="mizquierdo" style="margin-top: 6%" >
		<center>
			<br><br>
		<?php foreach ($permisos as $permiso) { ?>
			<div class="col-sm-6 col-lg-6 col-md-6 col-xs-12"   onclick="cargar_pagina('<?php echo $permiso->ruta_per ?>index.php',<?php echo $permiso->id_per ?>)">
   				<div class="pull-rigth">
   					<img src="<?php echo $permiso->img_per ?>" title="captura" class="img-responsive" alt="<?php echo $permiso->nombre_per ?>">
   				</div>
   				<p class="copy" style="color:black"><?php echo utf8_encode( $permiso->nombre_per) ?></p>
			</div>
			
		<?php } ?>
		</center>
	</div>
	<div  class="mderecho" >
			
		<div id="contenido">
			
		</div>	

	</div>
	<div id="modal-confirmacion" class="modal fade" role="dialog" style="border: 20px;max-height: 100%;height: 100%;overflow-y: scroll;">
  
	</div>
	<table style="width: 100%;max-width: 100%" class="tablafinal">
		<tr style="max-height: 1px">
			<td style="width: 30%;max-width: 30%;background-color: #3674B2;color: white;" height="1" onclick='cambiar_contra();'>
				<label class="copy glyphicon glyphicon-cog" > Contraseña </label> 
			</td>
			<td style="width: 10%;max-width: 10%;background-color: #FFFF00;" height="1"><label class="copy" style="color: black"><?PHP echo $date ?></label> </td>
			<td style="width: 10%;max-width: 10%;background-color: #FF6633;color: white;" height="1"></td>
			<td style="width: 10%;max-width: 10%;background-color: #FF0000;color: white;" height="1"></td>
			<td style="width: 10%;max-width: 10%;background-color: #660000;color: white;" height="1"></td>
			<td style="width: 30%;max-width: 30%;background-color: #3674B2;color: white;" >
				<label class="copy" > &copy; Volar en Globo S.A. de C.V.</label>
			</td>
		</tr>
	</table>
	<!-- Modal -->


	<script type="text/javascript">
		<?php if(isset($_SESSION['modulo']) && $_SESSION['idpagina']!=""){ ?>
			cargar_pagina("<?php echo $_SESSION['modulo'] ?>","<?php echo $_SESSION['idpagina'] ?>");
		<?php } ?>
		function filtrar_datos(modulo){
			var url = modulo;
	        $.ajax({                        
	           type: "POST",                 
	           url: url,                     
	           data: $("#form-filtro").serialize(), 
	           success: function(response)             
	           {
	             $('#contenido').html(response);
	             $(".DataTable").DataTable().destroy();
	             tables();

	           }
	       });
		}
		function enviar_cotizacion(){
			parametros={id:act_temp};
			$.ajax({
				url:"../css/log/correo.php",
				method: "POST",
		  		data: parametros,
		  		success:function(response){
		  			//$("#contenido").html(response);
		  			abrir_alert("info","Correo Enviado Exitosamente");
		  			console.log(response);
		  		},
		  		error:function(){
		  			alert("Error");
		  		},
		  		statusCode: {
				    404: function() {
				      alert( "page not found" );
				    }
				  }
			});
			cargar_pagina("<?php echo $_SESSION['modulo'] ?>",<?php echo $_SESSION['idpagina'] ?>);
		}
		function actualizar_status(valor,id,modulo,idpag){
			parametros={status:valor,id:id};
			$.ajax({
				url:"../crud/crud.php",
				method: "POST",
		  		data: parametros,
		  		success:function(response){
		  			if(response.includes("Actualizado")){
		  				abrir_alert("info","Registro Actualizado");
		  			}else if(response.includes("Registrado")){
		  				abrir_alert("success","Registro Agregado");
		  			}
		  		},
		  		error:function(){
		  			alert("Error");
		  		},
		  		statusCode: {
				    404: function() {
				       $( "#cuerpo_modal" ).html("<h3>Error al modificar</h3><img src='../img/queryerror.png' style='margin-left:20%;margin-rigth:20%;width:20%;max-width:20%;max-height:30%'>");
				    }
				  }
			});
			cargar_pagina(modulo,idpag);
		}
		function abrir_modal(titulo,id,url){
			$("#modal-confirmacion").load("modales/"+url,{id:id,titulo:titulo},function(response, status, xhr){
				if ( xhr.status == 404 ) {
				    $( "#cuerpo_modal" ).html("<img src='../img/404.jpg' style='margin-left:20%;margin-rigth:20%;width:60%'>");
				}
			setTimeout(function() {
		      tables();
		    },200);
			});
		}
		function ocultar(id,tipo){
			if(tipo==0){
				$("#"+id).css("max-width","0%").children().find("img").css("width","150%").find("small").css("font-size","8px");
				$("#simbolo").removeClass("glyphicon-menu-left").addClass("glyphicon-menu-right");
				$("#simbolo").attr("onclick","ocultar('menu',1)");
				$(".mderecho").css("max-width","100%").css("width","100%").css("left","0%");

			}else{
				$("#"+id).css("max-width","15%").css("width","15%");
				$("#simbolo").removeClass("glyphicon-menu-right").addClass("glyphicon-menu-left");
				$("#simbolo").attr("onclick","ocultar('menu',0)");
				$(".mderecho").css("max-width","84%").css("width","84%").css("left","15.5%");

			}
			tables();
		}
		const idusu=<?php echo $_SESSION['id']; ?>;
		function cargar_pagina(url,id){
			$("#contenido").load(url,{idpagina:id},function(response, status, xhr){
				if ( xhr.status == 404 ) {
				    $( "#contenido" ).html("<img src='../img/404.jpg' style='margin-left:20%;margin-rigth:20%;width:60%'>");
				}
			});
		}
		function tables(){
			$(".DataTable").DataTable().destroy();
			$(".DataTable").DataTable({
				"autoWidth": false,
				"scrollX": true,
				"searching": true,
				"lengthChange":false,
				"searching":false
			});
		}
  function save_extra(url1,idpag=0,titulo,id,modal){
    param=$("#formularioext").serialize();
    url="../crud/crud.php";
    $.ajax({                        
           type: "POST",                 
           url: url,                     
           data: param, 
           success: function(data)             
           {
            if(data.includes("Actualizado")){
              abrir_alert("info","Registro Actualizado");              
            }else if(data.includes("Agregado")){
            	 abrir_alert("success","Registro Agregado");     
            }
            console.log(data);
            //alert(data);
            if(idpag!=0){
            	cargar_pagina(url1,idpag);
            }else{
            	window.location.replace("../login.php");

            }
           }
       });
	    setTimeout(function(){
	      abrir_modal(titulo,id,modal);
	    },1000);
  	}
	function confirmar_icon(id,tipo){
		id2=id.split("_");
		if(tipo==1){
			$("#"+id).hide();
			$("#"+id).next("div").show();
		}else{
			$("#"+id).parent().hide();
			$("#"+id).parent().prev("span").show();
		}
	}
	function abrir_alert(clase,texto){
		if(clase=="success"){
			titulo="Exito";
		}else if(clase=="danger"){
			titulo="Error";
		}else if(clase=="warning"){
			titulo="Advertencia";
		}else if(clase=="info"){
			titulo="Actualizado";
		}
		if($("#div_alert").length){
			$("#div_alert").remove();
		}
		$("body").append('<div id="div_alert" onclick="eliminar_alert(this.id)" class="alert alert-'+clase+'" style="display: block;right:0; z-index: 10;opacity:1 ; position: absolute;">'+
			 '<strong > <label id="titulo"> '+titulo+'! </label></strong><small id="texto">'+texto+' </small>'+
			'</div>');
		ocultar_alert(8000);
		
	}
	$("#div_alert").hover(function(){
		$(this).css("opacity","1");
		ocultar_alert(8000);
	})
	function ocultar_alert(timepo){
		$( "#div_alert" ).animate({
		    opacity: 0.03,
		    top: "-=10",
		    height: "auto"
		  }, timepo, function() {
		    $("#div_alert").remove();
		  });
	}
	function eliminar_alert(id){
		$("#"+id).remove();
	}

	function enviar_crud(event){
		param=$("#formulario").serialize();
		url="../crud/crud.php";
		$.ajax({                        
           type: "POST",                 
           url: url,                     
           data: param, 
           success: function(data)             
           {
           	if(data.includes("Agregado")){
             abrir_alert("success","Agregado Exitosamente");         
           	}else if(data.includes("Actualizado")){
           		abrir_alert("info","Actualizado Exitosamente");
           	}else{
           		abrir_alert("danger","Error en la consulta");
           	}
           }
       	});
		setTimeout(function(){
			cargar_pagina("<?php echo $_SESSION['modulo'] ?>",<?php echo $_SESSION['idpagina'] ?>);
		},1000);
		
	}
	function abrir_forms(id,form){
		if(id!=0){
			$("#contenido").load(form,{id:id});
		}else{
			$("#contenido").load(form);
		}
	}
</script>
  <script type="text/javascript">
		<?php if(md5("123")==$_SESSION['contrasena']){ ?>
			cambiar_contra();
		<?php } ?>
		function cambiar_contra(){

			abrir_modal("<?php echo $_SESSION['nombre'] ?>. Es necesario el cambio de contraseña",'<?php echo $_SESSION['id'] ?>',"cambiocontra.php");
			$("#modal-confirmacion").modal('show');
		}
	</script>

</body>
</html>