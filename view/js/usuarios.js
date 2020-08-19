/*===========================================
SUBIR LA FOTO PARA EL USUARIO
se utiliza jQuery para validar que solo se 
suba archvos jpg/png y no mayor a 2mb
============================================*/

$(".Nuevafoto").change(function() { 
    var imagen = this.files[0];
    
    // VALIDAR EL FORMATO DE LA IMAGEN
    if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {
        $(".Nuevafoto").val("");
        
        Swal.fire({
            icon: 'error',
            title: 'Oops error al subir la imagen',
            text: 'verifica que la imagen sea de formato png/jpg'
          });

    // VALIDAR EL PESO DE LA IMAGEN NO SEA MAYOR A 2 MB
    }else if(imagen["size"] > 2000000){
        Swal.fire({
            icon: 'error',
            title: 'Oops error al subir la imagen',
            text: 'verifica que la imagen sea menor a 5 MB'
          });
    }else{
        var datosimagen = new FileReader;
        datosimagen.readAsDataURL(imagen);
        $(datosimagen).on("load", function (event) {
            var rutaimagen = event.target.result;

            $(".previsualizar").attr("src",rutaimagen);

        }); 
    }
});

/*===========================================
EDITAR USUARIO
============================================*/

$(".btnEditarUsuario").click(function () { 
    var idUsuario = $(this).attr("idUsuario");
    var datos = new FormData();

    datos.append("idUsuario",idUsuario);

    $.ajax({
        url: "ajax/usuarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (response) {

            console.log("respuesta",response);

            $("#Editarnombre").val(response["nombre"]);
            $("#Editarusuario").val(response["usuario"]);
            $("#Editarperfil").html(response["perfil"]);
            $("#Editarperfil").val(response["perfil"]);
            $("#fotoActual").val(response["foto"]);

            $("#passwordActual").val(response["password"]);
           
            


            if (response["foto"] != "") {
                $(".previsualizar").attr("src",response["foto"]);  
                
            }
            
        }
    });
    
});