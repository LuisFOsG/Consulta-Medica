function cambio(){
    var arch = document.getElementById("archivo");
    var name = document.getElementById("nameArchivo");

    if(arch.value==""){
        name.innerHTML = "Adjuntar Documento de Identidad";
    }else{
        var extensiones =  new Array(".pdf");

        extension = (arch.value.substring(arch.value.lastIndexOf("."))).toLowerCase();

        if (!(extensiones[0]===extension)) {
            name.innerHTML = "Extension no valida, Tiene que ser un PDF";
            arch.value = "";
        }else{
            var documento= arch.value.substring(12);
            name.innerHTML = documento;
        }
    }
}