App.events = (function(){
	$(document).ready(function() {
    $('select').material_select();
  });

  $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15 // Creates a dropdown of 15 years to control year
  });
  $('#crear_socio').click(function(){
    window.location = "pages/crearSocio.html"
  });
})();
