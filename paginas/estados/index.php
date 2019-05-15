<?php 

include_once "../../css/log/c/conexion.php";
$estados=$cons->consultas("nombre_extra,abrev_extra,id_extra","extras_volar","status=1 and clasificacion_extra='estados' order by id_extra desc limit 5","");
$motivos=$cons->consultas("nombre_extra,abrev_extra,id_extra","extras_volar","status=1 and clasificacion_extra='motivos' order by id_extra desc limit 5","");
$tipos=$cons->consultas("nombre_extra,abrev_extra,id_extra","extras_volar","status=1 and clasificacion_extra='tiposv' order by id_extra desc limit 5","");
$tarifas=$cons->consultas("nombre_extra,abrev_extra,id_extra","extras_volar","status=1 and clasificacion_extra='tarifas' order by id_extra desc limit 5","");
?>
<br><br>
<center>
<button class="btn btn-info" onclick="mostar_pestana(1)" >Estados </button>
<button class="btn btn-info" onclick="mostar_pestana(2)">Motivos </button>
<button class="btn btn-info" onclick="mostar_pestana(3)">Tipo </button>
<button class="btn btn-info" onclick="mostar_pestana(4)">Tarifa </button><br><br><br>
</center>
<div id="pestana1">
	<center>
	Estado: <input type="text" id="nombre" class="input-control" placeholder="Nombre"><br><br>
	Abreviacón: <input type="text" id="abrev" placeholder="Abreviación">
	<br><br>
	<button class="btn btn-info" onclick="mandar_datos(1)">Enviar</button>

	</center>
	<table>
		<thead>
			<tr>
				<th>Nombre</th>
				<th>Abreviación</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			foreach ($estados as $estado) {
				echo "<tr><td>$estado->nombre_extra</td><td>$estado->abrev_extra</td> <td><button onclick='eliminar(".$estado->id_extra.")'>Eliminar</button></td></tr>";
			}
			?>
		</tbody>
	</table>
</div>
<div id="pestana2">

	<center>
	Motivo: <input type="text" id="motivo" class="input-control" placeholder="Motivo"><br><br>
	<button class="boton boton-info" onclick="mandar_datos(2)">Enviar</button>

	</center>
	<table>
		<thead>
			<tr>
				<th>Nombre</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			foreach ($motivos as $estado) {
				echo "<tr><td>$estado->nombre_extra</td> <td><button onclick='eliminar(".$estado->id_extra.")'>Eliminar</button></td></tr>";
			}
			?>
		</tbody>
	</table>
</div>

<div id="pestana3">

	<center>
	Tipo: <input type="text" id="tipov" class="input-control" placeholder="Motivo"><br><br>
	Abreciación: <input type="text" id="tipo_abreviacion" class="input-control" placeholder="Abreviación"><br><br>
	<button class="boton boton-info" onclick="mandar_datos(3)">Enviar</button>

	</center>
	<table>
		<thead>
			<tr>
				<th>Nombre</th>
				<th>Abreviación</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			foreach ($tipos as $estado) {
				echo "<tr><td>$estado->nombre_extra</td><td>$estado->abrev_extra</td> <td><button onclick='eliminar(".$estado->id_extra.")'>Eliminar</button></td></tr>";
			}
			?>
		</tbody>
	</table>
	
</div>
<div id="pestana4">

	<center>
	Tarifa: <input type="text" id="tarifa" class="input-control" placeholder="Motivo"><br><br>
	Descripcion: <input type="text" id="descrip" class="input-control" placeholder="Abreviación"><br><br>
	<button class="boton boton-info" onclick="mandar_datos(4)">Enviar</button>

	</center>
	<table>
		<thead>
			<tr>
				<th>Nombre</th>
				<th>Descripción</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			foreach ($tarifas as $estado) {
				echo "<tr><td>$estado->nombre_extra</td><td>$estado->abrev_extra</td> <td><button onclick='eliminar(".$estado->id_extra.")'>Eliminar</button></td></tr>";
			}
			?>
		</tbody>
	</table>
	
</div>
<script type="text/javascript">
	mostar_pestana(1);
	function mostar_pestana(id){
		$("div [id*='pestana']").hide();
		$("#pestana"+id).show();
	}
	$('#abrev').keypress(function(event){
	    var keycode = (event.keyCode ? event.keyCode : event.which);
	    if(keycode == '13'){
	        mandar_datos();
	    }
	});	
	function eliminar (id){
		parametros={id:id};
	$.ajax({
		url:"estados/registro.php",
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
	cargar_pagina("estados/index.php");
	}
	function mandar_datos(valor){
		if(valor==1){
			usuario=$("#nombre").val();
			if(usuario=="" || usuario==" "){
				alert("Agrega Estado");
				$("#nombre").focus();
				return false;
			}
			pass=$("#abrev").val();
			if(pass=="" || pass=="  "){
				alert("Agrega Abreciación");
				$("#abrev").focus();
				return false;
			}
			clasificacion='estados';
		}else if(valor==2){
			usuario=$("#motivo").val();
			if(usuario=="" || usuario==" "){
				alert("Agrega un Motivo");
				$("#motivo").focus();
				return false;
			}
			pass=null;
			clasificacion='motivos';

		}else if (valor==3) {

			usuario=$("#tipov").val();
			if(usuario=="" || usuario==" "){
				alert("Agrega Tipo");
				$("#tipov").focus();
				return false;
			}
			pass=$("#tipo_abreviacion").val();
			if(pass=="" || pass=="  "){
				alert("Agrega Abreciación");
				$("#tipo_abreviacion").focus();
				return false;
			}
			clasificacion='tiposv';
		}else if (valor==4) {

			usuario=$("#tarifa").val();
			if(usuario=="" || usuario==" "){
				alert("Agrega Tipo");
				$("#tarifa").focus();
				return false;
			}
			pass=$("#descrip").val();
			if(pass=="" || pass=="  "){
				alert("Agrega Abreciación");
				$("#descrip").focus();
				return false;
			}
			clasificacion='tarifas';
		}
	parametros={nombre:usuario,abrev:pass,clasificacion:clasificacion};
	$.ajax({
		url:"estados/registro.php",
		method: "POST",
  		data: parametros,
		async:false,
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
	
	cargar_pagina("estados/index.php");
}
</script>