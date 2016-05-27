$(document).ready(function () {
	$("#guardar_credito").on("click", function () {
        	saveCredito();
	});


});

function getTipoCredito(tcred){
	estado = parseInt(tcred);
	switch(tcred){
		case 1: return 'L'; break;
		case 2: return 'E'; break;
		case 3: return 'V'; break;
		
	}
	return 0;
}

function saveCredito(){
        //console.log('haciendo servicio:');
	console.log(getTipoCredito($('#tipo_credito').val())),
                    $.ajax({
                        type: "POST",
                        url: "../modules/guardarCredito.php",
                        dataType: "json",
                        timeout: 5000,
                        data: {
				identificacion: $('#documento_socio').val(),
				fsolicitud: parse_date($('#fechaSolicitud').val()),
				
				tipo_cred: getTipoCredito($('#tipo_credito').val()),
				val_cred: $('#monto_credito').val(),
				n_cuotas: $('#num_cuotas_credito').val(),
				type: 'credito'
				},
	          	success: function(data){good(data)}, 
		  	error: function(data){bad(data)}
                    })
}
function good(data){
	$('#message_crear_credito').text('Credito solicitado con exito!');
	$('#modal_crear_credito').openModal();
		window.location = "../index.html";
}
function bad(data){
	$('#message_crear_credito').text(data.responseText);
	$('#modal_crear_credito').openModal();
}
