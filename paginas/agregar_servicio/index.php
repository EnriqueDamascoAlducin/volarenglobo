<?php

	$_SESSION['extraquery']="";
?>
<div id="servicios">
	Nombre del servicio: <input type="text" id="servicio">
	Precio: <input type="number" id="precio">
	Imagen: <input type="text" id="imagen">
	Cortesia: <input type="checkbox" id="cortesia" checked="">
	<button class="boton boton-correcto" onclick="registrar_servicio();">Guardar</button>
	<script type="text/javascript">
		function registrar_servicio(){
			servicio=$("#servicio").val();
			precio=$("#precio").val();
			imagen=$("#imagen").val();
			cortesia=0;
			if($("#cortesia").is(":checked")){
				cortesia=1;
			}
			parametros={servicio:servicio,precio:precio,imagen:imagen,cortesia:cortesia};
			$.ajax({
				url:"agregar_servicio/registro.php",
				method: "POST",
				async:false,
		  		data: parametros,
		  		success:function(response){
		  			alert(response);
		  		},
		  		error:function(){
		  			alert("Error");
		  		},
		  		statusCode: {
				    404: function() {
				      alert( "No encuontoro el archivo de registro" );
				    }
				  }
			});
		}
	</script>
</div>