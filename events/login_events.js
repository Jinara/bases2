
$(document).ready(function () {
	$("#login").on("click", function () {
		var val_nick = new LiveValidation('id'); 
		val_nick.add(Validate.Presence, {validMessage: "Ok", failureMessage: "Campo obligatorio."}); 
		var val_pass = new LiveValidation('pass'); 
		val_pass.add(Validate.Presence, {validMessage: "Ok", failureMessage: "Campo obligatorio."}); 
		if (LiveValidation.massValidate([val_nick, val_pass])) { 
        		login();
		}  
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
	$('#message').text(data.responseText);
	$('#modal1').openModal();
}
