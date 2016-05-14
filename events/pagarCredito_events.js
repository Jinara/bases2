$(document).ready(function () {
	$("#pagar_credito").on("click", function () {
        	savePagoCredito();
	});


});

function getTipoPago(tpago){
	estado = parseInt(tpago);
	switch(tpago){
		case 1: return 'C'; break;
		case 2: return 'E'; break;
		
		
	}
	return 0;
}

function savePagoCredito(){
      //  console.log('haciendo servicio:');
	console.log(getTipoPago($('#tipo_pago').val())),
                    $.ajax({
                        type: "POST",
                        url: "../modules/guardarAporte.php",
                        dataType: "json",
                        timeout: 5000,
                        data: {
				n_consig: $('#comp_pago').val(),
				fpago: parse_date($('#fechaSolicitud').val()),
				v_cuota: $('#valor_cuota').val(),
				v_cap: $('#valor_capital').val(),
				v_int: $('#valor_interes').val(),
				tpago:getTipoPago($('#tipo_pago').val()),
				id_cred: $('#id_credito').val(),
				
				type: 'pago_credito'
				},
	          	success: function(data){good(data)}, 
		  	error: function(data){bad(data)}
                    })
}
function good(data){
	$('#message_pagar_credito').text('Credito pagado con exito!');
	$('#modal_pagar_credito').openModal();
		window.location = "../index.html";
}
function bad(data){
	$('#message_pagar_credito').text(data.responseText);
	$('#modal_pagar_credito').openModal();
}