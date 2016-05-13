$('#consultar').on('click', function(){
      $.ajax({
                  type: "POST",
                  url: "../modules/editarSocio.php",
                  dataType: "json",
                  timeout: 5000,
                  data: {documento: $('#documento_socio').val()},
	          success: function(data){good(data)}, 
		  error: function(data, err){bad(data, err)}
              })
});
function good(data){
	$('#message_crear_socio').text('Socio creado con exito!');
	$('#modal_crear_socio').openModal();
		window.location = "../index.html";
}
function bad(data, err){
console.log('holi')
console.log(data.statusCode())
console.log('holi')
console.log(err)
	$('#message_consultar_socio').text('error: ' + data.responseText);
	$('#modal_consultar_socio').openModal();
}
