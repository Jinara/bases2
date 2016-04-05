$(document).ready(function () {
    console.log('hola');
	$("#guardar_socio").on("click", function () {
        console.log('haciendo servicio:');
                    $.ajax({
                        type: "POST",
                        url: "/proyectobd/modules/guardarSocio.php",
                        dataType: "json",
                        timeout: 5000,
                        data: {nombre: "holi", apellido: "bb"}
                    })
                            .done(function (data) {
                                if (data.respuesta) {
                                    console.log('holi! ya guardo socio');
                                } else {
                                    console.log('holi! NO guardo socio');
                                }
                            })
                            .fail(function () {
                                
                            });
                });


});