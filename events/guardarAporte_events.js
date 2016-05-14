$(document).ready(function () {
	$("#guardar_aporte").on("click", function () {
        	saveAporte();
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

function saveAporte(){
        console.log('haciendo servicio:');
	console.log(getTipoPago($('#tipo_pago').val())),
                    $.ajax({
                        type: "POST",
                        url: "../modules/guardarAporte.php",
                        dataType: "json",
                        timeout: 5000,
                        data: {
				n_consig: $('#comp_pago').val(),
				tpago:getTipoPago($('#tipo_pago').val()),
				fpago: parse_date($('#fechaSolicitud').val()),
				val_apor: $('#valor_pago').val(),
				
				type: 'pago_aporte'
				}
                    })
                            .done(function (data) {
                                if (data.respuesta) {
                                    console.log('Pago aporte OK');
                                } else {
                                    console.log('Pago aporte FAILED');
                                }
                            })
                            .fail(function () {
                               console.log('fallo servicio'); 
	})
}
