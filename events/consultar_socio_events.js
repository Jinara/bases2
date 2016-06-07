App.consultarSocioEvents = (function(app){
var user = null;
	$('#consultar').on('click', function(){
      		$.ajax({
                  type: "POST",
                  url: "../modules/consultarSocio.php",
                  dataType: "json",
                  timeout: 5000,
                  data: {documento: $('#documento_socio').val()},
	          success: function(data){good(data)}, 
		  error: function(data, err){bad(data, err)}
              })
	});
	function good(data){
		
		if ("user" in data) {
			user = data.user[0];
			renderSocio(user, function(){
			});
		}else{
			$('#message_consultar_socio').text(data.mensaje);
			$('#modal_consultar_socio').openModal();
		}
	}	
	function bad(data, err){
		$('#message_consultar_socio').text('error: ' + data.responseText);
		$('#modal_consultar_socio').openModal();
	}
	function renderSocio(user){
		App.crearSocio_events.renderSocio(user);
	}
})(App)
