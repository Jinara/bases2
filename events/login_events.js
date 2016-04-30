
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
  			pass: $('#pass').val()
  			},
	          success: function(data){good(data)}, 
		  error: function(data){bad(data)}
              })
}

function good(data){
	window.location = "../index.html";
}
function bad(data){
	$('#message').text('Usuario o clave incorrectos, por favor vuelva a intentarlo');
	$('#modal1').openModal();
}
