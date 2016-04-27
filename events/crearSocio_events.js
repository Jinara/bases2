$(document).ready(function () {
	$("#guardar_socio").on("click", function () {
        	saveSocio();
	});


});

function getEstadoCivil(estado){
	estado = parseInt(estado);
	switch(estado){
		case 1: return 'S'; break;
		case 2: return 'V'; break;
		case 3: return 'C'; break;
		case 4: return 'U'; break;
	}
	return 0;
}

function getTipoDoc(tipo){
	tipo = parseInt(tipo);
	switch(tipo){
		case 1: return 'CC'; break;
		case 2: return 'P'; break;
		case 3: return 'CE'; break;
	}
	return 0;
}
function getSexo(sexo){
	if(sexo == null){
		return 0;
	}
	sexo = parseInt(sexo);
	return sexo == 1 ? 'F' : 'M';
}

function saveSocio(){
        console.log('haciendo servicio:');
	console.log(getTipoDoc($('#tipodoc_socio').val())),
                    $.ajax({
                        type: "POST",
                        url: "../modules/guardarSocio.php",
                        dataType: "json",
                        timeout: 5000,
                        data: {
				nombre: $('#nombre_socio').val(),
				apellido: $('#apellido_socio').val(),
				nick: $('#nick_socio').val(),
				estado_civil: getEstadoCivil($('#estadocivil_socio').val()),
				tipo_doc: getTipoDoc($('#tipodoc_socio').val()),
				ocupacion: $('#ocupacion_socio').val(),
				documento: $('#nick_socio').val(),
				sexo: getSexo($('#sexo_socio').val()),
				email: $('#email_socio').val(),
				dtrabajo: $('#dtrabajo_socio').val(),
				ddomicilio: $('#ddomicilio_socio').val(),
				ttrabajo: $('#ttrabajo_socio').val(),
				celular: $('#celular_socio').val(),
				tdomicilio: $('#tdomicilio_socio').val(),
				fingreso: parse_date($('#fechaingreso_socio').val()),
				fsalida: $('#fechasalida_socio').val(),
				causal: $('#causal_socio').val(),
				password: $('#contraseña_socio').val(),
				type: 'socio'
				}
                    })
                            .done(function (data) {
                                if (data.respuesta) {
                                    console.log('holi! ya guardo socio', data);
                                } else {
                                    console.log('holi! NO guardo socio');
                                }
                            })
                            .fail(function () {
                               console.log('fallo servicio'); 
	})
}
