App.events = (function(){
	$(document).ready(function() {
    $('select').material_select();
  });

  $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15 // Creates a dropdown of 15 years to control year
  });
  $('#logout').click(function(){
      $.ajax({
                  type: "POST",
                  url: "modules/logout.php",
                  dataType: "json",
                  timeout: 5000,
                  data: {},
	          success: function(data){console.log("logout exitoso")}, 
		  error: function(data){console.log("error en logout")}
              })
    window.location = "pages/login.html"
  });
})();
