App.consultarFondoDetalladoEvents = (function(app){
	$('#detallado').on('click', function(){
      		$.ajax({
                  type: "POST",
                  url: "../modules/consultarFondoDetallado.php",
                  dataType: "json",
                  timeout: 5000,
	          success: function(data){good(data)}, 
		  error: function(data, err){bad(data, err)}
              })
	});
	function good(data){
	console.log(data);
		 var cuenta = data.user[0];
	}	
	function bad(data, err){
		$('#message_fondo').text('error: ' + data.responseText);
		$('#modal_fondo').openModal();
	}
})(App)
