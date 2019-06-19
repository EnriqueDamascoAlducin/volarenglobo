function mandar_datos(){
	check=0;
	if($("#save").is(":checked")){
		check=1;
	}
	if($("#user").val().trim()==""){
		return false;
	}
	if($("#pass").val().trim()==""){
		return false;
	}
	parametros=$("#loginform").serialize();
	$.ajax({
		url:"../volarenglobo/css/log/login.php",
		method: "POST",
		async:true,
  		data: parametros,
  		success:function(response){
  			alert(response);
  			if(response.includes("Bienvenido")){
  				window.location.replace("paginas/");
  			}
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

	 event.preventDefault(); 
}