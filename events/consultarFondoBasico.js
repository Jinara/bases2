App.consultarFondoBasicoEvents = (function(app){
    $(document).ready(function(){
      		$.ajax({
                  type: "POST",
                  url: "../modules/consultarFondoBasico.php",
                  dataType: "json",
                  timeout: 5000,
	          success: function(data){good(data)}, 
		  error: function(data, err){bad(data, err)}
              })
    });
	function good(data){
		var cuenta = data.user;
		renderFondoBasico(cuenta);	
	}
	function bad(data, err){
		$('#message_fondo').text('error: ' + data.responseText);
		$('#modal_fondo').openModal();
	}
	function renderFondoBasico(cuenta){
    		var table = '';
		table = '<tr>';
		for(var i = 1; i < 8; i++){
			table = table + '<td>' + cuenta[i] + '</td>';
		}
		table = table + '</tr>';
		$('#info').append(table);
	}
})(App)
