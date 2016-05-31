App.consultarFondoDetalladoEvents = (function(app){
    $(document).ready(function(){
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
		var cuenta = data.user;
		renderFondoDetallado(cuenta);	
	}	
	function bad(data, err){
		$('#message_detallado').text('error: ' + data.responseText);
		$('#modal_detallado').openModal();
	}
	function renderFondoDetallado(cuenta){
		console.log(cuenta);
    		var table = '';
		for(key in cuenta){
		  if(key != 'error'){
		    table = table + '<tr>';
		    for(var i = 0; i < 3; i++){
		      table = table + '<td>' + cuenta[key][i] + '</td>';
		    }
		    table = table + '</tr>';
		  }
		}
		console.log(table);
		$('#info_det').append(table);
	}
})(App)
