$(document).ready(function () {
	$('#guardar_socio').addClass('disabled');
	$("#guardar_socio").on("click", function (evt) {
		if(!$(this).hasClass('disabled'))
        	saveSocio();
	});

	$("#validar").on("click", function () {
        	validarTj();
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

function validarTj(){
	if(exist()){
	  $('#message_validar').text('Tarjeta válida!');
	  console.log('holii')
	  $('#modal_validar').openModal();
	  $('#guardar_socio').removeClass("disabled").addClass('waves-effect waves-light submit');
	}else{
	  $('#message_validar').text('Tarjeta inválida!');
	  $('#modal_validar').openModal();
	}
}

function exist(){
return true;
	return (Math.floor((Math.random() * 10) + 1)) == 1 ? true : false;
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
  			},
	          	success: function(data){good(data)}, 
		  	error: function(data){bad(data)}
                    })
}
function good(data){
	$('#message_crear_socio').text('Socio creado con exito!');
	$('#modal_crear_socio').openModal();
		window.location = "../index.html";
}
function bad(data){
	$('#message_crear_socio').text('Error al crear socio, por favor vuelva a intentarlo');
	$('#modal_crear_socio').openModal();
}
