App.consultarFondoEvents = (function(app){
    $(document).ready(function () {
	$('#basico').on('click', function(){
		window.location = "consultarBasicoFondo.html";
	});
	$('#detallado').on('click', function(){
		window.location = "consultarDetalladoFondo.html";
	});
    });
})(App)
