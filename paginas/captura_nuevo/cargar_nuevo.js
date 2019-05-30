
	$("input[name='tdescuento']").on("click",function(){
		if($(this).val()=="1"){
			$("#cantdescuento1").attr("disabled","disabled");
			$("#cantdescuento").removeAttr("disabled");
		}else{
			$("#cantdescuento").attr("disabled","disabled");
			$("#cantdescuento1").removeAttr("disabled");

		}
		save_Data($(this).attr("name"),$(this).val());
	});
	
	$("input:not(:checkbox):not(#cantdescuento1)").on("blur",function(){
		if($(this).attr("name")=="mail"){
			if(!$(this).val().includes("@")){
				alert("No esta completo el correo");
				$(this).val("");
				return false;
			}
		}else{

			$(this).val( $(this).val().toUpperCase() );
		}
		save_Data($(this).attr("name"),$(this).val());
	});
	$("#cantdescuento").on("change",function(){
		save_Data($(this).attr("name"),$(this).val());
	});
	$("#cantdescuento1").on("blur",function(){
		save_Data($(this).attr("name"),$(this).val());
	});
	$("select:not(#cantdescuento)").on("change",function(){
		save_Data($(this).attr("name"),$(this).val());
	});
	$("textarea").on("change",function(){
		save_Data($(this).attr("name"),$(this).val());
	});

	function save_Data(campo,value){
		parametros={campo:campo,valor:value,id:act_temp,tipo:tipo};
		if(campo.includes("precio_") || campo.includes("cortesia_")){
			if(campo.includes("cortesia_")){
				tipo=2; //actualizar cortesia
			}else{
				tipo=1; //actualizar de paga
			}
			servicio=campo.split("_");
			parametros={servicio:servicio[1],valor:value,reserva:act_temp,tipo:tipo};
		}
		$.ajax({
			url:"captura_nuevo/temporal.php",
			method: "POST",
			async:false,
	  		data: parametros,
	  		success:function(response){
	  			console.log(campo+" Agregado " +response);
	  		},
	  		error:function(){
	  			alert("Error");
	  		},
	  		statusCode: {
			    404: function() {
			      alert( "No encontró el archivo de registro" );
			    }
			 }
		});
	}
