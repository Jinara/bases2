
$(document).ready(function () {
	$("#login").on("click", function () {
        	login();
	});
});

function login(){
	
      $.ajax({
                  type: "POST",
                  url: "../modules/login.php",
                  dataType: "json",
                  timeout: 5000,
                  data: {
  			nick: $('#id').val(),
  			password: $('#pass').val(),
  			type: 'socio'
  			}
              })
                      .done(function (data) {
                          if (data.respuesta) {
                          } else {
                          }
                      })
                      .fail(function () {
                         console.log('fallo servicio'); 
	})
}
}
