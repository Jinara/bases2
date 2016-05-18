App.crearSocio_events = (function(app){
$(document).ready(function () {
	$('#guardar_socio').addClass('disabled');
	$("#guardar_socio").on("click", function (evt) {
		if(!$(this).hasClass('disabled'))
        	saveSocio();
	});

	$("#validar").on("click", function () {
        	validarTj();
	});

	$('#tipodoc_socio').material_select();

	if(sessionStorage.user){
	user = JSON.parse(sessionStorage.user);
	$('#id_socio').val(user['K_ID_USUARIO'])
	var sexo = user['O_SEXO'] == 1 ? 'F' : 'M';
	$('#sexo_socio').val(sexo)
	$('#apellido_socio').val(user['N_APELLIDO_USUARIO'])
	$('#tipodoc_socio').val(getTipoDoc(null, user['O_TIPO_DOC']))
	$('#estadocivil_socio').val(getEstadoCivil(null, user['O_ESTADO_CIVIL']))
	$('#nombre_socio').val(user['N_USUARIO'])
	$('#nick_socio').val(user['N_USERNAME'])
	$('#numdoc_socio').val(user['O_TIPO_DOC'])
	$('#nombre_socio').val(user['V_NUM_DOC'])
	$('#ocupacion_socio').val(user['N_OCUPACION'])
	$('#email_socio').val(user['O_CORREO_ELECTRONICO'])
	$('#ddomicilio_socio').val(user['O_DIRECCION'])
	$('#tdomicilio_socio').val(user['V_TELEFONO'])
	sessionStorage.removeItem('user');
	}
});

function getEstadoCivil(estado = null, _estado = null){
	estado = parseInt(estado);
	switch(estado){
		case 1: return 'S'; break;
		case 2: return 'V'; break;
		case 3: return 'C'; break;
		case 4: return 'U'; break;
	}
	switch(_estado){
		case 'S': return 1; break;
		case 'V': return 2; break;
		case 'C': return 3; break;
		case 'U': return 4; break;
	}
	return 0;
}

function getTipoDoc(tipo = null, _tipo = null){
	tipo = parseInt(tipo);
	switch(tipo){
		case 1: return 'CC'; break;
		case 2: return 'P'; break;
		case 3: return 'CE'; break;
	}
	switch(_tipo){
		case 'CC': return 1; break;
		case 'P': return 2; break;
		case 'CE': return 3; break;
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
                    $.ajax({
                        type: "POST",
                        url: "../modules/guardarSocio.php",
                        dataType: "json",
                        timeout: 5000,
                        data: {
				id: $('#id_socio').val(),
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
function renderSocio(user){
	window.location = "../pages/crearSocio.html";
	sessionStorage.user = JSON.stringify(user);
}
return {
	renderSocio: renderSocio
}
})(App)
