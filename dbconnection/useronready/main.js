$(buscar_datos());
$(buscarUsuario());

function buscar_datos(consulta){
    $.ajax({
        url:"dbconnection/useronready/buscar.php",
        type:"POST",
        dataType:"html",
        data: {consulta: consulta},
    })
    .done(function(respuesta){
        $("#usuarioEncontrado").html(respuesta);
    })
    .fail(function(){
        console.log("Error");
    })
}
$(document).on("keyup", "#cambioo", function(){
    var valor = $(this).val();
    if(valor != ""){
        buscar_datos(valor);
    }
});

/* LOGIN */

function buscarUsuario(consulta){
    $.ajax({
        url:"dbconnection/useronready/buscar.php",
        type:"POST",
        dataType:"html",
        data: {usuario: consulta},
    })
    .done(function(respuesta){
        $("#encontrado").html(respuesta);
    })
    .fail(function(){
        console.log("Error");
    })
}

$(document).on("keyup", "#cuenta", function(){
    var valor = $(this).val();
    if(valor != ""){
        buscarUsuario(valor);
    }
});
